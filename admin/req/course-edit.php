<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include '../../DB_connection.php';
        include "../data/subject.php";
        
        $course_id = $_POST['course_id'];
        $course_name = $_POST['course_name'];
        $course_code = $_POST['course_code'];
        $class_ids = $_POST['class_ids'] ?? [];
        
        if (empty($course_name) || empty($course_code)) {
            $em = "Subject name and code are required";
            header("Location: ../course-edit.php?course_id=$course_id&error=$em");
            exit;
        } else {
            // Update the subject
            $sql = "UPDATE subjects SET subject_name=?, subject_code=? WHERE subject_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$course_name, $course_code, $course_id]);
            
            // Update class associations
            updateSubjectClasses($course_id, $class_ids, $conn);
            
            $sm = "Subject updated successfully";
            header("Location: ../course-edit.php?course_id=$course_id&success=$sm");
            exit;
        }
    } else {
        header("Location: ../course-edit.php?course_id=$course_id");
        exit;
    } 
} else {
    header("Location: ../course-edit.php?course_id=$course_id");
    exit;
}
?>