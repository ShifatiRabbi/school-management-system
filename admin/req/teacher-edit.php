<?php 
session_start();
if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../DB_connection.php";
        include "../data/teacher.php";
        
        // Required fields
        $required = [
            'teacher_id', 'fname', 'lname', 'username', 'teacher_index', 'designation',
            'highest_qualification', 'address', 'employee_number', 'date_of_birth',
            'phone_number', 'gender', 'email_address', 'date_of_joined'
        ];
        
        // Check all required fields are present
        foreach ($required as $field) {
            if (empty($_POST[$field])) {
                $em = ucfirst(str_replace('_', ' ', $field)) . " is required";
                header("Location: ../teacher-edit.php?error=$em&teacher_id=".$_POST['teacher_id']);
                exit;
            }
        }
        
        $teacher_id = $_POST['teacher_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
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
        if (!unameIsUnique($uname, $conn, $teacher_id)) {
            $em = "Username is taken! try another";
            header("Location: ../teacher-edit.php?error=$em&teacher_id=$teacher_id");
            exit;
        }
        
        if (!teacherIndexIsUnique($teacher_index, $conn, $teacher_id)) {
            $em = "Teacher Index is already in use! try another";
            header("Location: ../teacher-edit.php?error=$em&teacher_id=$teacher_id");
            exit;
        }
        
        // Update teacher
        $sql = "UPDATE teachers SET
                username = ?, fname = ?, lname = ?, teacher_index = ?, designation = ?, 
                salary_code = ?, salary = ?, highest_qualification = ?, qualification_details = ?, 
                subjects = ?, classes_assigned = ?, address = ?, employee_number = ?, 
                date_of_birth = ?, phone_number = ?, gender = ?, email_address = ?, 
                date_of_joined = ?, years_of_experience = ?, marital_status = ?, 
                bank_name = ?, bank_account = ?, emergency_contact = ?, 
                emergency_phone = ?, notes = ?
                WHERE teacher_id = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $uname, $fname, $lname, $teacher_index, $designation, $salary_code, $salary,
            $highest_qualification, $qualification_details, $subjects, $classes, $address,
            $employee_number, $date_of_birth, $phone_number, $gender, $email_address, $date_of_joined,
            $years_of_experience, $marital_status, $bank_name, $bank_account, $emergency_contact,
            $emergency_phone, $notes, $teacher_id
        ]);
        
        $sm = "Teacher updated successfully";
        header("Location: ../teacher-edit.php?success=$sm&teacher_id=$teacher_id");
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