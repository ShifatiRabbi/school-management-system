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
    <title>Admin - Results Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .gradient-bg {
            background: var(--primary-gradient);
            color: white;
        }
        
        .result-type-btn {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .result-type-btn.active {
            border-color: #667eea;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .dynamic-field {
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .mark-cell {
            font-weight: bold;
            position: relative;
        }
        
        .mark-cell.high {
            color: #28a745;
        }
        
        .mark-cell.medium {
            color: #ffc107;
        }
        
        .mark-cell.low {
            color: #dc3545;
        }
        
        .hover-shadow {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .result-table th {
            background: #f8f9fa;
            position: sticky;
            top: 0;
        }
        
        .floating-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }
        
        .term-badge {
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.8em;
            font-weight: 600;
        }
        
        .term-1 { background: #e3f2fd; color: #1976d2; }
        .term-2 { background: #e8f5e9; color: #388e3c; }
        .term-3 { background: #fff3e0; color: #f57c00; }
        .term-4 { background: #fce4ec; color: #c2185b; }
        
        @media (max-width: 768px) {
            .glass-card {
                margin: 10px;
                padding: 15px;
            }
            
            .floating-action-btn {
                bottom: 20px;
                right: 20px;
                width: 50px;
                height: 50px;
            }
        }
    </style>
</head>
<body>
    <?php include "inc/navbar.php"; ?>
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="glass-card p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0"><i class="fas fa-chart-line text-primary me-2"></i>Results Management</h2>
                        <div>
                            <button class="btn btn-primary" onclick="exportToExcel()">
                                <i class="fas fa-file-excel me-2"></i>Export Excel
                            </button>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importModal">
                                <i class="fas fa-file-import me-2"></i>Import Excel
                            </button>
                        </div>
                    </div>
                    
                    <!-- Academic Year Selection -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-calendar-alt me-2"></i>Academic Year</h5>
                                    <select class="form-select" id="academicYear">
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
                    </div>
                    
                    <!-- Result Type Selection -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title mb-3"><i class="fas fa-filter me-2"></i>Select Result Type</h5>
                                    <div class="d-flex flex-wrap gap-3">
                                        <button type="button" 
                                                class="btn btn-lg result-type-btn glass-card flex-grow-1 active" 
                                                id="classResultBtn" 
                                                data-type="class">
                                            <i class="fas fa-users fa-2x mb-2"></i><br>
                                            <span>Class Results</span>
                                        </button>
                                        <button type="button" 
                                                class="btn btn-lg result-type-btn glass-card flex-grow-1" 
                                                id="individualResultBtn" 
                                                data-type="individual">
                                            <i class="fas fa-user-graduate fa-2x mb-2"></i><br>
                                            <span>Individual Results</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Class Result Form -->
                    <div id="classResultForm" class="dynamic-field">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header gradient-bg">
                                <h4 class="mb-0"><i class="fas fa-users me-2"></i>Class Results</h4>
                            </div>
                            <div class="card-body">
                                <form id="classResultFormSubmit" class="row g-3">
                                    <div class="col-md-4">
                                        <label for="classSelect" class="form-label">Select Class</label>
                                        <select class="form-select form-control-lg" id="classSelect" name="class_id" required>
                                            <option value="">Choose Class...</option>
                                            <?php foreach ($classes as $class): ?>
                                            <option value="<?= $class['class_id'] ?>">
                                                <?= $class['class_name'] ?> - <?= $class['discipline'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <label for="sectionSelect" class="form-label">Select Section</label>
                                        <select class="form-select form-control-lg" id="sectionSelect" name="section_id" disabled required>
                                            <option value="">Select Class First</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-search me-2"></i>Show Results
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Individual Result Form -->
                    <div id="individualResultForm" class="dynamic-field" style="display: none;">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header" style="background: var(--secondary-gradient);">
                                <h4 class="mb-0 text-white"><i class="fas fa-user-graduate me-2"></i>Individual Results</h4>
                            </div>
                            <div class="card-body">
                                <form id="individualResultFormSubmit" class="row g-3">
                                    <div class="col-md-3">
                                        <label for="indClassSelect" class="form-label">Class</label>
                                        <select class="form-select form-control-lg" id="indClassSelect" name="class_id" required>
                                            <option value="">Choose Class...</option>
                                            <?php foreach ($classes as $class): ?>
                                            <option value="<?= $class['class_id'] ?>">
                                                <?= $class['class_name'] ?> - <?= $class['discipline'] ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="indSectionSelect" class="form-label">Section</label>
                                        <select class="form-select form-control-lg" id="indSectionSelect" name="section_id" disabled required>
                                            <option value="">Select Class First</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <label for="rollNumber" class="form-label">Roll Number</label>
                                        <input type="text" class="form-control form-control-lg" id="rollNumber" name="roll_number" placeholder="Enter Roll Number" required>
                                    </div>
                                    
                                    <div class="col-md-3 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary btn-lg w-100" style="background: var(--secondary-gradient); border: none;">
                                            <i class="fas fa-user-check me-2"></i>Show Result
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Results Display Area -->
                    <div id="resultsDisplay" class="mt-4"></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Floating Action Button -->
    <a href="result-add.php" class="floating-action-btn gradient-bg text-white">
        <i class="fas fa-plus fa-lg"></i>
    </a>
    
    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header gradient-bg text-white">
                    <h5 class="modal-title"><i class="fas fa-file-import me-2"></i>Import Results from Excel</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="importForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="importClass" class="form-label">Class</label>
                                <select class="form-select" id="importClass" name="class_id" required>
                                    <option value="">Choose Class...</option>
                                    <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class['class_id'] ?>">
                                        <?= $class['class_name'] ?> - <?= $class['discipline'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="importSection" class="form-label">Section</label>
                                <select class="form-select" id="importSection" name="section_id" disabled required>
                                    <option value="">Select Class First</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="importYear" class="form-label">Academic Year</label>
                                <select class="form-select" id="importYear" name="academic_year" required>
                                    <?php foreach ($academic_years as $year): ?>
                                    <option value="<?= $year['academic_year'] ?>" 
                                            <?= $year['academic_year'] == $default_year ? 'selected' : '' ?>>
                                        <?= $year['academic_year'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="excelFile" class="form-label">Excel File</label>
                                <input type="file" class="form-control" id="excelFile" name="excel_file" accept=".xlsx,.xls" required>
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle me-2"></i>Excel Format Required:</h6>
                            <ul class="mb-0">
                                <li>Column A: Roll Number</li>
                                <li>Column B: Student Name</li>
                                <li>Column C: Term (1st_term, 2nd_term, 3rd_term, 4th_term)</li>
                                <li>Column D: Total Marks</li>
                                <li>Column E: GPA (optional)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i>Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            const academicYear = $('#academicYear').val();
            
            // Update year in all forms
            function updateYearInForms() {
                const year = $('#academicYear').val();
                // You can add year to form submissions if needed
                console.log('Academic year selected:', year);
            }
            
            $('#academicYear').change(updateYearInForms);
            
            // Result type switching
            $('.result-type-btn').click(function() {
                $('.result-type-btn').removeClass('active');
                $(this).addClass('active');
                
                const type = $(this).data('type');
                if (type === 'class') {
                    $('#classResultForm').slideDown(300);
                    $('#individualResultForm').slideUp(300);
                } else {
                    $('#classResultForm').slideUp(300);
                    $('#individualResultForm').slideDown(300);
                }
            });
            
            // Class selection for class results
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
            
            // Class selection for individual results
            $('#indClassSelect').change(function() {
                const classId = $(this).val();
                if (classId) {
                    $('#indSectionSelect').prop('disabled', false);
                    $.ajax({
                        url: 'ajax/get-sections.php',
                        type: 'GET',
                        data: { class_id: classId },
                        success: function(data) {
                            $('#indSectionSelect').html(data);
                        }
                    });
                } else {
                    $('#indSectionSelect').prop('disabled', true).html('<option value="">Select Class First</option>');
                }
            });
            
            // Class selection for import
            $('#importClass').change(function() {
                const classId = $(this).val();
                if (classId) {
                    $('#importSection').prop('disabled', false);
                    $.ajax({
                        url: 'ajax/get-sections.php',
                        type: 'GET',
                        data: { class_id: classId },
                        success: function(data) {
                            $('#importSection').html(data);
                        }
                    });
                } else {
                    $('#importSection').prop('disabled', true).html('<option value="">Select Class First</option>');
                }
            });
            
            // Class result form submission
            $('#classResultFormSubmit').submit(function(e) {
                e.preventDefault();
                const classId = $('#classSelect').val();
                const sectionId = $('#sectionSelect').val();
                const year = $('#academicYear').val();
                
                if (classId && sectionId) {
                    $.ajax({
                        url: 'ajax/get-class-results.php',
                        type: 'GET',
                        data: { 
                            class_id: classId, 
                            section_id: sectionId,
                            academic_year: year 
                        },
                        beforeSend: function() {
                            $('#resultsDisplay').html(`
                                <div class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-3">Loading results...</p>
                                </div>
                            `);
                        },
                        success: function(data) {
                            $('#resultsDisplay').html(data);
                            initializeDataTable();
                        }
                    });
                }
            });
            
            // Individual result form submission
            $('#individualResultFormSubmit').submit(function(e) {
                e.preventDefault();
                const classId = $('#indClassSelect').val();
                const sectionId = $('#indSectionSelect').val();
                const rollNumber = $('#rollNumber').val();
                const year = $('#academicYear').val();
                
                if (classId && sectionId && rollNumber) {
                    $.ajax({
                        url: 'ajax/get-student-results.php',
                        type: 'GET',
                        data: { 
                            class_id: classId, 
                            section_id: sectionId,
                            roll_number: rollNumber,
                            academic_year: year
                        },
                        beforeSend: function() {
                            $('#resultsDisplay').html(`
                                <div class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-3">Loading student results...</p>
                                </div>
                            `);
                        },
                        success: function(data) {
                            $('#resultsDisplay').html(data);
                        }
                    });
                }
            });
            
            // Import form handling
            $('#importForm').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                $.ajax({
                    url: 'ajax/import-results.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#importModal .modal-footer button[type="submit"]')
                            .prop('disabled', true)
                            .html('<span class="spinner-border spinner-border-sm me-2"></span>Importing...');
                    },
                    success: function(response) {
                        $('#importModal .modal-footer button[type="submit"]')
                            .prop('disabled', false)
                            .html('<i class="fas fa-upload me-2"></i>Import Data');
                        
                        try {
                            const result = JSON.parse(response);
                            if (result.success) {
                                alert('Results imported successfully!');
                                $('#importModal').modal('hide');
                                $('#importForm')[0].reset();
                                $('#importSection').prop('disabled', true).html('<option value="">Select Class First</option>');
                            } else {
                                alert('Error: ' + result.message);
                            }
                        } catch (e) {
                            alert('Error parsing server response');
                        }
                    },
                    error: function() {
                        $('#importModal .modal-footer button[type="submit"]')
                            .prop('disabled', false)
                            .html('<i class="fas fa-upload me-2"></i>Import Data');
                        alert('Error uploading file');
                    }
                });
            });
        });
        
        function initializeDataTable() {
            $('#resultsTable').DataTable({
                pageLength: 25,
                order: [[0, 'asc']],
                dom: '<"row"<"col-md-6"l><"col-md-6"f>>tip',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search results..."
                }
            });
        }
        
        function exportToExcel() {
            const table = document.getElementById('resultsTable');
            if (table) {
                const ws = XLSX.utils.table_to_sheet(table);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Results");
                XLSX.writeFile(wb, "results_" + $('#academicYear').val() + ".xlsx");
            } else {
                alert('No results to export. Please generate results first.');
            }
        }
        
        function deleteResult(resultId) {
            if (confirm('Are you sure you want to delete this result?')) {
                $.ajax({
                    url: 'ajax/delete-result.php',
                    type: 'POST',
                    data: { result_id: resultId },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.success) {
                            location.reload();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    }
                });
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