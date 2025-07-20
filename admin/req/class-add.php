<?php 

include '../../DB_connection.php';
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        
        $class_name = $_POST['class_name'];
        $discipline = $_POST['discipline'];
        
        if (empty($class_name)) {
            $em = "Class name is required";
            header("Location: ../class-add.php?error=$em");
            exit;
        } else {
            $sql = "INSERT INTO class (class_name, discipline) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$class_name, $discipline]);
            
            $sm = "New class created successfully";
            header("Location: ../class-add.php?success=$sm");
            exit;
        }
    } else {
        header("Location: ../class-add.php");
        exit;
    } 
} else {
    header("Location: ../class-add.php");
    exit;
}
?>