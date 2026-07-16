<?php
require_once __DIR__ . '/../../app/bootstrap.php';

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    include "../../DB_connection.php";
    require_once '../../vendor/autoload.php';
    
    use PhpOffice\PhpSpreadsheet\IOFactory;
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $class_id = $_POST['class_id'];
        $section_id = $_POST['section_id'];
        $academic_year = $_POST['academic_year'];
        
        if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == UPLOAD_ERR_OK) {
            $file_tmp_path = $_FILES['excel_file']['tmp_name'];
            $file_name = $_FILES['excel_file']['name'];
            
            $allowed_extensions = ['xlsx', 'xls'];
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            if (in_array($file_extension, $allowed_extensions)) {
                try {
                    $spreadsheet = IOFactory::load($file_tmp_path);
                    $worksheet = $spreadsheet->getActiveSheet();
                    $rows = $worksheet->toArray();
                    
                    // Remove header row
                    array_shift($rows);
                    
                    $success_count = 0;
                    $error_count = 0;
                    $errors = [];
                    
                    foreach ($rows as $index => $row) {
                        if (count($row) >= 4) {
                            $roll_number = trim($row[0]);
                            $student_name = trim($row[1]);
                            $term = trim($row[2]);
                            $total_marks = floatval($row[3]);
                            $gpa = isset($row[4]) ? floatval($row[4]) : null;
                            
                            // Validate term
                            $valid_terms = ['1st_term', '2nd_term', '3rd_term', '4th_term'];
                            if (!in_array($term, $valid_terms)) {
                                $errors[] = "Row " . ($index + 2) . ": Invalid term '$term'";
                                $error_count++;
                                continue;
                            }
                            
                            // Check if result already exists
                            $check_sql = "SELECT result_id FROM results 
                                        WHERE class_id = ? AND section_id = ? AND roll_number = ? 
                                        AND term = ? AND academic_year = ?";
                            $check_stmt = $conn->prepare($check_sql);
                            $check_stmt->execute([$class_id, $section_id, $roll_number, $term, $academic_year]);
                            
                            if ($check_stmt->rowCount() > 0) {
                                // Update existing
                                $update_sql = "UPDATE results SET 
                                             student_name = ?, total_marks = ?, gpa = ?, updated_at = CURRENT_TIMESTAMP
                                             WHERE class_id = ? AND section_id = ? AND roll_number = ? 
                                             AND term = ? AND academic_year = ?";
                                $update_stmt = $conn->prepare($update_sql);
                                $update_stmt->execute([$student_name, $total_marks, $gpa, 
                                                     $class_id, $section_id, $roll_number, $term, $academic_year]);
                                $success_count++;
                            } else {
                                // Insert new
                                $insert_sql = "INSERT INTO results 
                                             (class_id, section_id, roll_number, student_name, 
                                              academic_year, term, total_marks, gpa) 
                                             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                                $insert_stmt = $conn->prepare($insert_sql);
                                $insert_stmt->execute([$class_id, $section_id, $roll_number, $student_name,
                                                     $academic_year, $term, $total_marks, $gpa]);
                                $success_count++;
                            }
                        } else {
                            $errors[] = "Row " . ($index + 2) . ": Insufficient data";
                            $error_count++;
                        }
                    }
                    
                    $response = [
                        'success' => true,
                        'message' => "Import completed: $success_count records processed successfully, $error_count errors",
                        'details' => $errors
                    ];
                    
                    echo json_encode($response);
                    
                } catch (Exception $e) {
                    echo json_encode(['success' => false, 'message' => 'Error reading Excel file: ' . $e->getMessage()]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid file type. Please upload Excel files only.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No file uploaded or upload error.']);
        }
    }
}
?>