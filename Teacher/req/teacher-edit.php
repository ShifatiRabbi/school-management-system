<?php
require_once __DIR__ . '/../../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;
use App\Helpers\Upload;

Auth::requireTeacher();
Csrf::requireValidOrRedirect('../teacher-edit.php');

include __DIR__ . '/../../admin/data/teacher.php';

$teacher_id = (int)($_POST['teacher_id'] ?? 0);
if ($teacher_id !== (int)$_SESSION['teacher_id']) {
    redirect_with_error('../teacher-edit.php', 'Unauthorized request');
}

$curr = getTeacherById($teacher_id, $conn);
if (!$curr) {
    redirect_with_error('../teacher-edit.php', 'Teacher not found');
}

$required = [
    'fname', 'lname', 'username', 'teacher_index', 'designation', 'highest_qualification',
    'address', 'employee_number', 'date_of_birth', 'phone_number', 'gender',
    'email_address', 'date_of_joined',
];
foreach ($required as $f) {
    if (empty($_POST[$f])) {
        redirect_with_error('../teacher-edit.php', ucfirst(str_replace('_', ' ', $f)) . ' is required');
    }
}

$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$uname = trim($_POST['username']);
$teacher_index = trim($_POST['teacher_index']);
$designation = trim($_POST['designation']);
$highest_qualification = trim($_POST['highest_qualification']);
$qualification_details = $_POST['qualification_details'] ?? '';
$address = trim($_POST['address']);
$employee_number = trim($_POST['employee_number']);
$date_of_birth = $_POST['date_of_birth'];
$phone_number = trim($_POST['phone_number']);
$gender = $_POST['gender'];
$email_address = trim($_POST['email_address']);
$date_of_joined = $_POST['date_of_joined'];
$years_of_experience = $_POST['years_of_experience'] !== '' ? (int)$_POST['years_of_experience'] : null;
$marital_status = $_POST['marital_status'] ?? '';
$emergency_contact = $_POST['emergency_contact'] ?? '';
$emergency_phone = $_POST['emergency_phone'] ?? '';
$notes = $_POST['notes'] ?? '';

if (!unameIsUnique($uname, $conn, $teacher_id)) {
    redirect_with_error('../teacher-edit.php', 'Username is taken! Try another');
}
if (!teacherIndexIsUnique($teacher_index, $conn, $teacher_id)) {
    redirect_with_error('../teacher-edit.php', 'Teacher Index already in use! Try another');
}

$image_path = null;
if (!empty($_FILES['image']['name'])) {
    $uploadDir = __DIR__ . '/../../uploads/teachers/';
    $result = Upload::store(
        $_FILES['image'],
        $uploadDir,
        $config['upload']['image_ext'],
        $config['upload']['image_mime'],
        $config['upload']['max_image_bytes']
    );
    if (!$result['ok']) {
        redirect_with_error('../teacher-edit.php', $result['error']);
    }
    if (!empty($curr['image_path'])) {
        $old = __DIR__ . '/../../' . ltrim($curr['image_path'], '/');
        if (is_file($old)) {
            @unlink($old);
        }
    }
    $image_path = 'uploads/teachers/' . $result['filename'];
}

// Teachers may not change salary, bank, subjects, or class assignments
$cols = [
    'username' => $uname,
    'fname' => $fname,
    'lname' => $lname,
    'teacher_index' => $teacher_index,
    'designation' => $designation,
    'highest_qualification' => $highest_qualification,
    'qualification_details' => $qualification_details,
    'address' => $address,
    'employee_number' => $employee_number,
    'date_of_birth' => $date_of_birth,
    'phone_number' => $phone_number,
    'gender' => $gender,
    'email_address' => $email_address,
    'date_of_joined' => $date_of_joined,
    'years_of_experience' => $years_of_experience,
    'marital_status' => $marital_status,
    'emergency_contact' => $emergency_contact,
    'emergency_phone' => $emergency_phone,
    'notes' => $notes,
];
if ($image_path) {
    $cols['image_path'] = $image_path;
}

$set = [];
$params = [];
foreach ($cols as $c => $v) {
    $set[] = "$c = ?";
    $params[] = $v;
}
$params[] = $teacher_id;

$sql = 'UPDATE teachers SET ' . implode(', ', $set) . ' WHERE teacher_id = ?';
$stmt = $conn->prepare($sql);
$stmt->execute($params);

redirect_with_success('../teacher-edit.php', 'Profile updated successfully');
