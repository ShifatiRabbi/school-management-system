<?php
require_once __DIR__ . '/../../app/bootstrap.php';

use App\Core\Auth;

Auth::requireAdmin();

include __DIR__ . '/../data/section.php';

$class_id = input_int('class_id', 'GET');
header('Content-Type: text/html; charset=UTF-8');

echo '<option value="">Select Section</option>';

if ($class_id <= 0) {
    exit;
}

$sections = getSectionsByClass($class_id, $conn);
if ($sections && count($sections) > 0) {
    foreach ($sections as $section) {
        echo '<option value="' . (int)$section['section_id'] . '">'
            . e($section['section_name'] ?? '')
            . '</option>';
    }
} else {
    echo '<option value="">No sections available</option>';
}
