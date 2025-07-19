<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/event.php";

// For edit.php
if (isset($_GET['id'])) {
    $event = getEventById($conn, $_GET['id']);
    if (!$event) {
        header("Location: events.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'event_date' => $_POST['event_date'],
        'start_time' => $_POST['start_time'],
        'end_time' => $_POST['end_time'],
        'location' => $_POST['location'],
        'is_online' => isset($_POST['is_online']) ? 1 : 0
    ];
    
    if (isset($_GET['id'])) {
        // Update existing event
        if (updateEvent($conn, $_GET['id'], $data)) {
            header("Location: events.php?success=Event updated successfully");
        } else {
            header("Location: events.php?error=Failed to update event");
        }
    } else {
        // Add new event
        if (createEvent($conn, $data)) {
            header("Location: events.php?success=Event added successfully");
        } else {
            header("Location: events.php?error=Failed to add event");
        }
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= isset($event) ? 'Edit' : 'Add' ?> Event</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "inc/navbar.php" ?>
    
    <div class="container mt-5">
        <h2><?= isset($event) ? 'Edit' : 'Add' ?> Event</h2>
        
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" 
                       value="<?= isset($event) ? htmlspecialchars($event['title']) : '' ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3"><?= isset($event) ? htmlspecialchars($event['description']) : '' ?></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Event Date</label>
                    <input type="date" class="form-control" name="event_date" 
                           value="<?= isset($event) ? $event['event_date'] : '' ?>" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="time" class="form-control" name="start_time" 
                           value="<?= isset($event) ? $event['start_time'] : '' ?>" required>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label class="form-label">End Time</label>
                    <input type="time" class="form-control" name="end_time" 
                           value="<?= isset($event) ? $event['end_time'] : '' ?>" required>
                </div>
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_online" id="is_online" 
                           <?= isset($event) && $event['is_online'] ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_online">Online Event</label>
                </div>
            </div>
            
            <div class="mb-3" id="location_field">
                <label class="form-label">Location</label>
                <input type="text" class="form-control" name="location" 
                       value="<?= isset($event) ? htmlspecialchars($event['location']) : '' ?>">
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="events.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    
    <script>
        document.getElementById('is_online').addEventListener('change', function() {
            document.getElementById('location_field').style.display = this.checked ? 'none' : 'block';
        });
        
        // Initialize visibility on page load
        window.onload = function() {
            document.getElementById('location_field').style.display = 
                document.getElementById('is_online').checked ? 'none' : 'block';
        };
    </script>
</body>
</html>