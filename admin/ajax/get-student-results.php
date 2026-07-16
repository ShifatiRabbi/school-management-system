<?php
require_once __DIR__ . '/../../app/bootstrap.php';

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    include "../../DB_connection.php";
    include "../data/class.php";
    include "../data/section.php";
    include "../data/result.php";
    
    if (isset($_GET['class_id']) && isset($_GET['section_id']) && isset($_GET['roll_number']) && isset($_GET['academic_year'])) {
        $class_id = $_GET['class_id'];
        $section_id = $_GET['section_id'];
        $roll_number = $_GET['roll_number'];
        $academic_year = $_GET['academic_year'];
        
        $class = getClassById($class_id, $conn);
        $section = getSectioById($section_id, $conn);
        $results = getStudentResults($roll_number, $class_id, $section_id, $academic_year, $conn);
        
        if ($results != 0) {
            $student_name = $results[0]['student_name'];
            $total_marks = array_sum(array_column($results, 'total_marks'));
            $avg_marks = $total_marks / count($results);
            
            // Calculate average GPA
            $gpas = array_filter(array_column($results, 'gpa'));
            $avg_gpa = count($gpas) > 0 ? array_sum($gpas) / count($gpas) : null;
?>
<div class="card border-0 shadow-lg">
    <div class="card-header gradient-bg text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-user-graduate me-2"></i>
                Individual Result - <?= htmlspecialchars($student_name) ?>
            </h4>
            <div>
                <span class="badge bg-light text-dark me-2">Roll: <?= htmlspecialchars($roll_number) ?></span>
                <span class="badge bg-light text-dark me-2"><?= $class['class_name'] ?></span>
                <span class="badge bg-light text-dark">Section: <?= $section['section_name'] ?></span>
            </div>
        </div>
    </div>
    
    <div class="card-body">
        <!-- Student Info -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-info-circle me-2"></i>Student Information</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Name:</strong> <?= htmlspecialchars($student_name) ?></p>
                                <p class="mb-2"><strong>Roll Number:</strong> <?= htmlspecialchars($roll_number) ?></p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2"><strong>Class:</strong> <?= $class['class_name'] ?></p>
                                <p class="mb-2"><strong>Section:</strong> <?= $section['section_name'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-light">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Academic Year</h6>
                        <h3 class="text-primary"><?= $academic_year ?></h3>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Results Table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Term</th>
                        <th>Total Marks</th>
                        <th>GPA</th>
                        <th>Grade</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $term_order = ['1st_term', '2nd_term', '3rd_term', '4th_term'];
                    $term_data = [];
                    foreach ($results as $result) {
                        $term_data[$result['term']] = $result;
                    }
                    
                    foreach ($term_order as $term):
                        if (isset($term_data[$term])):
                            $result = $term_data[$term];
                            $gpa = $result['gpa'];
                            $grade = '';
                            $status = '';
                            
                            if ($gpa >= 3.75) {
                                $grade = 'A+';
                                $status = 'Excellent';
                            } elseif ($gpa >= 3.50) {
                                $grade = 'A';
                                $status = 'Very Good';
                            } elseif ($gpa >= 3.00) {
                                $grade = 'A-';
                                $status = 'Good';
                            } elseif ($gpa >= 2.50) {
                                $grade = 'B';
                                $status = 'Satisfactory';
                            } else {
                                $grade = 'C';
                                $status = 'Needs Improvement';
                            }
                    ?>
                    <tr>
                        <td>
                            <span class="badge term-badge term-<?= $term[0] ?>">
                                <?= ucfirst(str_replace('_', ' ', $term)) ?>
                            </span>
                        </td>
                        <td class="fw-bold"><?= number_format($result['total_marks'], 2) ?></td>
                        <td>
                            <?php if ($gpa): ?>
                            <span class="badge bg-success"><?= number_format($gpa, 2) ?></span>
                            <?php else: ?>
                            <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $grade ?></td>
                        <td>
                            <span class="badge 
                                <?= $status == 'Excellent' ? 'bg-success' : '' ?>
                                <?= $status == 'Very Good' ? 'bg-info' : '' ?>
                                <?= $status == 'Good' ? 'bg-primary' : '' ?>
                                <?= $status == 'Satisfactory' ? 'bg-warning' : '' ?>
                                <?= $status == 'Needs Improvement' ? 'bg-danger' : '' ?>
                            ">
                                <?= $status ?>
                            </span>
                        </td>
                        <td>
                            <a href="result-edit-single.php?result_id=<?= $result['result_id'] ?>" 
                               class="btn btn-sm btn-warning">
                               <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="deleteSingleResult(<?= $result['result_id'] ?>)" 
                                    class="btn btn-sm btn-danger">
                               <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php else: ?>
                    <tr>
                        <td>
                            <span class="badge term-badge term-<?= $term[0] ?>">
                                <?= ucfirst(str_replace('_', ' ', $term)) ?>
                            </span>
                        </td>
                        <td colspan="5" class="text-center text-muted">
                            <i class="fas fa-times me-2"></i>No result recorded
                        </td>
                    </tr>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </tbody>
            </table>
        </div>
        
        <!-- Performance Summary -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-success text-white">
                    <div class="card-body text-center">
                        <h6>Total Marks</h6>
                        <h2 class="mb-0"><?= number_format($total_marks, 2) ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-info text-white">
                    <div class="card-body text-center">
                        <h6>Average Marks</h6>
                        <h2 class="mb-0"><?= number_format($avg_marks, 2) ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-primary text-white">
                    <div class="card-body text-center">
                        <h6>Average GPA</h6>
                        <h2 class="mb-0"><?= $avg_gpa ? number_format($avg_gpa, 2) : '-' ?></h2>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Performance Chart (Simple) -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Performance Trend</h5>
                    </div>
                    <div class="card-body">
                        <div class="progress" style="height: 30px;">
                            <?php 
                            $terms_with_marks = array_filter($term_data);
                            $term_count = count($terms_with_marks);
                            if ($term_count > 0):
                                foreach ($terms_with_marks as $term => $data):
                                    $percentage = ($data['total_marks'] / 500) * 100; // Assuming 500 is max
                                    $color = '';
                                    if ($percentage >= 80) $color = 'bg-success';
                                    elseif ($percentage >= 60) $color = 'bg-info';
                                    elseif ($percentage >= 40) $color = 'bg-warning';
                                    else $color = 'bg-danger';
                            ?>
                            <div class="progress-bar <?= $color ?>" style="width: <?= 100/$term_count ?>%">
                                <?= ucfirst(substr($term, 0, 1)) ?>: <?= number_format($data['total_marks'], 0) ?>
                            </div>
                            <?php 
                                endforeach;
                            else:
                            ?>
                            <div class="w-100 text-center py-2 text-muted">
                                No performance data available
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteSingleResult(resultId) {
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
<?php
        } else {
            echo '<div class="alert alert-warning text-center py-5">
                    <i class="fas fa-user-times fa-3x mb-3"></i>
                    <h4>No Results Found</h4>
                    <p>No results found for Roll Number: <strong>' . htmlspecialchars($roll_number) . '</strong> in the selected class and section.</p>
                    <a href="result-add.php" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Results
                    </a>
                  </div>';
        }
    }
}
?>