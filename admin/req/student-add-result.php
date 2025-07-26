<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        
        if (isset($_POST['student_id']) &&
            isset($_POST['class'])      &&
            isset($_POST['section'])    &&
            isset($_POST['roll_number']) &&
            isset($_POST['total_marks']) &&
            isset($_POST['gpa'])         &&
            isset($_POST['rank'])        &&
            isset($_POST['year'])) {
            
            include '../../DB_connection.php';
            
            $student_id = $_POST['student_id'];
            $class = $_POST['class'];
            $section = $_POST['section'];
            $roll_number = $_POST['roll_number'];
            $total_marks = $_POST['total_marks'];
            $gpa = $_POST['gpa'];
            $rank = $_POST['rank'];
            $year = $_POST['year'];
            
            $data = 'student_id='.$student_id.'#change_password';
            
            if (empty($class)) {
                $em = "Class is required";
                header("Location: ../student-edit.php?rerror=$em&$data");
                exit;
            }else if (empty($section)) {
                $em = "Section is required";
                header("Location: ../student-edit.php?rerror=$em&$data");
                exit;
            }else if (empty($roll_number)) {
                $em = "Roll number is required";
                header("Location: ../student-edit.php?rerror=$em&$data");
                exit;
            }else if (empty($total_marks)) {
                $em = "Total marks is required";
                header("Location: ../student-edit.php?rerror=$em&$data");
                exit;
            }else if (empty($gpa)) {
                $em = "GPA is required";
                header("Location: ../student-edit.php?rerror=$em&$data");
                exit;
            }else if (empty($rank)) {
                $em = "Rank is required";
                header("Location: ../student-edit.php?rerror=$em&$data");
                exit;
            }else if (empty($year)) {
                $em = "Year is required";
                header("Location: ../student-edit.php?rerror=$em&$data");
                exit;
            }else {
                $sql = "INSERT INTO previous_results
                        (student_id, class, section, roll_number, total_marks, gpa, rank, year)
                        VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$student_id, $class, $section, $roll_number, $total_marks, $gpa, $rank, $year]);
                
                $sm = "Result added successfully";
                header("Location: ../student-edit.php?rsuccess=$sm&$data");
                exit;
            }
            
        }else {
            $em = "An error occurred";
            header("Location: ../student.php?error=$em");
            exit;
        }
        
    }else {
        header("Location: ../../logout.php");
        exit;
    } 
}else {
    header("Location: ../../logout.php");
    exit;
} 
?>