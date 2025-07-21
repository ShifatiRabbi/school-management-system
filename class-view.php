<?php 

        include "header.php";
        include "admin/data/class.php";
        include "admin/data/section.php";
        include "admin/data/subject.php";
        
        $class = getClassById($_GET['class_id'], $conn);
        $sections = getSectionsByClass($_GET['class_id'], $conn);
        $subjects = getClassSubjects($_GET['class_id'], $conn);
        
        $totalStudents = getTotalStudentsInClass($_GET['class_id'], $conn);
        $maleStudents = getMaleStudentsInClass($_GET['class_id'], $conn);
        $femaleStudents = getFemaleStudentsInClass($_GET['class_id'], $conn);

        if ($class == 0) {
            header("Location: class.php");
            exit;
        }
?>
    <style>
        .class-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .info-card {
            
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .info-card:hover {
            transform: translateY(-5px);
        }
        .student-stats {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .section-card {
            border-left: 4px solid #2575fc;
        }
        .subject-badge {
            background-color: #e9f7fe;
            color: #2575fc;
            border-radius: 20px;
            padding: 5px 15px;
            margin-right: 8px;
            margin-bottom: 8px;
            display: inline-block;
        }
    </style>

    <div class="container mt-5">
        <a href="class_info" class="btn btn-dark mb-3">
            <i class="fas fa-arrow-left"></i> Back to Classes
        </a>

        <div class="class-header p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2><i class="fas fa-chalkboard-teacher"></i> <?=$class['class_name']?></h2>
                    <p class="mb-0">Discipline: <?=$class['discipline']?></p>
                </div>
            <!--    <div class="col-md-4 text-end">
                    <a href="class-edit.php?class_id=<?=$class['class_id']?>" 
                       class="btn btn-light">
                       <i class="fas fa-edit"></i> Edit Class
                    </a>
            -->
                </div>
            </div>
        </div>

        <!-- Class Summary Cards -->
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="info-card p-3 h-100 student-stats">
                    <h5><i class="fas fa-users"></i> Student Statistics</h5>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <h6 class="text-muted">Total Students</h6>
                            <h3><?=$totalStudents?></h3>
                        </div>
                        <div>
                            <h6 class="text-muted">Male</h6>
                            <h3><?=$maleStudents?></h3>
                        </div>
                        <div>
                            <h6 class="text-muted">Female</h6>
                            <h3><?=$femaleStudents?></h3>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="info-card p-3 h-100">
                    <h5><i class="fas fa-layer-group"></i> Sections</h5>
                    <h1 class="display-4 mt-2"><?=($sections != 0) ? count($sections) : 0?></h1>
                <!--    <a href="section-add.php?class_id=<?=$class['class_id']?>" class="btn btn-sm btn-primary mt-2">
                        <i class="fas fa-plus"></i> Add Section
                    </a> -->
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="info-card p-3 h-100">
                    <h5><i class="fas fa-book"></i> Subjects</h5>
                    <h1 class="display-4 mt-2"><?=($subjects != 0) ? count($subjects) : 0?></h1>
                <!--    <a href="course-add.php" class="btn btn-sm btn-primary mt-2">
                        <i class="fas fa-plus"></i> Add Subject
                    </a> -->
                </div>
            </div>
        </div>
    </div>
        <!-- Class Teacher Information (Static for now) -->
        <div class="container card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-user-tie"></i> Class Teacher Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> To be added</p>
                        <p><strong>Phone:</strong> To be added</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> To be added</p>
                        <p><strong>Joining Date:</strong> To be added</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sections List -->
        <div class="container card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-list-ol"></i> Sections</h5>
            </div>
            <div class="card-body">
                <?php if ($sections != 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Section Name</th>
                                    <th>Male Students</th>
                                    <th>Female Students</th>
                                    <th>Total Students</th>
                                 <!--   <th>Actions</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($sections as $section) { 
                                    $total = $section['male_students'] + $section['female_students'];
                                ?>
                                <tr>
                                    <td><?=$section['section_name']?></td>
                                    <td><?=$section['male_students']?></td>
                                    <td><?=$section['female_students']?></td>
                                    <td><?=$total?></td>
                                <!--
                                    <td>
                                        <a href="section-edit.php?section_id=<?=$section['section_id']?>" 
                                           class="btn btn-sm btn-warning">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="section-delete.php?section_id=<?=$section['section_id']?>" 
                                           class="btn btn-sm btn-danger">
                                           <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                -->
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info">
                        No sections found for this class.
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Subjects List -->
        <div class="container card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-book-open"></i> Subjects</h5>
            </div>
            <div class="card-body">
                <?php if ($subjects != 0) { ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Subject Code</th>
                                <!--    <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($subjects as $subject) { ?>
                                <tr>
                                    <td><?=$subject['subject_name']?></td>
                                    <td><?=$subject['subject_code']?></td>
                                <!--
                                    <td>
                                        <a href="course-edit.php?course_id=<?=$subject['subject_id']?>" 
                                           class="btn btn-sm btn-warning">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="course-delete.php?course_id=<?=$subject['subject_id']?>" 
                                           class="btn btn-sm btn-danger">
                                           <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                -->
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-info">
                        No subjects assigned to this class.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(6) a").addClass('active');
        });
    </script>

<?php include 'footer.php'
?>