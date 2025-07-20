<?php 
include '../../DB_connection.php';
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        
        $class_id = $_POST['class_id'];
        $section_name = $_POST['section_name'];
        $male_students = $_POST['male_students'] ?? 0;
        $female_students = $_POST['female_students'] ?? 0;
        
        if (empty($class_id) || empty($section_name)) {
            $em = "Class and section name are required";
            header("Location: ../section-add.php?error=$em");
            exit;
        } else {
            $sql = "INSERT INTO section (class_id, section_name, male_students, female_students) 
                    VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$class_id, $section_name, $male_students, $female_students]);
            
            $sm = "New section created successfully";
            header("Location: ../section-add.php?success=$sm");
            exit;
        }
    } else {
        header("Location: ../section-add.php");
        exit;
    } 
} else {
    header("Location: ../section-add.php");
    exit;
}
?>