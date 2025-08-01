<?php
function getAllSubjects($conn) {
    $sql = "SELECT * FROM subjects ORDER BY CAST(subject_code AS UNSIGNED), subject_name";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    if ($stmt->rowCount() >= 1) {
        $subjects = $stmt->fetchAll();
        return $subjects;
    } else {
        return 0;
    }
}

function getSubjectById($subject_id, $conn) {
    $sql = "SELECT * FROM subjects WHERE subject_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$subject_id]);
    
    if ($stmt->rowCount() == 1) {
        $subject = $stmt->fetch();
        return $subject;
    } else {
        return 0;
    }
}

function removeSubject($id, $conn) {
    // First delete from junction table
    $sql = "DELETE FROM class_subjects WHERE subject_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    
    // Then delete the subject
    $sql = "DELETE FROM subjects WHERE subject_id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);
    return $res;
}

function getSubjectClasses($subject_id, $conn) {
    $sql = "SELECT c.* FROM class c 
            JOIN class_subjects cs ON c.class_id = cs.class_id 
            WHERE cs.subject_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$subject_id]);
    
    if ($stmt->rowCount() >= 1) {
        $classes = $stmt->fetchAll();
        return $classes;
    } else {
        return 0;
    }
}

function updateSubjectClasses($subject_id, $class_ids, $conn) {
    // First remove all existing associations
    $sql = "DELETE FROM class_subjects WHERE subject_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$subject_id]);
    
    // Then add new associations
    if (!empty($class_ids)) {
        $sql = "INSERT INTO class_subjects (subject_id, class_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        foreach ($class_ids as $class_id) {
            $stmt->execute([$subject_id, $class_id]);
        }
    }
    return true;
}
?>