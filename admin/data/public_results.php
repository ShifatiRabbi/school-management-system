<?php

function getAllResults($exam_type, $conn) {
    $sql = "SELECT * FROM public_results 
            WHERE exam_type = ? 
            ORDER BY year DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$exam_type]);
    return $stmt->fetchAll();
}

function getResultSummary($exam_type, $conn) {
    $sql = "SELECT 
                SUM(appeared) as total_appeared,
                SUM(passed) as total_passed,
                SUM(failed) as total_failed,
                SUM(a_plus) as total_a_plus,
                AVG(pass_rate) as avg_pass_rate,
                AVG(a_plus_rate) as avg_a_plus_rate,
                AVG(CAST(REGEXP_REPLACE(national_rank, '[^0-9]', '') AS UNSIGNED)) as avg_national_rank,
                AVG(CAST(REGEXP_REPLACE(board_rank, '[^0-9]', '') AS UNSIGNED)) as avg_board_rank,
                AVG(CAST(REGEXP_REPLACE(division_rank, '[^0-9]', '') AS UNSIGNED)) as avg_division_rank,
                AVG(CAST(REGEXP_REPLACE(district_rank, '[^0-9]', '') AS UNSIGNED)) as avg_district_rank,
                COUNT(*) as years_count
            FROM public_results 
            WHERE exam_type = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$exam_type]);
    return $stmt->fetch();
}

function addResult($exam_type, $year, $board, $appeared, $passed, $failed, $a_plus, $pass_rate, $a_plus_rate, $national_rank, $board_rank, $division_rank, $district_rank, $conn) {
    $sql = "INSERT INTO public_results 
            (exam_type, year, board, appeared, passed, failed, a_plus, pass_rate, a_plus_rate, national_rank, board_rank, division_rank, district_rank)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$exam_type, $year, $board, $appeared, $passed, $failed, $a_plus, $pass_rate, $a_plus_rate, $national_rank, $board_rank, $division_rank, $district_rank]);
}

function deleteResult($id, $conn) {
    $sql = "DELETE FROM public_results WHERE id = ?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$id]);
}