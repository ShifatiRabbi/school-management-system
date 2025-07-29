<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: routine.php");
    exit;
}

include "../DB_connection.php";
include "data/routine.php";

$routine_id = $_GET['id'];

if (deleteRoutine($conn, $routine_id)) {
    header("Location: routine.php?success=Routine deleted successfully");
} else {
    header("Location: routine.php?error=Failed to delete routine");
}
exit;
?>