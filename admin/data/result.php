<?php
// Get aggregated class results
function getClassResultsAggregated($class_id, $section_id, $academic_year, $conn) {
    $sql = "SELECT 
                roll_number,
                student_name,
                MAX(CASE WHEN term = '1st_term' THEN total_marks END) as term1_marks,
                MAX(CASE WHEN term = '1st_term' THEN gpa END) as term1_gpa,
                MAX(CASE WHEN term = '2nd_term' THEN total_marks END) as term2_marks,
                MAX(CASE WHEN term = '2nd_term' THEN gpa END) as term2_gpa,
                MAX(CASE WHEN term = '3rd_term' THEN total_marks END) as term3_marks,
                MAX(CASE WHEN term = '3rd_term' THEN gpa END) as term3_gpa,
                MAX(CASE WHEN term = '4th_term' THEN total_marks END) as term4_marks,
                MAX(CASE WHEN term = '4th_term' THEN gpa END) as term4_gpa,
                AVG(total_marks) as final_marks,
                AVG(gpa) as avg_gpa
            FROM results
            WHERE class_id = ? AND section_id = ? AND academic_year = ?
            GROUP BY roll_number, student_name
            ORDER BY CAST(roll_number AS UNSIGNED)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id, $section_id, $academic_year]);
    
    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll();
    } else {
        return 0;
    }
}

// Get individual student results
function getStudentResults($roll_number, $class_id, $section_id, $academic_year, $conn) {
    $sql = "SELECT * FROM results 
            WHERE roll_number = ? AND class_id = ? AND section_id = ? AND academic_year = ?
            ORDER BY 
                CASE term 
                    WHEN '1st_term' THEN 1
                    WHEN '2nd_term' THEN 2
                    WHEN '3rd_term' THEN 3
                    WHEN '4th_term' THEN 4
                END";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$roll_number, $class_id, $section_id, $academic_year]);
    
    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll();
    } else {
        return 0;
    }
}

// Insert result
function insertResult($data, $conn) {
    $sql = "INSERT INTO results (class_id, section_id, roll_number, student_name, academic_year, term, total_marks, gpa) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $data['class_id'],
        $data['section_id'],
        $data['roll_number'],
        $data['student_name'],
        $data['academic_year'],
        $data['term'],
        $data['total_marks'],
        $data['gpa']
    ]);
}

// Update result
function updateResult($result_id, $data, $conn) {
    $sql = "UPDATE results SET 
            roll_number = ?, student_name = ?, term = ?, total_marks = ?, gpa = ?, 
            academic_year = ?, updated_at = CURRENT_TIMESTAMP
            WHERE result_id = ?";
    
    $stmt = $conn->prepare($sql);
    return $stmt->execute([
        $data['roll_number'],
        $data['student_name'],
        $data['term'],
        $data['total_marks'],
        $data['gpa'],
        $data['academic_year'],
        $result_id
    ]);
}

// Delete result
function deleteResult($result_id, $conn) {
    $sql = "DELETE FROM results WHERE result_id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$result_id]);
}

// Get result by ID
function getResultById($result_id, $conn) {
    $sql = "SELECT r.*, c.class_name, s.section_name
            FROM results r
            JOIN class c ON r.class_id = c.class_id
            JOIN section sec ON r.section_id = sec.section_id
            WHERE r.result_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$result_id]);
    
    if ($stmt->rowCount() == 1) {
        return $stmt->fetch();
    } else {
        return 0;
    }
}

// Get academic years from results
function getAcademicYears($conn) {
    $sql = "SELECT DISTINCT academic_year FROM results ORDER BY academic_year DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll();
    } else {
        // Return current year as default
        $current_year = date('Y');
        $next_year = $current_year + 1;
        return [['academic_year' => $current_year . '-' . $next_year]];
    }
}

// Check if result exists
function resultExists($class_id, $section_id, $roll_number, $term, $academic_year, $conn) {
    $sql = "SELECT result_id FROM results 
            WHERE class_id = ? AND section_id = ? AND roll_number = ? 
            AND term = ? AND academic_year = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$class_id, $section_id, $roll_number, $term, $academic_year]);
    
    return $stmt->rowCount() > 0;
}
?>