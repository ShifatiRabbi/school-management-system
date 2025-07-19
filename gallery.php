<?php include "header.php"; ?>

<div class="container">
    <h2 class="text-center section-title" style="margin: 60px 0px;">Gallery of <?=$setting['school_name']?></h2>
</div>
<div class="container" id="bootstrap-image-gallery">
    <div class="row mx-0">
        <?php
        $imagesToShow = 21;
        $imagesPerRow = 3;
        $imagePathPrefix = "img/";
        $imageExtension = ".jpeg";

        for ($i = 1; $i <= $imagesToShow; $i++): ?>
            <div class="col-lg-<?php echo 12 / $imagesPerRow; ?> col-md-6 col-sm-12 mb-4 px-2">
                <a class="lg-item" data-lg-size="1600-1067" data-src="<?= $imagePathPrefix . $i . $imageExtension ?>">
                    <img src="<?= $imagePathPrefix . $i . $imageExtension ?>" class="gallery-img" alt="Gallery Image <?= $i ?>" />
                </a>
            </div>
        <?php endfor; ?>
    </div>
</div>


<div class="container">
    <h2 class="text-center section-title" style="margin: 60px 0px;">Videos of <?=$setting['school_name']?></h2>
</div>
<?php
$totalVideos = 3;         // Total videos to show
$videosPerRow = 3;        // Number per row
$videoPath = 'videos/';
$posterPath = 'posters/'; // Optional thumbnails
$extension = '.mp4';
?>

<div class="container py-4">
    <div class="row">
        <?php for ($i = 1; $i <= $totalVideos; $i++): ?>
            <div class="col-lg-<?php echo 12 / $videosPerRow; ?> col-md-6 col-sm-12 mb-4 text-center">
                <img src="<?= $posterPath . $i ?>.jpg" class="video-thumb" alt="Video <?= $i ?>" 
                     data-bs-toggle="modal" data-bs-target="#videoModal" 
                     data-video="<?= $videoPath . $i . $extension ?>" />
                
            </div>
        <?php endfor; ?>
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
            </div>
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    </div>
</div>



<?php include "footer.php"; ?>
