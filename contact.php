
<?php include "header.php"; ?>

<section class="contact-info-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-card card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">CONTACT INFO</h3>
                    </div>
                    <div class="card-body">
                        <!-- Responsive Grid for Mobile -->
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
                            Let us know should you have any queries, suggestions, or complaints about <?=$setting['school_name']?>
                        </h4>

                <div class="contact-form">
                    <form method="post" action="req/contact.php">
                        <?php if (isset($_GET['error'])) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?=$_GET['error']?>
                        </div>
                        <?php } ?>
                        <?php if (isset($_GET['success'])) { ?>
                        <div class="alert alert-success" role="alert">
                            <?=$_GET['success']?>
                        </div>
                        <?php } ?>
                        
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Your Mobile</label>
                            <input type="tel" class="form-control" id="mobile" name="mobile" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Message</label>
                            <textarea class="form-control" id="message" name="message" required></textarea>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-send">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>