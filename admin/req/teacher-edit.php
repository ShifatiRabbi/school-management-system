<?php 
session_start();
if ((isset($_SESSION['admin_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Admin') || 
    (isset($_SESSION['teacher_id']) && isset($_SESSION['role']) && $_SESSION['role'] == 'Teacher')) {
    if ($_SESSION['role'] == 'Admin') {
        include "../../DB_connection.php";
        include "../data/teacher.php";
        
        $teacher_id = $_POST['teacher_id'];
        if ($_SESSION['role'] === 'Teacher') {
            if (!isset($_SESSION['teacher_id']) || (int)$teacher_id !== (int)$_SESSION['teacher_id']) {
                header("Location: ../teacher-edit.php?error=".urlencode("Unauthorized request")."&teacher_id=".$teacher_id);
                exit;
            }
        }

        // Handle image upload (optional)
        $image_path = null;
        if (!empty($_FILES['image']['name'])) {
            $image_path = handleTeacherImageUpload($_FILES['image'], $teacher_id, $conn);
            if ($image_path === false) {
                $em = "Failed to upload image";
                header("Location: ../teacher-edit.php?error=$em&teacher_id=$teacher_id");
                exit;
            }
        }

        // Collect form data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
        $teacher_index = $_POST['teacher_index'];
        $designation = $_POST['designation'];
        $salary_code = $_POST['salary_code'] ?? '';
        $salary = ($_POST['salary'] === '' ? null : $_POST['salary']);
        $highest_qualification = $_POST['highest_qualification'];
        $qualification_details = $_POST['qualification_details'] ?? '';
        $address = $_POST['address'];
        $employee_number = $_POST['employee_number'];
        $date_of_birth = $_POST['date_of_birth'];
        $phone_number = $_POST['phone_number'];
        $gender = $_POST['gender'];
        $email_address = $_POST['email_address'];
        $date_of_joined = $_POST['date_of_joined'];
        $years_of_experience = ($_POST['years_of_experience'] === '' ? null : $_POST['years_of_experience']);
        $marital_status = $_POST['marital_status'] ?? '';
        $bank_name = $_POST['bank_name'] ?? '';
        $bank_account = $_POST['bank_account'] ?? '';
        $emergency_contact = $_POST['emergency_contact'] ?? '';
        $emergency_phone = $_POST['emergency_phone'] ?? '';
        $notes = $_POST['notes'] ?? '';

        $person_type = (isset($_POST['person_type']) && $_POST['person_type'] === 'staff') ? 'staff' : 'teacher';
        $work_description = $_POST['work_description'] ?? '';

        if ($person_type === 'staff' && empty($work_description)) {
            $em = "Work description is required for staff";
            header("Location: ../teacher-edit.php?error=".urlencode($em)."&teacher_id=".$teacher_id);
            exit;
        }

        $subjects = ($person_type === 'teacher' && isset($_POST['subjects'])) ? implode(',', $_POST['subjects']) : '';
        $classes  = ($person_type === 'teacher' && isset($_POST['classes']))  ? implode(',', $_POST['classes'])  : '';

        // Uniqueness checks (ignore current record)
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

        // Build UPDATE dynamically (include image_path only if uploaded)
        $cols = [
            'username' => $uname,
            'fname' => $fname,
            'lname' => $lname,
            'person_type' => $person_type,
            'teacher_index' => $teacher_index,
            'designation' => $designation,
            'salary_code' => $salary_code,
            'salary' => $salary,
            'highest_qualification' => $highest_qualification,
            'qualification_details' => $qualification_details,
            'work_description' => $work_description,
            'subjects' => $subjects,
            'classes_assigned' => $classes,
            'address' => $address,
            'employee_number' => $employee_number,
            'date_of_birth' => $date_of_birth,
            'phone_number' => $phone_number,
            'gender' => $gender,
            'email_address' => $email_address,
            'date_of_joined' => $date_of_joined,
            'years_of_experience' => $years_of_experience,
            'marital_status' => $marital_status,
            'bank_name' => $bank_name,
            'bank_account' => $bank_account,
            'emergency_contact' => $emergency_contact,
            'emergency_phone' => $emergency_phone,
            'notes' => $notes
        ];
        if ($image_path) {
            $cols['image_path'] = $image_path;
        }

        // Create "SET col=?" list and params in the same order
        $setParts = [];
        $params = [];
        foreach ($cols as $c => $v) {
            $setParts[] = "$c = ?";
            $params[] = $v;
        }
        $params[] = $teacher_id;

        $sql = "UPDATE teachers SET ".implode(', ', $setParts)." WHERE teacher_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        
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