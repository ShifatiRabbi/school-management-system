<?php
include "DB_connection.php";
include "admin/data/notice.php";

if (isset($_GET['id'])) {
    $notice = getNoticeById($conn, $_GET['id']);
    if ($notice) {
        $notice_date = new DateTime($notice['notice_date']);
        $notice['formatted_date'] = $notice_date->format('d M, Y');
        echo json_encode($notice);
    }
}
?>