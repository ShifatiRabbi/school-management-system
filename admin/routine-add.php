<?php
session_start();
if (!isset($_SESSION['admin_id']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/class.php";
include "data/section.php";

$classes = getAllClasses($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['class_id']) || !isset($_POST['section_id']) || !isset($_FILES['routine_image'])) {
        header("Location: routine-add.php?error=All fields are required");
        exit;
    }
    
    $class_id = $_POST['class_id'];
    $section_id = $_POST['section_id'];
    $uploaded_by = $_SESSION['admin_id'];
    
    // Handle file upload
    $imagePath = handleRoutineImageUpload($_FILES['routine_image']);
    if (!$imagePath) {
        header("Location: routine-add.php?error=Failed to upload routine image");
        exit;
    }
    
    // Check if routine already exists for this class-section
    $existingRoutine = getRoutineByClassSection($conn, $class_id, $section_id);
    if ($existingRoutine) {
        // Deactivate old routine
        toggleRoutineStatus($conn, $existingRoutine['routine_id'], 0);
    }
    
    // Add new routine
    $data = [
        'class_id' => $class_id,
        'section_id' => $section_id,
        'routine_image' => $imagePath,
        'uploaded_by' => $uploaded_by
    ];
    
    if (addRoutine($conn, $data)) {
        header("Location: routine.php?success=Routine added successfully");
    } else {
        header("Location: routine-add.php?error=Failed to add routine");
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Class Routine</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .image-preview {
            max-height: 300px;
            object-fit: contain;
            display: none;
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    
    <div class="container mt-5">
        <a href="routine.php" class="btn btn-dark">Go Back</a>
        
        <form method="post" class="shadow p-4 mt-5" enctype="multipart/form-data" style="max-width: 800px; margin: 0 auto;">
            <h3 class="text-center mb-4">Add New Class Routine</h3>
            
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?=htmlspecialchars($_GET['error'])?>
                </div>
            <?php } ?>
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="class_id" class="form-label">Class</label>
                    <select class="form-select" id="class_id" name="class_id" required>
                        <option value="">Select Class</option>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?=$class['class_id']?>"><?=$class['class_name']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="section_id" class="form-label">Section</label>
                    <select class="form-select" id="section_id" name="section_id" required disabled>
                        <option value="">Select Section</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="routine_image" class="form-label">Routine Image</label>
                <input type="file" class="form-control" id="routine_image" name="routine_image" accept="image/*" required>
                <small class="text-muted">Upload a clear image of the class routine (JPG/PNG)</small>
                <div class="mt-3 text-center">
                    <img id="imagePreview" class="image-preview img-thumbnail">
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-4">Upload Routine</button>
            </div>
        </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Class-Section dynamic dropdown
        $('#class_id').change(function() {
            const classId = $(this).val();
            if (classId) {
                $('#section_id').prop('disabled', false);
                $.ajax({
                    url: 'req/get-sections.php',
                    type: 'GET',
                    data: { class_id: classId },
                    success: function(data) {
                        $('#section_id').html(data);
                    }
                });
            } else {
                $('#section_id').prop('disabled', true).html('<option value="">Select Section</option>');
            }
        });
        
        // Image preview
        $('#routine_image').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>