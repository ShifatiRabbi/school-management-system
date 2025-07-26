<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/public_results.php";

$exam_type = 'SSC'; // Default to SSC, can be made dynamic

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_result'])) {
        $year = $_POST['year'];
        $board = $_POST['board'];
        $appeared = $_POST['appeared'];
        $passed = $_POST['passed'];
        $failed = $_POST['failed'];
        $a_plus = $_POST['a_plus'];
        
        // Calculate rates
        $pass_rate = ($passed / $appeared) * 100;
        $a_plus_rate = ($a_plus / $appeared) * 100;
        
        $national_rank = $_POST['national_rank'];
        $board_rank = $_POST['board_rank'];
        $division_rank = $_POST['division_rank'];
        $district_rank = $_POST['district_rank'];
        
        if (addResult($exam_type, $year, $board, $appeared, $passed, $failed, $a_plus, $pass_rate, $a_plus_rate, $national_rank, $board_rank, $division_rank, $district_rank, $conn)) {
            $success_msg = "Result added successfully!";
        } else {
            $error_msg = "Failed to add result. It may already exist for this year.";
        }
    } elseif (isset($_POST['delete_result'])) {
        $id = $_POST['id'];
        if (deleteResult($id, $conn)) {
            $success_msg = "Result deleted successfully!";
        } else {
            $error_msg = "Failed to delete result.";
        }
    }
}

$results = getAllResults($exam_type, $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage SSC Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
        include "inc/navbar.php";
     ?>
    
    <div class="container mt-4">
        <h2>Manage SSC Results</h2>
        
        <?php if (isset($success_msg)): ?>
            <div class="alert alert-success"><?= $success_msg ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger"><?= $error_msg ?></div>
        <?php endif; ?>
        
        <div class="card mb-4">
            <div class="card-header">
                <h4>Add New Result</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Year</label>
                                <input type="number" name="year" class="form-control" required min="2000" max="2099">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Board</label>
                                <input type="text" name="board" class="form-control" value="Dhaka" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Appeared</label>
                                <input type="number" name="appeared" class="form-control" required min="1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Passed</label>
                                <input type="number" name="passed" class="form-control" required min="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Failed</label>
                                <input type="number" name="failed" class="form-control" required min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">A+</label>
                                <input type="number" name="a_plus" class="form-control" required min="0">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">National Rank</label>
                                <input type="text" name="national_rank" class="form-control" placeholder="e.g., 3346th" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Board Rank</label>
                                <input type="text" name="board_rank" class="form-control" placeholder="e.g., 464th" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">Division Rank</label>
                                <input type="text" name="division_rank" class="form-control" placeholder="e.g., 620th" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">District Rank</label>
                                <input type="text" name="district_rank" class="form-control" placeholder="e.g., 256th" required>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" name="add_result" class="btn btn-primary">Add Result</button>
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h4>Existing Results</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Board</th>
                                <th>Appeared</th>
                                <th>Passed</th>
                                <th>Failed</th>
                                <th>A+</th>
                                <th>Pass %</th>
                                <th>A+ %</th>
                                <th>National Rank</th>
                                <th>Board Rank</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($results as $result): ?>
                            <tr>
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
                                <td>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $result['id'] ?>">
                                        <button type="submit" name="delete_result" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this result?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Calculate failed automatically
        document.querySelector('input[name="appeared"]').addEventListener('change', function() {
            const appeared = parseInt(this.value);
            const passed = parseInt(document.querySelector('input[name="passed"]').value) || 0;
            document.querySelector('input[name="failed"]').value = appeared - passed;
        });
        
        document.querySelector('input[name="passed"]').addEventListener('change', function() {
            const passed = parseInt(this.value);
            const appeared = parseInt(document.querySelector('input[name="appeared"]').value) || 0;
            document.querySelector('input[name="failed"]').value = appeared - passed;
        });
    </script>
</body>
</html>