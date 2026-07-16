<?php
function getAllClasses($conn) {
    $sql = "SELECT * FROM class ORDER BY class_name";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    if ($stmt->rowCount() >= 1) {
        $classes = $stmt->fetchAll();
        return $classes;
    } else {
        return 0;
    }
}

function getClassById($class_id, $conn) {
    $sql = "SELECT * FROM class WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    
    if ($stmt->rowCount() == 1) {
        $class = $stmt->fetch();
        return $class;
    } else {
        return 0;
    }
}

function removeClass($id, $conn) {
    // First check if any sections exist for this class
    $sql = "SELECT * FROM section WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    
    if ($stmt->rowCount() > 0) {
        return false; // Can't delete class with sections
    }
    
    $sql = "DELETE FROM class WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $res = $stmt->execute([$id]);
    return $res;
}

function getSectionsByClass($class_id, $conn) {
    $sql = "SELECT * FROM section WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    
    if ($stmt->rowCount() >= 1) {
        $sections = $stmt->fetchAll();
        return $sections;
    } else {
        return 0;
    }
}

function getTotalStudentsInClass($class_id, $conn) {
    $sql = "SELECT SUM(male_students + female_students) as total FROM section WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    $result = $stmt->fetch();
    return $result['total'] ?? 0;
}

function getClassSubjects($class_id, $conn) {
    $sql = "SELECT s.* FROM subjects s 
            JOIN class_subjects cs ON s.subject_id = cs.subject_id 
            WHERE cs.class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    
    if ($stmt->rowCount() >= 1) {
        $subjects = $stmt->fetchAll();
        return $subjects;
    } else {
        return 0;
    }
}

function getMaleStudentsInClass($class_id, $conn) {
    $sql = "SELECT SUM(male_students) as total FROM section WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    $result = $stmt->fetch();
    return $result['total'] ?? 0;
}

function getFemaleStudentsInClass($class_id, $conn) {
    $sql = "SELECT SUM(female_students) as total FROM section WHERE class_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id]);
    $result = $stmt->fetch();
    return $result['total'] ?? 0;
}
?>