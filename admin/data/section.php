<?php
function getAllSections($conn) {
    $sql = "SELECT s.*, c.class_name FROM section s 
            JOIN class c ON s.class_id = c.class_id 
            ORDER BY c.class_name, s.section_name";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    if ($stmt->rowCount() >= 1) {
        $sections = $stmt->fetchAll();
        return $sections;
    } else {
        return 0;
    }
}

function getSectioById($section_id, $conn) {
    $sql = "SELECT * FROM section WHERE section_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$section_id]);
    
    if ($stmt->rowCount() == 1) {
        $section = $stmt->fetch();
        return $section;
    } else {
        return 0;
    }
}

function removeSection($id, $conn) {
    $sql = "DELETE FROM section WHERE section_id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);
    return $res;
}

function getTotalStudentsInSection($section_id, $conn) {
    $sql = "SELECT (male_students + female_students) as total FROM section WHERE section_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$section_id]);
    $result = $stmt->fetch();
    return $result['total'] ?? 0;
}
?>