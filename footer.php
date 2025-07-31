<footer class="footer">
    <div class="container">
        <div class="row">
            <!-- Quick Links Column -->
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="footer-links">
                    <h5 class="text-uppercase mb-4" style="color: var(--secondary-color);">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="https://www.moedu.gov.bd/" class="text-white footer-link">Ministry of Education</a></li>
                        <li class="mb-2"><a href="https://www.mopme.gov.bd/" class="text-white footer-link">Primary & Mass Education</a></li>
                        <li class="mb-2"><a href="https://bangladesh.gov.bd/" class="text-white footer-link">BD National Portal</a></li>
                        <li class="mb-2"><a href="https://a2i.gov.bd/" class="text-white footer-link">ICT Division</a></li>
                        <li class="mb-2"><a href="http://www.dshe.gov.bd/" class="text-white footer-link">DSHE</a></li>
                    </ul>
                </div>
            </div>
            <!-- Site Links Column -->
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="footer-links">
                    <h5 class="text-uppercase mb-4" style="color: var(--secondary-color);">Site Links</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/school-management-system" class="text-white footer-link">Home</a></li>
                        <li class="mb-2"><a href="about" class="text-white footer-link">About Us</a></li>
                        <li class="mb-2"><a href="basic-info" class="text-white footer-link">School Details</a></li>
                        <li class="mb-2"><a href="people_info" class="text-white footer-link">Staff Details</a></li>
                        <li class="mb-2"><a href="gallery" class="text-white footer-link">Gallery</a></li>
                    </ul>
                </div>
            </div>

            <!-- Academic Column -->
            <div class="col-md-3 mb-4 mb-md-0">
                <div class="footer-links">
                    <h5 class="text-uppercase mb-4" style="color: var(--secondary-color);">Academic</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="public_results_ssc" class="text-white footer-link">SSC Results</a></li>
                        <li class="mb-2"><a href="public_results_jsc" class="text-white footer-link">JSC Results</a></li>
                        <li class="mb-2"><a href="events" class="text-white footer-link">Events</a></li>
                        <li class="mb-2"><a href="news" class="text-white footer-link">News & Updates</a></li>
                        <li class="mb-2"><a href="contact" class="text-white footer-link">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact Column -->
            <div class="col-md-3">
                <div class="footer-contact">
                    <h5 class="text-uppercase mb-4" style="color: var(--secondary-color);">Connect With Us</h5>
                    <div class="social-icons mb-4">
                        <a href="https://www.facebook.com/groups/348161615295603/" class="text-white me-3 social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3 social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white me-3 social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3 social-icon"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="text-white me-3 social-icon"><i class="fab fa-youtube"></i></a>
                    </div>
                    <address class="mb-0">
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt me-2" style="color: var(--secondary-color);"></i> 
                            <span>Dohar, Dhaka</span>
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-phone-alt me-2" style="color: var(--secondary-color);"></i> 
                            <a href="tel:01712334847" class="text-white">01712334847</a>
                        </p>
                        <p class="mb-0">
                            <i class="fas fa-envelope me-2" style="color: var(--secondary-color);"></i> 
                            <a href="mailto:admin@spahhs.edu" class="text-white">admin@spahhs.edu</a>
                        </p>
                    </address>
                </div>
            </div>
        </div>
        <div class="copyright text-center">
            <p>&copy; <?=$setting['current_year']?> <?=$setting['school_name']?>. All rights reserved.</p>
            <p>Design & Developed by <a href="tel: 01571501416" style="text-decoration: none; color: silver;">Shifati Rabbi</a>.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/lightgallery.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/zoom/lg-zoom.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/thumbnail/lg-thumbnail.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.1/plugins/video/lg-video.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    // Initialize lightGallery
    document.addEventListener("DOMContentLoaded", function () {
        const galleryContainer = document.getElementById("bootstrap-image-gallery");
        if (galleryContainer) {
            lightGallery(galleryContainer, {
                selector: '.lg-item',
                plugins: [lgZoom, lgThumbnail],
                speed: 500
            });
        }
    });

    // Video modal functionality
    const modal = document.getElementById('videoModal');
    if (modal) {
        const video = document.getElementById('modalVideo');
        
        modal.addEventListener('show.bs.modal', function (e) {
            const trigger = e.relatedTarget;
            const videoSrc = trigger.getAttribute('data-video');
            video.querySelector('source').src = videoSrc;
            video.load();
            video.play();
        });

        modal.addEventListener('hidden.bs.modal', function () {
            video.pause();
            video.currentTime = 0;
        });
    }

    // Scroll reveal animation
    document.addEventListener('DOMContentLoaded', function() {
        const sr = ScrollReveal({
            origin: 'bottom',
            distance: '60px',
            duration: 1000,
            delay: 200,
            reset: true
        });

        sr.reveal('.feature-box, .event-card, .news-card, .contact-info, .contact-form', {
            interval: 200
        });
    });
 
$(document).ready(function() {
    // Marquee animation
    $(document).ready(function () {
        const $marquee = $('.marquee-content');
        const $wrapper = $('.marquee-wrapper');
        
        let wrapperWidth = $wrapper.width();
        let marqueeWidth = $marquee.width();
        let currentPosition = wrapperWidth;

        function animateMarquee() {
            currentPosition -= 1;
            if (currentPosition < -marqueeWidth) {
                currentPosition = wrapperWidth;
            }
            $marquee.css('left', currentPosition + 'px');
            requestAnimationFrame(animateMarquee);
        }

        // Initialize
        $marquee.css({ left: wrapperWidth + 'px' });
        requestAnimationFrame(animateMarquee);
    });
    
    // Notice card hover effect
    $('.notice-card').hover(
        function() {
            $(this).addClass('notice-card-hover').css('transform', 'translateY(-5px)');
        },
        function() {
            $(this).removeClass('notice-card-hover').css('transform', 'translateY(0)');
        }
    );
    
    // View notice details
    $('.notice-view-btn').click(function() {
        var noticeId = $(this).data('id');
        $.ajax({
            url: 'get_notice_details.php',
            type: 'GET',
            data: {id: noticeId},
            success: function(response) {
                var notice = JSON.parse(response);
                $('#noticeModalTitle').text(notice.title);
                
                var modalContent = '<div class="notice-date mb-3"><strong>Date: </strong>' + notice.formatted_date + '</div>';
                if (notice.image_path) {
                    modalContent += '<div class="notice-modal-image mb-3"><img src="' + notice.image_path + '" class="img-fluid" alt="' + notice.title + '"></div>';
                }
                modalContent += '<div class="notice-content">' + notice.description + '</div>';
                
                $('#noticeModalBody').html(modalContent);
                $('#noticeModal').modal('show');
            }
        });
    });
});
</script>

<!-- ScrollReveal Library -->
<script src="https://unpkg.com/scrollreveal"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toggler = document.querySelector('.navbar-toggler');
    const collapseTarget = document.querySelector('#navbarNav');

    // Bootstrap Collapse instance (manual control)
    const bsCollapse = new bootstrap.Collapse(collapseTarget, {
        toggle: false
    });

    toggler.addEventListener('click', function () {
        const isOpen = toggler.classList.contains('collapsed') === false;

        if (isOpen) {
            // Currently open, so hide it (user clicked close "X")
            bsCollapse.hide();
            toggler.classList.add('collapsed');
            toggler.setAttribute('aria-expanded', 'false');
        } else {
            // Currently closed, so show it (user clicked hamburger)
            bsCollapse.show();
            toggler.classList.remove('collapsed');
            toggler.setAttribute('aria-expanded', 'true');
        }
    });
});
</script>



</body>
</html>