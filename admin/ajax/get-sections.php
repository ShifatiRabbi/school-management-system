<?php
require_once __DIR__ . '/../../app/bootstrap.php';

use App\Core\Auth;

header('Content-Type: application/json; charset=UTF-8');

if (!Auth::is(Auth::ROLE_ADMIN) || empty($_SESSION['admin_id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

include __DIR__ . '/../data/section.php';

$class_id = input_int('class_id', 'GET');
if ($class_id <= 0) {
    echo json_encode([]);
    exit;
}

$sections = getSectionsByClass($class_id, $conn);
$out = [];
if ($sections) {
    foreach ($sections as $section) {
        $out[] = [
            'section_id' => (int)$section['section_id'],
            'section_name' => $section['section_name'] ?? '',
        ];
    }
}
echo json_encode($out);
