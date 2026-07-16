<?php
require_once __DIR__ . '/../../app/bootstrap.php';

if (isset($_SESSION['admin_id']) && isset($_SESSION['role'])) {
    include "../../DB_connection.php";
    include "../data/class.php";
    include "../data/section.php";
    include "../data/result.php";
    
    if (isset($_GET['class_id']) && isset($_GET['section_id']) && isset($_GET['academic_year'])) {
        $class_id = $_GET['class_id'];
        $section_id = $_GET['section_id'];
        $academic_year = $_GET['academic_year'];
        
        $class = getClassById($class_id, $conn);
        $section = getSectioById($section_id, $conn);
        $results = getClassResultsAggregated($class_id, $section_id, $academic_year, $conn);
        
        if ($results != 0) {
?>
<div class="card border-0 shadow-lg">
    <div class="card-header gradient-bg text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">
                <i class="fas fa-chart-bar me-2"></i>
                Results - <?= $class['class_name'] ?> | Section: <?= $section['section_name'] ?> | Year: <?= $academic_year ?>
            </h4>
            <span class="badge bg-light text-dark fs-6">Total Students: <?= count($results) ?></span>
        </div>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered" id="resultsTable">
                <thead class="table-light">
                    <tr>
                        <th>Roll No.</th>
                        <th>Student Name</th>
                        <th>1st Term</th>
                        <th>2nd Term</th>
                        <th>3rd Term</th>
                        <th>4th Term</th>
                        <th>Final Marks</th>
                        <th>Avg. GPA</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result): 
                        // Calculate mark class based on percentage
                        $max_possible = 500; // Assuming 500 is max
                        $final_percentage = ($result['final_marks'] / $max_possible) * 100;
                        $mark_class = 'high';
                        if ($final_percentage < 40) $mark_class = 'low';
                        elseif ($final_percentage < 60) $mark_class = 'medium';
                        
                        // Format term marks
                        $terms = [
                            '1st' => $result['term1_marks'],
                            '2nd' => $result['term2_marks'],
                            '3rd' => $result['term3_marks'],
                            '4th' => $result['term4_marks']
                        ];
                    ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($result['roll_number']) ?></td>
                        <td><?= htmlspecialchars($result['student_name']) ?></td>
                        
                        <?php foreach ($terms as $term => $marks): ?>
                        <td class="text-center">
                            <?php if ($marks): ?>
                            <span class="term-badge term-<?= $term[0] ?>">
                                <?= number_format($marks, 2) ?>
                                <?php if (${'result["term' . $term[0] . '_gpa"]'}): ?>
                                <br><small class="text-muted">GPA: <?= number_format(${'result["term' . $term[0] . '_gpa"]'}, 2) ?></small>
                                <?php endif; ?>
                            </span>
                            <?php else: ?>
                            <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <?php endforeach; ?>
                        
                        <td class="text-center mark-cell <?= $mark_class ?> fw-bold">
                            <?= number_format($result['final_marks'], 2) ?>
                        </td>
                        <td class="text-center">
                            <?php if ($result['avg_gpa']): ?>
                            <span class="badge bg-success"><?= number_format($result['avg_gpa'], 2) ?></span>
                            <?php else: ?>
                            <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="result-edit.php?roll_number=<?= urlencode($result['roll_number']) ?>&class_id=<?= $class_id ?>&section_id=<?= $section_id ?>&academic_year=<?= urlencode($academic_year) ?>" 
                               class="btn btn-sm btn-warning">
                               <i class="fas fa-edit"></i>
                            </a>
                            <button onclick="deleteStudentResults('<?= $result['roll_number'] ?>', '<?= $class_id ?>', '<?= $section_id ?>', '<?= $academic_year ?>')" 
                                    class="btn btn-sm btn-danger">
                               <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-end fw-bold">Class Average:</td>
                        <td class="text-center fw-bold">
                            <?= number_format(array_sum(array_column($results, 'term1_marks')) / count($results), 2) ?>
                        </td>
                        <td class="text-center fw-bold">
                            <?= number_format(array_sum(array_column($results, 'term2_marks')) / count($results), 2) ?>
                        </td>
                        <td class="text-center fw-bold">
                            <?= number_format(array_sum(array_column($results, 'term3_marks')) / count($results), 2) ?>
                        </td>
                        <td class="text-center fw-bold">
                            <?= number_format(array_sum(array_column($results, 'term4_marks')) / count($results), 2) ?>
                        </td>
                        <td class="text-center fw-bold">
                            <?= number_format(array_sum(array_column($results, 'final_marks')) / count($results), 2) ?>
                        </td>
                        <td class="text-center fw-bold">
                            <?php 
                            $gpas = array_filter(array_column($results, 'avg_gpa'));
                            echo count($gpas) > 0 ? number_format(array_sum($gpas) / count($gpas), 2) : '-';
                            ?>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="alert alert-info">
                    <h6><i class="fas fa-chart-pie me-2"></i>Performance Summary</h6>
                    <ul class="mb-0">
                        <li>Total Students: <?= count($results) ?></li>
                        <li>Average Marks: <?= number_format(array_sum(array_column($results, 'final_marks')) / count($results), 2) ?></li>
                        <li>Highest Marks: <?= number_format(max(array_column($results, 'final_marks')), 2) ?></li>
                        <li>Lowest Marks: <?= number_format(min(array_column($results, 'final_marks')), 2) ?></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-success">
                    <h6><i class="fas fa-star me-2"></i>Top Performers</h6>
                    <ul class="mb-0">
                        <?php 
                        usort($results, function($a, $b) {
                            return $b['final_marks'] <=> $a['final_marks'];
                        });
                        $top3 = array_slice($results, 0, 3);
                        foreach ($top3 as $index => $student):
                        ?>
                        <li><?= $index + 1 ?>. <?= htmlspecialchars($student['student_name']) ?> (<?= number_format($student['final_marks'], 2) ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteStudentResults(rollNumber, classId, sectionId, academicYear) {
    if (confirm('Are you sure you want to delete all results for this student?')) {
        $.ajax({
            url: 'ajax/delete-student-results.php',
            type: 'POST',
            data: { 
                roll_number: rollNumber,
                class_id: classId,
                section_id: sectionId,
                academic_year: academicYear
            },
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
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <h4>No Results Found</h4>
                    <p>No results found for the selected class, section, and academic year.</p>
                    <a href="result-add.php" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Results
                    </a>
                  </div>';
        }
    }
}
?>