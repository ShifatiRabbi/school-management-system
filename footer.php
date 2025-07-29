<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="footer-links">
                    <h5>Quick Links</h5>
                    <ul>
                        <li><a href="/school-management-system">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="/school-management-system/basic_info">Basic Info</a></li>
                        <li><a href="/school-management-system/people_info">People Info</a></li>
                        <li><a href="/school-management-system/gallery">Gallery</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="footer-links">
                    <h5>Academic</h5>
                    <ul>
                        <li><a href="/school-management-system/public_results_ssc">SSC Results</a></li>
                        <li><a href="/school-management-system/public_results_jsc">JSC Results</a></li>
                        <li><a href="/school-management-system/events.php">Events</a></li>
                        <li><a href="/school-management-system/news">News & Updates</a></li>
                        <li><a href="/school-management-system/contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="footer-links">
                    <h5>Connect With Us</h5>
                    <div class="social-icons mb-3">
                        <a href="#" class="me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-youtube"></i></a>
                    </div>
                    <p>
                        <i class="fas fa-map-marker-alt me-2"></i> Dohar, Dhaka<br>
                        <i class="fas fa-phone-alt me-2"></i> 01712334847<br>
                        <i class="fas fa-envelope me-2"></i> admin@spahhs.edu
                    </p>
                </div>
            </div>
        </div>
        <div class="copyright text-center">
            <p>&copy; <?=$setting['current_year']?> <?=$setting['school_name']?>. All rights reserved.</p>
            <p>Design & Developed by Shifati Rabbi.</p>
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
    function animateMarquee() {
        $('.marquee-content').animate({marginLeft: '-=1px'}, 10, 'linear', function() {
            if (parseInt($(this).css('marginLeft')) <= -$(this).width()) {
                $(this).css('marginLeft', $('.marquee-container').width());
            }
            animateMarquee();
        });
    }
    
    // Start marquee animation if there are items
    if ($('.marquee-item').length > 0) {
        $('.marquee-content').css('marginLeft', $('.marquee-container').width());
        animateMarquee();
    }
    
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

</body>
</html>