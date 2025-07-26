<?php 
include "header.php";

// Get gallery items from database
$sql_images = "SELECT * FROM gallery_images WHERE file_type = 'image' ORDER BY upload_date DESC";
$stmt_images = $conn->prepare($sql_images);
$stmt_images->execute();
$images = $stmt_images->fetchAll();

$sql_videos = "SELECT * FROM gallery_images WHERE file_type = 'video' ORDER BY upload_date DESC";
$stmt_videos = $conn->prepare($sql_videos);
$stmt_videos->execute();
$videos = $stmt_videos->fetchAll();
?>

<div class="container">
    <h2 class="text-center section-title" style="margin: 60px 0px;">Gallery of <?=$setting['school_name']?></h2>
</div>

<!-- Image Gallery -->
<div class="container" id="bootstrap-image-gallery">
    <div class="row mx-0">
        <?php foreach ($images as $image): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 px-2">
                <div class="gallery-item-wrapper">
                    <a class="lg-item" data-lg-size="1600-1067" data-src="<?= $image['file_path'] ?>" 
                       data-sub-html="<h4><?= htmlspecialchars($image['caption']) ?></h4>">
                        <img src="<?= $image['file_path'] ?>" class="gallery-img" alt="<?= htmlspecialchars($image['caption']) ?>" />
                        <?php if ($image['caption']): ?>
                            <div class="image-caption"><?= $image['caption'] ?></div>
                        <?php endif; ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Video Gallery -->
<div class="container">
    <h2 class="text-center section-title" style="margin: 60px 0px;">Videos of <?=$setting['school_name']?></h2>
</div>

<div class="container py-4">
    <div class="row">
        <?php foreach ($videos as $video): ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4 text-center">
                <div class="video-thumb-wrapper">
                    <?php 
                    $thumbnail = $video['file_path'];
                    // Replace video extension with image extension for thumbnail
                    $thumbnail = preg_replace('/\.[^.]*$/', '.jpg', $thumbnail);
                    ?>
                    <img src="<?= file_exists($thumbnail) ? $thumbnail : 'img/video-thumb-placeholder.jpg' ?>" 
                         class="video-thumb" alt="<?= htmlspecialchars($video['caption']) ?>" 
                         data-bs-toggle="modal" data-bs-target="#videoModal" 
                         data-video="<?= $video['file_path'] ?>" 
                         data-caption="<?= htmlspecialchars($video['caption']) ?>" />
                    <?php if ($video['caption']): ?>
                        <div class="video-caption"><?= $video['caption'] ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Bootstrap Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-body p-0">
                <video id="modalVideo" class="w-100" controls autoplay>
                    <source src="" type="video/mp4">
                    Your browser does not support HTML5 video.
                </video>
                <div id="videoCaption" class="text-white p-3"></div>
            </div>
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>

<style>
    .gallery-item-wrapper, .video-thumb-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    .gallery-item-wrapper:hover, .video-thumb-wrapper:hover {
        transform: translateY(-5px);
    }
    .gallery-img, .video-thumb {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .gallery-img:hover, .video-thumb:hover {
        transform: scale(1.05);
    }
    .image-caption, .video-caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }
</style>

<script>
    // Video modal handler
    document.addEventListener('DOMContentLoaded', function() {
        var videoModal = document.getElementById('videoModal');
        videoModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var videoSrc = button.getAttribute('data-video');
            var videoCaption = button.getAttribute('data-caption');
            
            var modalVideo = document.getElementById('modalVideo');
            modalVideo.src = videoSrc;
            
            var captionElement = document.getElementById('videoCaption');
            captionElement.innerHTML = videoCaption ? '<h4>' + videoCaption + '</h4>' : '';
        });
        
        videoModal.addEventListener('hide.bs.modal', function() {
            var modalVideo = document.getElementById('modalVideo');
            modalVideo.pause();
            modalVideo.currentTime = 0;
        });
    });
</script>

<?php include "footer.php"; ?>