<?php
include "../../DB_connection.php";
include "../data/section.php";
include "../data/class.php";

if (isset($_GET['class_id']) && is_numeric($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
    $sections = getSectionsByClass($class_id, $conn);
    
    if ($sections && count($sections) > 0) {
        echo '<option value="">Select Section</option>';
        foreach ($sections as $section) {
            echo '<option value="'.$section['section_id'].'">'.$section['section_name'].'</option>';
        }
    } else {
        echo '<option value="">No sections available</option>';
    }
} else {
    echo '<option value="">Select Section</option>';
}
?>