<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/event.php";

$events = getAllEvents($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "inc/navbar.php" ?>
    
    <div class="container mt-5">
        <h2>Manage Events</h2>
        <a href="event-add.php" class="btn btn-primary mb-3">Add New Event</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr>
                    <td><?= htmlspecialchars($event['title']) ?></td>
                    <td><?= date('M d, Y', strtotime($event['event_date'])) ?></td>
                    <td><?= date('g:i a', strtotime($event['start_time'])) ?> - <?= date('g:i a', strtotime($event['end_time'])) ?></td>
                    <td><?= $event['is_online'] ? 'Online' : htmlspecialchars($event['location']) ?></td>
                    <td>
                        <a href="event-edit.php?id=<?= $event['event_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="event-delete.php?id=<?= $event['event_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>