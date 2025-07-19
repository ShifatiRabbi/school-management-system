

<!-- Footer -->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5><?=$setting['school_name']?></h5>
                    <p>We are one of the largest, most diverse universities with a commitment to excellence in education, research, and community engagement.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#academics">Academics</a></li>
                        <li><a href="#admissions">Admissions</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Academics</h5>
                    <ul>
                        <li><a href="#">Undergraduate Programs</a></li>
                        <li><a href="#">Graduate Programs</a></li>
                        <li><a href="#">Professional Studies</a></li>
                        <li><a href="#">Online Learning</a></li>
                        <li><a href="#">Academic Calendar</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>Contact Info</h5>
                    <ul>
                        <li><i class="fas fa-map-marker-alt me-2"></i> 1810 Campus Way NE, Bothell, WA</li>
                        <li><i class="fas fa-phone-alt me-2"></i> +1-2534-4456-345</li>
                        <li><i class="fas fa-envelope me-2"></i> admin@<?=strtolower(str_replace(' ', '', $setting['school_name']))?>.edu</li>
                    </ul>
                </div>
            </div>
            <div class="copyright text-center">
                <p>&copy; <?=$setting['current_year']?> <?=$setting['school_name']?>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>