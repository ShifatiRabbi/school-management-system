<?php
require_once __DIR__ . '/../app/bootstrap.php';

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/class.php";
        include "data/section.php";
        include "data/result.php";
        
        $classes = getAllClasses($conn);
        $academic_years = getAcademicYears($conn);
        $current_year = date('Y');
        $next_year = $current_year + 1;
        $default_year = $current_year . '-' . $next_year;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .result-row {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .result-row:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        
        .remove-row {
            color: #dc3545;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .remove-row:hover {
            color: #bd2130;
        }
        
        .add-row-btn {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .add-row-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(79, 172, 254, 0.4);
        }
        
        .term-select {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            border: none;
        }
        
        .term-select option {
            background: white;
            color: #333;
        }
        
        .year-badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    
    <div class="container mt-5">
        <div class="card border-0 shadow-lg">
            <div class="card-header gradient-bg py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Results</h3>
                    <a href="results.php" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Results
                    </a>
                </div>
            </div>
            
            <div class="card-body p-4">
                <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['error']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET['success']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
                
                <form method="post" action="req/result-add.php" id="addResultForm">
            <?= csrf_field() ?>
                    <!-- Academic Year -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-calendar-alt me-2"></i>Academic Year</h5>
                                    <select class="form-select" name="academic_year" required>
                                        <?php foreach ($academic_years as $year): ?>
                                        <option value="<?= $year['academic_year'] ?>" 
                                                <?= $year['academic_year'] == $default_year ? 'selected' : '' ?>>
                                            <?= $year['academic_year'] ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-info-circle me-2"></i>Instructions</h5>
                                    <p class="mb-0 text-muted">
                                        Fill in student details for each term. You can add multiple rows for multiple students.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Class and Section Selection -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Select Class</label>
                            <select class="form-select" name="class_id" id="classSelect" required>
                                <option value="">Choose Class...</option>
                                <?php foreach ($classes as $class): ?>
                                <option value="<?= $class['class_id'] ?>">
                                    <?= $class['class_name'] ?> - <?= $class['discipline'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Select Section</label>
                            <select class="form-select" name="section_id" id="sectionSelect" disabled required>
                                <option value="">Select Class First</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Result Entry Rows -->
                    <div id="resultRows">
                        <div class="result-row">
                            <div class="row g-3">
                                <div class="col-md-2">
                                    <label class="form-label">Roll Number</label>
                                    <input type="text" class="form-control" name="roll_number[]" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Student Name</label>
                                    <input type="text" class="form-control" name="student_name[]" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Term</label>
                                    <select class="form-select term-select" name="term[]" required>
                                        <option value="1st_term">1st Term</option>
                                        <option value="2nd_term">2nd Term</option>
                                        <option value="3rd_term">3rd Term</option>
                                        <option value="4th_term">4th Term</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Total Marks</label>
                                    <input type="number" step="0.01" class="form-control" name="total_marks[]" required>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">GPA (Optional)</label>
                                    <input type="number" step="0.01" min="0" max="4.00" class="form-control" name="gpa[]">
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-row" onclick="removeRow(this)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Add More Row Button -->
                    <div class="text-center mt-4">
                        <button type="button" class="btn add-row-btn" onclick="addRow()">
                            <i class="fas fa-plus me-2"></i>Add Another Row
                        </button>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save me-2"></i>Save All Results
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Class selection
            $('#classSelect').change(function() {
                const classId = $(this).val();
                if (classId) {
                    $('#sectionSelect').prop('disabled', false);
                    $.ajax({
                        url: 'ajax/get-sections.php',
                        type: 'GET',
                        data: { class_id: classId },
                        success: function(data) {
                            $('#sectionSelect').html(data);
                        }
                    });
                } else {
                    $('#sectionSelect').prop('disabled', true).html('<option value="">Select Class First</option>');
                }
            });
        });
        
        let rowCount = 1;
        
        function addRow() {
            rowCount++;
            const newRow = `
                <div class="result-row" id="row-${rowCount}">
                    <div class="row g-3">
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="roll_number[]" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="student_name[]" required>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select term-select" name="term[]" required>
                                <option value="1st_term">1st Term</option>
                                <option value="2nd_term">2nd Term</option>
                                <option value="3rd_term">3rd Term</option>
                                <option value="4th_term">4th Term</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="number" step="0.01" class="form-control" name="total_marks[]" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" step="0.01" min="0" max="4.00" class="form-control" name="gpa[]">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-row" onclick="removeRow(this)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `;
            
            $('#resultRows').append(newRow);
        }
        
        function removeRow(button) {
            if ($('.result-row').length > 1) {
                $(button).closest('.result-row').remove();
            } else {
                alert('At least one row is required.');
            }
        }
    </script>
</body>
</html>
<?php 
    } else {
        header("Location: ../login.php");
        exit;
    } 
} else {
    header("Location: ../login.php");
    exit;
}
?>