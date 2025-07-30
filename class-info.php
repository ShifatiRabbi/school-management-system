<?php 
        include "header.php";
        include "admin/data/class.php";
        include "admin/data/section.php";
        include "admin/data/subject.php";
        
        $classes = getAllClasses($conn);
?>

    <div class="container mt-5">
        
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table" role="alert">
                <?=$_GET['error']?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table" role="alert">
                <?=$_GET['success']?>
            </div>
        <?php } ?>

        <?php if ($classes != 0) { ?>
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Class Name</th>
                        <!--    <th scope="col">Discipline</th> -->
                            <th scope="col">Sections</th>
                            <th scope="col">Total Students</th>
                            <th scope="col">Male</th>
                            <th scope="col">Female</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($classes as $i => $class) { 
                            $sections = getSectionsByClass($class['class_id'], $conn);
                            $totalStudents = getTotalStudentsInClass($class['class_id'], $conn);
                            $maleStudents = getMaleStudentsInClass($class['class_id'], $conn);
                            $femaleStudents = getFemaleStudentsInClass($class['class_id'], $conn);
                        ?>
                        <tr>
                            <th scope="row"><?=$i+1?></th>
                            <td><?=$class['class_name']?></td>
                        <!--    <td><?=$class['discipline']?></td> -->
                            <td><?=($sections != 0) ? count($sections) : 0?></td>
                            <td><?=$totalStudents?></td>
                            <td><?=$maleStudents?></td>
                            <td><?=$femaleStudents?></td>
                            <td>
                                <a href="class-view.php?class_id=<?=$class['class_id']?>" 
                                   class="btn btn-info btn-sm">
                                   <i class="fas fa-eye"></i> View Details
                                </a>
                                <!--
                                <a href="class-edit.php?class_id=<?=$class['class_id']?>" 
                                   class="btn btn-warning btn-sm">
                                   <i class="fas fa-edit"></i> Edit
                                </a>
                                -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info mt-3" role="alert">
                No classes found. Add your first class!
            </div>
        <?php } ?>
    </div>
    
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(6) a").addClass('active');
        });
    </script>
</body>
</html>
<?php 
    include 'footer.php'
?>