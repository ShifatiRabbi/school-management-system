<?php
function getAllRoutines($conn) {
    $sql = "SELECT r.*, c.class_name, s.section_name 
            FROM class_routines r
            JOIN class c ON r.class_id = c.class_id
            JOIN section s ON r.section_id = s.section_id
            ORDER BY c.class_name, s.section_name";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getRoutineById($conn, $id) {
    $sql = "SELECT r.*, c.class_name, s.section_name 
            FROM class_routines r
            JOIN class c ON r.class_id = c.class_id
            JOIN section s ON r.section_id = s.section_id
            WHERE r.routine_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getRoutineByClassSection($conn, $class_id, $section_id) {
    $sql = "SELECT * FROM class_routines 
            WHERE class_id = ? AND section_id = ? AND is_active = 1
            ORDER BY upload_date DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id, $section_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function addRoutine($conn, $data) {
    $sql = "INSERT INTO class_routines (class_id, section_id, routine_image, uploaded_by) 
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$data['class_id'], $data['section_id'], $data['routine_image'], $data['uploaded_by']]);
}

function updateRoutine($conn, $id, $data) {
    $sql = "UPDATE class_routines 
            SET class_id = ?, section_id = ?, routine_image = ?, uploaded_by = ?
            WHERE routine_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$data['class_id'], $data['section_id'], $data['routine_image'], $data['uploaded_by'], $id]);
}

function deleteRoutine($conn, $id) {
    // First get the image path to delete the file
    $routine = getRoutineById($conn, $id);
    if ($routine && !empty($routine['routine_image'])) {
        $imagePath = "../".$routine['routine_image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
    
    $sql = "DELETE FROM class_routines WHERE routine_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}

function toggleRoutineStatus($conn, $id, $status) {
    $sql = "UPDATE class_routines SET is_active = ? WHERE routine_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$status, $id]);
}

function handleRoutineImageUpload($file) {
    $uploadDir = '../uploads/routines/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    
    $fileName = uniqid() . '_' . basename($file['name']);
    $targetPath = $uploadDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return str_replace('../', '', $targetPath);
    }
    return false;
}
?>