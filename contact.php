
<?php include "header.php"; ?>

<section class="contact-info-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-card card">
                    <div class="card-header">
                        <h3 class="text-center mb-0">CONTACT INFO</h3>
                    </div>
                    <div class="card-body">
                        <table class="contact-table">
                            <tr>
                                <th>MOBILE</th>
                                <td>01712334847</td>
                                <th>UNION</th>
                                <td>Dohar</td>
                            </tr>
                            <tr>
                                <th>UPAZILA / P.S.</th>
                                <td>Dohar</td>
                                <th>DISTRICT</th>
                                <td>Dhaka</td>
                            </tr>
                            <tr>
                                <th>DIVISION</th>
                                <td colspan="3">Dhaka</td>
                            </tr>
                        </table>
                    
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