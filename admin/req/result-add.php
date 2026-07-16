<?php
require_once __DIR__ . '/../../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;
Auth::requireAdmin();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Csrf::requireValidOrRedirect('../index.php');
}

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../DB_connection.php";
        
        $class_id = $_POST['class_id'];
        $section_id = $_POST['section_id'];
        $academic_year = $_POST['academic_year'];
        $roll_numbers = $_POST['roll_number'];
        $student_names = $_POST['student_name'];
        $terms = $_POST['term'];
        $total_marks = $_POST['total_marks'];
        $gpas = $_POST['gpa'];
        
        if (empty($class_id) || empty($section_id) || empty($academic_year)) {
            $em = "Required fields are missing";
            header("Location: ../result-add.php?error=$em");
            exit;
        }
        
        $success_count = 0;
        $error_count = 0;
        
        for ($i = 0; $i < count($roll_numbers); $i++) {
            if (!empty($roll_numbers[$i]) && !empty($student_names[$i]) && !empty($terms[$i]) && !empty($total_marks[$i])) {
                
                // Check if result already exists
                $check_sql = "SELECT result_id FROM results 
                            WHERE class_id = ? AND section_id = ? AND roll_number = ? 
                            AND term = ? AND academic_year = ?";
                $check_stmt = $conn->prepare($check_sql);
                $check_stmt->execute([$class_id, $section_id, $roll_numbers[$i], $terms[$i], $academic_year]);
                
                if ($check_stmt->rowCount() > 0) {
                    // Update existing
                    $sql = "UPDATE results SET 
                           student_name = ?, total_marks = ?, gpa = ?, updated_at = CURRENT_TIMESTAMP
                           WHERE class_id = ? AND section_id = ? AND roll_number = ? 
                           AND term = ? AND academic_year = ?";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([
                        $student_names[$i],
                        $total_marks[$i],
                        !empty($gpas[$i]) ? $gpas[$i] : null,
                        $class_id,
                        $section_id,
                        $roll_numbers[$i],
                        $terms[$i],
                        $academic_year
                    ]);
                } else {
                    // Insert new
                    $sql = "INSERT INTO results 
                           (class_id, section_id, roll_number, student_name, academic_year, term, total_marks, gpa) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $res = $stmt->execute([
                        $class_id,
                        $section_id,
                        $roll_numbers[$i],
                        $student_names[$i],
                        $academic_year,
                        $terms[$i],
                        $total_marks[$i],
                        !empty($gpas[$i]) ? $gpas[$i] : null
                    ]);
                }
                
                if ($res) {
                    $success_count++;
                } else {
                    $error_count++;
                }
            }
        }
        
        if ($success_count > 0) {
            $sm = "$success_count results added/updated successfully";
            if ($error_count > 0) {
                $sm .= ", $error_count failed";
            }
            header("Location: ../result-add.php?success=$sm");
            exit;
        } else {
            $em = "Failed to add results";
            header("Location: ../result-add.php?error=$em");
            exit;
        }
    } else {
        header("Location: ../../login.php");
        exit;
    } 
} else {
    header("Location: ../../login.php");
    exit;
}
?>