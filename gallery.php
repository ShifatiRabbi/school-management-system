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
    <h2 class="text-center section-title" style="margin: 60px 0px;">Image Gallery of <?= $setting['school_name'] ?></h2>
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

<!-- Styles -->
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

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var videoModal = document.getElementById('videoModal');
        videoModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var videoSrc = button.getAttribute('data-video');
            var videoCaption = button.getAttribute('data-caption');

            var modalVideo = document.getElementById('modalVideo');
            modalVideo.src = videoSrc;

            var captionElement = document.getElementById('videoCaption');
            captionElement.innerHTML = videoCaption ? '<h4>' + videoCaption + '</h4>' : '';
        });

        videoModal.addEventListener('hide.bs.modal', function () {
            var modalVideo = document.getElementById('modalVideo');
            modalVideo.pause();
            modalVideo.currentTime = 0;
        });
    });
</script>

<?php include "footer.php"; ?>
