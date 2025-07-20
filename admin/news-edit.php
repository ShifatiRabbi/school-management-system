<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/news.php";

$news = null;
if (isset($_GET['id'])) {
    $news = getNewsById($conn, $_GET['id']);
    if (!$news) {
        header("Location: news.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'short_description' => $_POST['short_description'],
        'image_path' => $news['image_path'], // Keep existing if not updated
        'publish_date' => $_POST['publish_date'],
        'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
        'news_category' => $_POST['news_category'],
        'author' => $_POST['author']
    ];
    
    // Handle image upload if new file is provided
    if (isset($_FILES['news_image']) && $_FILES['news_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/news/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = uniqid() . '_' . basename($_FILES['news_image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['news_image']['tmp_name'], $targetPath)) {
            // Delete old image if exists
            if ($news['image_path'] && file_exists('../' . $news['image_path'])) {
                unlink('../' . $news['image_path']);
            }
            $data['image_path'] = 'uploads/news/' . $fileName;
        }
    }
    
    if (updateNews($conn, $_GET['id'], $data)) {
        header("Location: news.php?success=News updated successfully");
    } else {
        header("Location: news.php?error=Failed to update news");
    }
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit News</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include "inc/navbar.php" ?>
    
    <div class="container mt-5">
        <h2>Edit News</h2>
        
        <form method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" 
                       value="<?= htmlspecialchars($news['title']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Short Description</label>
                <textarea class="form-control" name="short_description" rows="3" required><?= 
                    htmlspecialchars($news['short_description']) ?></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="5" required><?= 
                    htmlspecialchars($news['content']) ?></textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Publish Date</label>
                    <input type="date" class="form-control" name="publish_date" 
                           value="<?= $news['publish_date'] ?>" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Category</label>
                    <select class="form-select" name="news_category" required>
                        <option value="Academic" <?= $news['news_category'] == 'Academic' ? 'selected' : '' ?>>Academic</option>
                        <option value="Event" <?= $news['news_category'] == 'Event' ? 'selected' : '' ?>>Event</option>
                        <option value="Achievement" <?= $news['news_category'] == 'Achievement' ? 'selected' : '' ?>>Achievement</option>
                        <option value="General" <?= $news['news_category'] == 'General' ? 'selected' : '' ?>>General</option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" 
                           value="<?= htmlspecialchars($news['author']) ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Featured Image</label>
                    <input type="file" class="form-control" name="news_image" accept="image/*">
                    <?php if ($news['image_path']): ?>
                    <div class="mt-2">
                        <small>Current Image:</small><br>
                        <img src="../<?= $news['image_path'] ?>" style="max-height: 100px;">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="is_featured" id="is_featured"
                       <?= $news['is_featured'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="is_featured">Featured News</label>
            </div>
            
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="news.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>