<?php
session_start();

if (!isset($_SESSION['teacher_id'], $_SESSION['role']) || $_SESSION['role'] !== 'Teacher') {
    header("Location: ../index.php");
    exit;
}

include "../../DB_connection.php";
include "../../admin/data/teacher.php"; // reuses helpers: getTeacherById, unameIsUnique, teacherIndexIsUnique

$teacher_id = (int)($_POST['teacher_id'] ?? 0);
if ($teacher_id !== (int)$_SESSION['teacher_id']) {
    header("Location: ../teacher-edit.php?error=Unauthorized request");
    exit;
}

/* Required fields (same as your form) */
$required = [
    'fname','lname','username','teacher_index','designation','highest_qualification',
    'address','employee_number','date_of_birth','phone_number','gender',
    'email_address','date_of_joined'
];
foreach ($required as $f) {
    if (empty($_POST[$f])) {
        $em = ucfirst(str_replace('_',' ',$f))." is required";
        header("Location: ../teacher-edit.php?error=".urlencode($em));
        exit;
    }
}

/* Collect fields */
$fname  = trim($_POST['fname']);
$lname  = trim($_POST['lname']);
$uname  = trim($_POST['username']);
$teacher_index = trim($_POST['teacher_index']);
$designation   = trim($_POST['designation']);
$salary_code   = $_POST['salary_code'] ?? '';
$salary        = $_POST['salary'] !== '' ? (float)$_POST['salary'] : null;
$highest_qualification = trim($_POST['highest_qualification']);
$qualification_details = $_POST['qualification_details'] ?? '';
$address       = trim($_POST['address']);
$employee_number = trim($_POST['employee_number']);
$date_of_birth = $_POST['date_of_birth'];
$phone_number  = trim($_POST['phone_number']);
$gender        = $_POST['gender'];
$email_address = trim($_POST['email_address']);
$date_of_joined = $_POST['date_of_joined'];
$years_of_experience = $_POST['years_of_experience'] !== '' ? (int)$_POST['years_of_experience'] : null;
$marital_status = $_POST['marital_status'] ?? '';
$bank_name      = $_POST['bank_name'] ?? '';
$bank_account   = $_POST['bank_account'] ?? '';
$emergency_contact = $_POST['emergency_contact'] ?? '';
$emergency_phone   = $_POST['emergency_phone'] ?? '';
$notes             = $_POST['notes'] ?? '';

$subjects = isset($_POST['subjects']) ? implode(',', $_POST['subjects']) : '';
$classes  = isset($_POST['classes'])  ? implode(',', $_POST['classes'])  : '';

/* Uniqueness checks (ignore self) */
if (!unameIsUnique($uname, $conn, $teacher_id)) {
    header("Location: ../teacher-edit.php?error=".urlencode("Username is taken! Try another"));
    exit;
}
if (!teacherIndexIsUnique($teacher_index, $conn, $teacher_id)) {
    header("Location: ../teacher-edit.php?error=".urlencode("Teacher Index already in use! Try another"));
    exit;
}

/* Optional image upload (store as 'uploads/teachers/xxx', delete old one) */
$image_path = null;
if (!empty($_FILES['image']['name'])) {
    $curr = getTeacherById($teacher_id, $conn);
    $uploadDirFS = realpath(__DIR__ . "/../../admin") . "/uploads/teachers/";
    if (!is_dir($uploadDirFS)) { mkdir($uploadDirFS, 0777, true); }

    // remove old image if present
    if (!empty($curr['image_path'])) {
        $old = realpath(__DIR__ . "/../../admin/" . $curr['image_path']);
        if ($old && is_file($old)) { @unlink($old); }
    }

    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $fileName = "teacher_{$teacher_id}_" . time() . "." . preg_replace('/[^a-zA-Z0-9]/','', $ext);
    $targetFS = $uploadDirFS . $fileName;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFS)) {
        $image_path = "uploads/teachers/" . $fileName; // relative to /admin/
    } else {
        header("Location: ../teacher-edit.php?error=".urlencode("Failed to upload image"));
        exit;
    }
}

/* Build UPDATE dynamically (include image_path only if new image uploaded) */
$cols = [
 'username' => $uname,
 'fname' => $fname,
 'lname' => $lname,
 'teacher_index' => $teacher_index,
 'designation' => $designation,
 'salary_code' => $salary_code,
 'salary' => $salary,
 'highest_qualification' => $highest_qualification,
 'qualification_details' => $qualification_details,
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
if ($image_path) { $cols['image_path'] = $image_path; }

$set = [];
$params = [];
foreach ($cols as $c => $v) {
    $set[] = "$c = ?";
    $params[] = $v;
}
$params[] = $teacher_id;

$sql = "UPDATE teachers SET ".implode(', ', $set)." WHERE teacher_id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute($params);

header("Location: ../teacher-edit.php?success=".urlencode("Profile updated successfully"));
exit;
