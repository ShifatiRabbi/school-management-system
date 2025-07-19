<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/event.php";

if (isset($_GET['id'])) {
    if (deleteEvent($conn, $_GET['id'])) {
        header("Location: events.php?success=Event deleted successfully");
    } else {
        header("Location: events.php?error=Failed to delete event");
    }
    exit;
}

header("Location: events.php");
exit;
?>