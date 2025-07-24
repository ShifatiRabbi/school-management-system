<?php
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../DB_connection.php";
        include "../data/teacher.php";
        
        if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == UPLOAD_ERR_OK) {
            // Check file extension
            $fileExt = pathinfo($_FILES['csvFile']['name'], PATHINFO_EXTENSION);
            if (strtolower($fileExt) != 'csv') {
                header("Location: ../teacher.php?error=Invalid file type. Please upload a CSV file.");
                exit;
            }
            
            // Move uploaded file
            $uploadDir = "../../uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $fileName = "teacher_import_" . time() . ".csv";
            $filePath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['csvFile']['tmp_name'], $filePath)) {
                // Process CSV
                $result = importTeachersFromCSV($filePath, $conn);
                
                // Delete the file after processing
                unlink($filePath);
                
                if ($result['imported'] > 0) {
                    $successMsg = "Successfully imported " . $result['imported'] . " teachers.";
                    if (!empty($result['errors'])) {
                        $errorMsg = " Some records failed: " . implode(", ", array_slice($result['errors'], 0, 3));
                        if (count($result['errors']) > 3) {
                            $errorMsg .= " and " . (count($result['errors']) - 3) . " more.";
                        }
                    }
                    header("Location: ../teacher.php?success=" . urlencode($successMsg) . 
                          (isset($errorMsg) ? "&error=" . urlencode($errorMsg) : ""));
                } else {
                    $errorMsg = "No teachers imported. Errors: " . implode(", ", $result['errors']);
                    header("Location: ../teacher.php?error=" . urlencode($errorMsg));
                }
            } else {
                header("Location: ../teacher.php?error=File upload failed");
            }
        } else {
            header("Location: ../teacher.php?error=Please select a CSV file");
        }
    } else {
        header("Location: ../../logout.php");
        exit;
    }
} else {
    header("Location: ../../logout.php");
    exit;
}
?>