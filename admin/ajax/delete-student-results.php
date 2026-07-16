<?php
require_once __DIR__ . '/../../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

header('Content-Type: application/json; charset=UTF-8');

if (!Auth::is(Auth::ROLE_ADMIN) || empty($_SESSION['admin_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$token = $_POST['_csrf'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
if (!Csrf::validate(is_string($token) ? $token : null)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}

if (!isset($_POST['roll_number'], $_POST['class_id'], $_POST['section_id'], $_POST['academic_year'])) {
    echo json_encode(['success' => false, 'message' => 'Missing parameters']);
    exit;
}

$sql = "DELETE FROM results
        WHERE roll_number = ? AND class_id = ? AND section_id = ? AND academic_year = ?";
$stmt = $conn->prepare($sql);

if ($stmt->execute([
    trim((string)$_POST['roll_number']),
    (int)$_POST['class_id'],
    (int)$_POST['section_id'],
    trim((string)$_POST['academic_year']),
])) {
    echo json_encode(['success' => true, 'message' => 'Student results deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete student results']);
}
