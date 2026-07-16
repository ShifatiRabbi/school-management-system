<?php
include "header.php";
?>

<section class="contact-info-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-card card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">CONTACT INFO</h3>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <strong>MOBILE</strong><br>
                                <span>01712334847</span>
                            </div>
                            <div class="col-md-6">
                                <strong>UNION</strong><br>
                                <span>Dohar</span>
                            </div>
                            <div class="col-md-6">
                                <strong>UPAZILA / P.S.</strong><br>
                                <span>Dohar</span>
                            </div>
                            <div class="col-md-6">
                                <strong>DISTRICT</strong><br>
                                <span>Dhaka</span>
                            </div>
                            <div class="col-12">
                                <strong>DIVISION</strong><br>
                                <span>Dhaka</span>
                            </div>
                        </div>
                    </div>
                </div>

                <h4 class="mt-4 text-center">
                    Let us know should you have any queries, suggestions, or complaints about <?= e($setting['school_name'] ?? '') ?>
                </h4>

                <div class="contact-form mt-3">
                    <form method="post" action="req/contact.php">
                        <?= csrf_field() ?>
                        <?= alert_from_query() ?>
                        <div class="mb-3">
                            <label class="form-label">Your Name</label>
                            <input type="text" class="form-control" name="full_name" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Email</label>
                            <input type="email" class="form-control" name="email" required maxlength="150">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Mobile</label>
                            <input type="tel" class="form-control" name="mobile" required maxlength="20">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Your Message</label>
                            <textarea class="form-control" name="message" rows="4" required maxlength="2000"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>
