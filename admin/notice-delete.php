<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/notice.php";

if (isset($_GET['id'])) {
    if (deleteNotice($conn, $_GET['id'])) {
        header("Location: notices.php?success=Notice deleted successfully");
    } else {
        header("Location: notices.php?error=Failed to delete notice");
    }
    exit;
}

header("Location: notices.php");
exit;
?>