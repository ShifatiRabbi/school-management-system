<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../DB_connection.php";
        include "../data/class.php";
        include "../data/subject.php";
        
        $class_id = $_POST['class_id'];
        $class_name = $_POST['class_name'];
        $discipline = $_POST['discipline'];
        $subject_ids = $_POST['subject_ids'] ?? [];
        
        $data = 'class_id='.$class_id;

        if (empty($class_id)) {
            $em = "Class id is required";
            header("Location: ../class-edit.php?error=$em&$data");
            exit;
        } else if (empty($class_name)) {
            $em = "Class name is required";
            header("Location: ../class-edit.php?error=$em&$data");
            exit;
        } else {
            // Check if class name already exists (excluding current class)
            $sql_check = "SELECT * FROM class WHERE class_name=? AND class_id!=?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->execute([$class_name, $class_id]);
            
            if ($stmt_check->rowCount() > 0) {
                $em = "The class name already exists";
                header("Location: ../class-edit.php?error=$em&$data");
                exit;
            } else {
                // Update the class
                $sql = "UPDATE class SET class_name=?, discipline=? WHERE class_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$class_name, $discipline, $class_id]);
                
                // Update subject associations
                // First remove all existing associations
                $sql = "DELETE FROM class_subjects WHERE class_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$class_id]);
                
                // Then add new associations
                if (!empty($subject_ids)) {
                    $sql = "INSERT INTO class_subjects (class_id, subject_id) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    foreach ($subject_ids as $subject_id) {
                        $stmt->execute([$class_id, $subject_id]);
                    }
                }
                
                $sm = "Class updated successfully";
                header("Location: ../class-edit.php?success=$sm&$data");
                exit;
            }
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