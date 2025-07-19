<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/news.php";

$news_items = getAllNews($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include "inc/navbar.php" ?>
    
    <div class="container mt-5">
        <h2>Manage News</h2>
        <a href="news-add.php" class="btn btn-primary mb-3">Add New News</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Publish Date</th>
                    <th>Short Description</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news_items as $news): ?>
                <tr>
                    <td><?= htmlspecialchars($news['title']) ?></td>
                    <td><?= date('M d, Y', strtotime($news['publish_date'])) ?></td>
                    <td><?= htmlspecialchars($news['short_description']) ?></td>
                    <td><?= $news['is_featured'] ? 'Yes' : 'No' ?></td>
                    <td>
                        <a href="news-edit.php?id=<?= $news['news_id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="news-delete.php?id=<?= $news['news_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>