<?php 
include "header.php";
include "admin/data/public_results.php";

$exam_type = 'SSC';
$results = getAllResults($exam_type, $conn);
$summary = getResultSummary($exam_type, $conn);
?>

<section class="public-results-section py-5">
    <div class="container">
        <h2 class="text-center section-title mb-5">ANALYSIS OF PUBLIC RESULTS</h2>
        
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4>Secondary School Certificate (SSC)</h4>
            </div>
            <div class="card-body">
                <!-- Summary View -->
                <div id="summary-view">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Total Statistics (<?= min(array_column($results, 'year')) ?>-<?= max(array_column($results, 'year')) ?>)</h5>
                            <div class="stats-box p-3 mb-3 bg-light rounded">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= $summary['total_appeared'] ?></div>
                                        <div class="stat-label">APPEARED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= $summary['total_passed'] ?></div>
                                        <div class="stat-label">PASSED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= $summary['total_failed'] ?></div>
                                        <div class="stat-label">FAILED</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= $summary['total_a_plus'] ?></div>
                                        <div class="stat-label">A+</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['avg_pass_rate'], 2) ?>%</div>
                                        <div class="stat-label">PASS RATE</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['avg_a_plus_rate'], 2) ?>%</div>
                                        <div class="stat-label">A+ RATE</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Average Statistics (<?= min(array_column($results, 'year')) ?>-<?= max(array_column($results, 'year')) ?>)</h5>
                            <div class="stats-box p-3 bg-light rounded">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['total_appeared']/$summary['years_count'], 2) ?></div>
                                        <div class="stat-label">APPEARED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['total_passed']/$summary['years_count'], 2) ?></div>
                                        <div class="stat-label">PASSED</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['total_failed']/$summary['years_count'], 2) ?></div>
                                        <div class="stat-label">FAILED</div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['total_a_plus']/$summary['years_count'], 2) ?></div>
                                        <div class="stat-label">A+</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['avg_national_rank'], 2) ?></div>
                                        <div class="stat-label">NATIONAL RANK</div>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="stat-value"><?= number_format($summary['avg_board_rank'], 2) ?></div>
                                        <div class="stat-label">BOARD RANK</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button id="show-details-btn" class="btn btn-primary">Show Details +</button>
                    </div>
                </div>
                
                <!-- Detailed View (initially hidden) -->
                <div id="detailed-view" style="display: none;">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>EXAM</th>
                                    <th>YEAR</th>
                                    <th>BOARD</th>
                                    <th>APPEARED</th>
                                    <th>PASSED</th>
                                    <th>FAILED</th>
                                    <th>A+</th>
                                    <th>PASS %</th>
                                    <th>A+ %</th>
                                    <th>NATIONAL RANK</th>
                                    <th>BOARD RANK</th>
                                    <th>DIVISION RANK</th>
                                    <th>DISTRICT RANK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $result): ?>
                                <tr>
                                    <td><?= $result['exam_type'] ?></td>
                                    <td><?= $result['year'] ?></td>
                                    <td><?= $result['board'] ?></td>
                                    <td><?= $result['appeared'] ?></td>
                                    <td><?= $result['passed'] ?></td>
                                    <td><?= $result['failed'] ?></td>
                                    <td><?= $result['a_plus'] ?></td>
                                    <td><?= number_format($result['pass_rate'], 2) ?>%</td>
                                    <td><?= number_format($result['a_plus_rate'], 2) ?>%</td>
                                    <td><?= $result['national_rank'] ?></td>
                                    <td><?= $result['board_rank'] ?></td>
                                    <td><?= $result['division_rank'] ?></td>
                                    <td><?= $result['district_rank'] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot class="font-weight-bold">
                                <tr>
                                    <td colspan="3">TOTAL/AVERAGE</td>
                                    <td><?= $summary['total_appeared'] ?></td>
                                    <td><?= $summary['total_passed'] ?></td>
                                    <td><?= $summary['total_failed'] ?></td>
                                    <td><?= $summary['total_a_plus'] ?></td>
                                    <td><?= number_format($summary['avg_pass_rate'], 2) ?>%</td>
                                    <td><?= number_format($summary['avg_a_plus_rate'], 2) ?>%</td>
                                    <td><?= number_format($summary['avg_national_rank'], 2) ?></td>
                                    <td><?= number_format($summary['avg_board_rank'], 2) ?></td>
                                    <td><?= number_format($summary['avg_division_rank'], 2) ?></td>
                                    <td><?= number_format($summary['avg_district_rank'], 2) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <button id="hide-details-btn" class="btn btn-primary">Hide Details</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const showDetailsBtn = document.getElementById('show-details-btn');
    const hideDetailsBtn = document.getElementById('hide-details-btn');
    const summaryView = document.getElementById('summary-view');
    const detailedView = document.getElementById('detailed-view');
    
    showDetailsBtn.addEventListener('click', function() {
        summaryView.style.display = 'none';
        detailedView.style.display = 'block';
    });
    
    hideDetailsBtn.addEventListener('click', function() {
        detailedView.style.display = 'none';
        summaryView.style.display = 'block';
    });
});
</script>

<?php include "footer.php"; ?>