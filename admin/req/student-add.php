<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        

if (isset($_POST['fname']) &&
    isset($_POST['lname']) &&
    isset($_POST['username']) &&
    isset($_POST['pass'])     &&
    isset($_POST['address'])  &&
    isset($_POST['gender'])   &&
    isset($_POST['email_address']) &&
    isset($_POST['date_of_birth']) &&
    isset($_POST['father_name'])  &&
    isset($_POST['mother_name'])  &&
    isset($_POST['parent_phone_number']) &&
    isset($_POST['section_id']) &&
    isset($_POST['class_id'])   &&
    isset($_POST['roll_number'])) {
    
    include '../../DB_connection.php';
    include "../data/student.php";

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $pass = $_POST['pass'];

    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $parent_phone_number = $_POST['parent_phone_number'];

    $class_id = $_POST['class_id'];
    $section_id = $_POST['section_id'];
    $roll_number = $_POST['roll_number'];
    

    $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname.'&address='.$address.
            '&email='.$email_address.'&father_name='.$father_name.'&mother_name='.$mother_name.
            '&parent_phone='.$parent_phone_number;

    if (empty($fname)) {
        $em  = "First name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($lname)) {
        $em  = "Last name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($uname)) {
        $em  = "Username is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (!unameIsUnique($uname, $conn)) {
        $em  = "Username is taken! try another";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($pass)) {
        $em  = "Password is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($address)) {
        $em  = "Address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($gender)) {
        $em  = "Gender is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($email_address)) {
        $em  = "Email address is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($date_of_birth)) {
        $em  = "Date of birth is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($father_name)) {
        $em  = "Father's name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($mother_name)) {
        $em  = "Mother's name is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($parent_phone_number)) {
        $em  = "Parent phone number is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($section_id)) {
        $em  = "Section is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($class_id)) {
        $em  = "Class is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else if (empty($roll_number)) {
        $em  = "Roll number is required";
        header("Location: ../student-add.php?error=$em&$data");
        exit;
    }else {
        // hashing the password
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql  = "INSERT INTO
                 students(username, password, fname, lname, class_id, section_id, roll_number, 
                         address, gender, email_address, date_of_birth, 
                         father_name, mother_name, parent_phone_number)
                 VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname, $pass, $fname, $lname, $class_id, $section_id, $roll_number,
                       $address, $gender, $email_address, $date_of_birth, 
                       $father_name, $mother_name, $parent_phone_number]);
        $sm = "New student registered successfully";
        header("Location: ../student-add.php?success=$sm");
        exit;
    }
    
  }else {
    $em = "An error occurred";
    header("Location: ../student-add.php?error=$em");
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