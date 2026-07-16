<?php
require_once __DIR__ . '/../../app/bootstrap.php';

use App\Core\Auth;
use App\Core\Csrf;

header('Content-Type: application/json; charset=UTF-8');

if (!Auth::is(Auth::ROLE_ADMIN) || !isset($_SESSION['admin_id'])) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['_csrf'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? null;
    if (!Csrf::validate(is_string($token) ? $token : null)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
        exit;
    }
}

include __DIR__ . '/../data/result.php';

$result_id = input_int('result_id');
if ($result_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid result']);
    exit;
}

if (deleteResult($result_id, $conn)) {
    echo json_encode(['success' => true, 'message' => 'Result deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete result']);
}
