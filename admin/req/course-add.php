<?php 

session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include '../../DB_connection.php';
        include "../data/subject.php";
        
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];
        $class_ids = $_POST['class_ids'] ?? [];
        
        if (empty($course_name) || empty($course_code)) {
            $em = "Subject name and code are required";
            header("Location: ../course-add.php?error=$em");
            exit;
        } else {
            // Insert the subject
            $sql = "INSERT INTO subjects (subject_name, subject_code) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$course_name, $course_code]);
            $subject_id = $conn->lastInsertId();
            
            // Add class associations
            if (!empty($class_ids)) {
                $sql = "INSERT INTO class_subjects (subject_id, class_id) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                foreach ($class_ids as $class_id) {
                    $stmt->execute([$subject_id, $class_id]);
                }
            }
            
            $sm = "New subject created successfully";
            header("Location: ../course-add.php?success=$sm");
            exit;
        }
    } else {
        header("Location: ../course-add.php");
        exit;
    } 
} else {
    header("Location: ../course-add.php");
    exit;
}
?>