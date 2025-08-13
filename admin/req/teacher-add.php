<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../DB_connection.php";
        include "../data/teacher.php";
        
        // Required fields
        $required = [
            'fname', 'lname', 'username', 'pass', 'teacher_index', 'designation',
            'highest_qualification', 'address', 'employee_number', 'date_of_birth',
            'phone_number', 'gender', 'email_address', 'date_of_joined'
        ];
        
        // Check all required fields are present
        // Check all required fields are present
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                $em = ucfirst(str_replace('_', ' ', $field)) . " is required";
                header("Location: ../teacher-add.php?error=$em");
                exit;
            }
        }
        
        // Handle image upload
        $image_path = null;
        if (!empty($_FILES['image']['name'])) {
            $uploadDir = '../uploads/teachers/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $targetPath = $uploadDir . $fileName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image_path = str_replace('../', '', $targetPath);
            } else {
                $em = "Failed to upload image";
                header("Location: ../teacher-add.php?error=$em");
                exit;
            }
        }
        
        // Collect other form data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
        $pass = $_POST['pass'];
        $teacher_index = $_POST['teacher_index'];
        $designation = $_POST['designation'];
        $salary_code = $_POST['salary_code'] ?? '';
        $salary = $_POST['salary'] ?? 0;
        $highest_qualification = $_POST['highest_qualification'];
        $qualification_details = $_POST['qualification_details'] ?? '';
        $address = $_POST['address'];
        $employee_number = $_POST['employee_number'];
        $date_of_birth = $_POST['date_of_birth'];
        $phone_number = $_POST['phone_number'];
        $gender = $_POST['gender'];
        $email_address = $_POST['email_address'];
        $date_of_joined = $_POST['date_of_joined'];
        $years_of_experience = $_POST['years_of_experience'] ?? null;
        $marital_status = $_POST['marital_status'] ?? '';
        $bank_name = $_POST['bank_name'] ?? '';
        $bank_account = $_POST['bank_account'] ?? '';
        $emergency_contact = $_POST['emergency_contact'] ?? '';
        $emergency_phone = $_POST['emergency_phone'] ?? '';
        $notes = $_POST['notes'] ?? '';
        
        // Subjects and classes (arrays)
        $subjects = isset($_POST['subjects']) ? implode(',', $_POST['subjects']) : '';
        $classes = isset($_POST['classes']) ? implode(',', $_POST['classes']) : '';
        
        // Validate username and teacher index uniqueness
        if (!unameIsUnique($uname, $conn)) {
            $em = "Username is taken! try another";
            header("Location: ../teacher-add.php?error=$em");
            exit;
        }
        
        if (!teacherIndexIsUnique($teacher_index, $conn)) {
            $em = "Teacher Index is already in use! try another";
            header("Location: ../teacher-add.php?error=$em");
            exit;
        }
        
        // Hash password
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        
        // Build column list (add image_path only if uploaded)
        $columns = [
            'username','password','fname','lname','teacher_index','designation','salary_code','salary',
            'highest_qualification','qualification_details','subjects','classes_assigned','address',
            'employee_number','date_of_birth','phone_number','gender','email_address','date_of_joined',
            'years_of_experience','marital_status','bank_name','bank_account','emergency_contact',
            'emergency_phone','notes'
        ];
        if ($image_path) {
            $columns[] = 'image_path';
        }

        // Build placeholders to match column count
        $placeholders = rtrim(str_repeat('?, ', count($columns)), ', ');

        // Prepare SQL
        $sql = 'INSERT INTO teachers (' . implode(', ', $columns) . ') VALUES (' . $placeholders . ')';

        // Build params in the exact same order as $columns
        $params = [
            $uname, $pass, $fname, $lname, $teacher_index, $designation, $salary_code, $salary,
            $highest_qualification, $qualification_details, $subjects, $classes, $address,
            $employee_number, $date_of_birth, $phone_number, $gender, $email_address, $date_of_joined,
            $years_of_experience, $marital_status, $bank_name, $bank_account, $emergency_contact,
            $emergency_phone, $notes
        ];
        if ($image_path) {
            $params[] = $image_path;
        }

        // Execute
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        // (No need for a follow-up UPDATE; image_path is already stored if present)

        
        $sm = "New teacher registered successfully";
        header("Location: ../teacher-add.php?success=$sm");
        exit;
    } else {
        header("Location: ../../logout.php");
        exit;
    } 
} else {
    header("Location: ../../logout.php");
    exit;
}
?>