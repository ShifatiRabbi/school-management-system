<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../DB_connection.php";
        include "../data/section.php";
        
        $section_id = $_POST['section_id'];
        $class_id = $_POST['class_id'];
        $section_name = $_POST['section_name'];
        $male_students = $_POST['male_students'] ?? 0;
        $female_students = $_POST['female_students'] ?? 0;
        
        $data = 'section_id='.$section_id;

        if (empty($section_id)) {
            $em = "Section ID is required";
            header("Location: ../section-edit.php?error=$em&$data");
            exit;
        } else if (empty($class_id)) {
            $em = "Class is required";
            header("Location: ../section-edit.php?error=$em&$data");
            exit;
        } else if (empty($section_name)) {
            $em = "Section name is required";
            header("Location: ../section-edit.php?error=$em&$data");
            exit;
        } else {
            // Check if section name already exists in the same class (excluding current section)
            $sql_check = "SELECT * FROM section 
                         WHERE section_name=? AND class_id=? AND section_id!=?";
            $stmt_check = $conn->prepare($sql_check);
            $stmt_check->execute([$section_name, $class_id, $section_id]);
            
            if ($stmt_check->rowCount() > 0) {
                $em = "The section name already exists in this class";
                header("Location: ../section-edit.php?error=$em&$data");
                exit;
            } else {
                // Update the section
                $sql = "UPDATE section 
                       SET class_id=?, section_name=?, male_students=?, female_students=?
                       WHERE section_id=?";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$class_id, $section_name, $male_students, $female_students, $section_id]);
                
                $sm = "Section updated successfully";
                header("Location: ../section-edit.php?success=$sm&section_id=$section_id");
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