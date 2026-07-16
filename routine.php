<?php include "header.php";
include "DB_connection.php";
include "admin/data/class.php";
include "admin/data/section.php";
include "admin/data/routine.php";

$classes = getAllClasses($conn);
$selectedClass = isset($_GET['class_id']) ? $_GET['class_id'] : null;
$selectedSection = isset($_GET['section_id']) ? $_GET['section_id'] : null;
$routine = null;

if ($selectedClass && $selectedSection) {
    $routine = getRoutineByClassSection($conn, $selectedClass, $selectedSection);
}
?>
<!--
<section class="py-5">
    <div class="container">
        <h2 class="text-center section-title mb-5">Class Routine</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form method="get" class="card shadow-sm p-4 mb-5">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="class_id" class="form-label">Select Class</label>
                            <select class="form-select" id="class_id" name="class_id" required>
                                <option value="">Select Class</option>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?=$class['class_id']?>" <?=$selectedClass==$class['class_id']?'selected':''?>>
                                        <?=$class['class_name']?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="section_id" class="form-label">Select Section</label>
                            <select class="form-select" id="section_id" name="section_id" required <?=!$selectedClass?'disabled':''?>>
                                <option value="">Select Section</option>
                                <?php if ($selectedClass): 
                                    $sections = getSectionsByClass($selectedClass, $conn);
                                    foreach ($sections as $section): ?>
                                        <option value="<?=$section['section_id']?>" <?=$selectedSection==$section['section_id']?'selected':''?>>
                                            <?=$section['section_name']?>
                                        </option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary px-4">Show Routine</button>
                        </div>
                    </div>
                </form>
                
                <?php if ($selectedClass && $selectedSection): ?>
                    <?php if ($routine): ?>
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">
                                    <?php 
                                        $class = getClassById($selectedClass, $conn);
                                        $section = getSectioById($selectedSection, $conn);
                                        echo htmlspecialchars($class['class_name']) . ' - ' . htmlspecialchars($section['section_name']);
                                    ?>
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <img src="<?=htmlspecialchars($routine['routine_image'])?>" class="img-fluid" alt="Class Routine" style="max-height: 80vh;">
                            </div>
                            <div class="card-footer text-muted">
                                <small>Last updated: <?=date('M d, Y', strtotime($routine['upload_date']))?></small>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info text-center py-4" role="alert">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <h4>No routine found</h4>
                            <p class="mb-0">The routine for this class and section has not been uploaded yet.</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
-->

<style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --light-text: #ecf0f1;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
        }
        
        .routine-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .routine-title {
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
            animation: fadeInDown 1s;
        }
        
        .routine-subtitle {
            font-weight: 300;
            opacity: 0.9;
            animation: fadeIn 1.5s;
        }
        
        .routine-table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 3rem;
            transition: all 0.3s ease;
        }
        
        .routine-table-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .routine-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.95rem;
            animation: fadeInUp 1s;
        }
        
        .routine-table th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 15px 10px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .routine-table td {
            padding: 12px 8px;
            border: 1px solid #e0e0e0;
            vertical-align: middle;
            transition: all 0.2s ease;
        }
        
        .routine-table tr:nth-child(even) {
            background-color: rgba(240, 240, 240, 0.5);
        }
        
        .routine-table tr:hover td {
            background-color: rgba(52, 152, 219, 0.1);
        }
        
        .day-header {
            background-color: var(--secondary-color) !important;
            color: white;
            font-weight: 600;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            min-width: 40px;
        }
        
        .class-name {
            font-weight: 600;
            color: var(--primary-color);
            background-color: rgba(236, 240, 241, 0.7);
        }
        
        .subject-cell {
            position: relative;
            min-width: 100px;
        }
        
        .subject-name {
            display: block;
            font-weight: 500;
            margin-bottom: 3px;
        }
        
        .teacher-code {
            display: inline-block;
            font-size: 0.75rem;
            background-color: var(--accent-color);
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            margin-top: 3px;
        }
        
        .time-slot {
            font-size: 0.85rem;
            color: #7f8c8d;
            font-weight: 500;
        }
        
        .break-cell {
            background-color: #f39c12 !important;
            color: white;
            font-weight: 600;
        }
        
        /* Animation classes */
        .animate-delay-1 { animation-delay: 0.2s; }
        .animate-delay-2 { animation-delay: 0.4s; }
        .animate-delay-3 { animation-delay: 0.6s; }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .routine-table {
                font-size: 0.85rem;
            }
            
            .routine-table th, 
            .routine-table td {
                padding: 8px 5px;
            }
        }
        
        @media (max-width: 768px) {
            .routine-table-container {
                overflow-x: auto;
            }
            
            .routine-table {
                min-width: 800px;
            }
            
            .day-header {
                writing-mode: horizontal-tb;
                transform: none;
                min-width: auto;
            }
        }
        
        /* Custom animations */
        @keyframes fadeInCells {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .routine-table tr td {
            animation: fadeInCells 0.5s ease forwards;
        }
        
        .routine-table tr:nth-child(1) td { animation-delay: 0.1s; }
        .routine-table tr:nth-child(2) td { animation-delay: 0.2s; }
        .routine-table tr:nth-child(3) td { animation-delay: 0.3s; }
        .routine-table tr:nth-child(4) td { animation-delay: 0.4s; }
        .routine-table tr:nth-child(5) td { animation-delay: 0.5s; }
        .routine-table tr:nth-child(6) td { animation-delay: 0.6s; }
    </style>


<section class="routine-section py-5">
  <div class="container">
    <h2 class="text-center section-title mb-4">২০২৫ সালের ক্লাস রুটিন</h2>
    <div class="table-responsive">
      <table class="table table-bordered text-center routine-table">
        <thead class="table-success text-white bg-success">
          <tr>
            <th>বার</th>
            <th>শ্রেণি</th>
            <th>সমাবেশ<br>৯:৪৫–১০:০০</th>
            <th>১ম সেশন<br>১০:০০–১০:৫০</th>
            <th>২য় সেশন<br>১০:৫০–১১:৪০</th>
            <th>৩য় সেশন<br>১১:৪০–১২:৩০</th>
            <th>৪র্থ সেশন<br>১২:৩০–০১:২০</th>
            <th>বিরতি<br>১:৩০–২:০০</th>
            <th>৫ম সেশন<br>২:০০–২:৪০</th>
            <th>৬ষ্ঠ সেশন<br>২:৪০–৩:৩০</th>
            <th>৭ম সেশন<br>৩:৩০–৪:০০</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td rowspan="6" class="align-middle">রবিবার থেকে বৃহস্পতিবার</td>
            <td>৬ষ্ঠ</td>
            <td rowspan="5" class="align-middle">সমাবেশ</td>
            <td>বাংলা ১ম/২য়<br><small>SR</small></td>
            <td>গণিত<br><small>AR</small></td>
            <td>বিজ্ঞান<br><small>AK/DM</small></td>
            <td>ইংরেজি<br><small>SI/T.F</small></td>
            <td rowspan="5" class="align-middle">১:৩০–২:০০</td>
            <td>বিজ্ঞান<br><small>MR</small></td>
            <td>কৃষি/তথ্য<br><small>MI</small></td>
            <td>ইতিহাস<br><small>AM</small></td>
          </tr>
          <tr>
            <td>৭ম</td>
            <td>বাংলা ১ম/২য়<br><small>AM</small></td>
            <td>গণিত<br><small>DM</small></td>
            <td>ইতিহাস<br><small>SR</small></td>
            <td>বিজ্ঞান<br><small>MI</small></td>
            <td>ইসলাম/কৃষি<br><small>AK</small></td>
            <td>ইংরেজি ১ম/২য়<br><small>T.F</small></td>
            <td>কৃষি/তথ্য<br><small>DM</small></td>
          </tr>
          <tr>
            <td>৮ম</td>
            <td>বিজ্ঞান<br><small>AR</small></td>
            <td>ইসলাম/হিন্দু ধর্ম<br><small>AK/SR</small></td>
            <td>বাংলা ১ম/২য়<br><small>AM</small></td>
            <td>গণিত<br><small>MR</small></td>
            <td>ইংরেজি ১ম/২য়<br><small>T.F</small></td>
            <td>ইতিহাস<br><small>DM</small></td>
            <td>কৃষি/তথ্য<br><small>MR</small></td>
          </tr>
          <tr>
            <td>৯ম</td>
            <td>বিজ্ঞান<br><small>MI</small></td>
            <td>গণিত<br><small>MR</small></td>
            <td>ইংরেজি ১ম/২য়<br><small>T.F</small></td>
            <td>বাংলা ১ম/২য়<br><small>AM</small></td>
            <td>গ্রুপ<br><small>AR/SI</small></td>
            <td>কৃষি/তথ্য<br><small>SR</small></td>
            <td>ইসলাম/হিন্দু ধর্ম<br><small>AK</small></td>
          </tr>
          <tr>
            <td>১০ম</td>
            <td>গণিত<br><small>MR</small></td>
            <td>ইংরেজি ১ম/২য়<br><small>T.F</small></td>
            <td>বিজ্ঞান<br><small>MI</small></td>
            <td>গ্রুপ<br><small>AR/DM</small></td>
            <td>বাংলা ১ম/২য়<br><small>AM</small></td>
            <td>ইসলাম/হিন্দু ধর্ম<br><small>AK/AR</small></td>
            <td>কৃষি/তথ্য<br><small>MI</small></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add intersection observer for scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.routine-table tr').forEach(row => {
                observer.observe(row);
            });
        });
    </script>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Class-Section dynamic dropdown
    $('#class_id').change(function() {
        const classId = $(this).val();
        if (classId) {
            $('#section_id').prop('disabled', false);
            $.ajax({
                url: 'admin/req/get-sections.php',
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
</script>