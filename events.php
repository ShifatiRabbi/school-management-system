<?php include "header.php"; ?>

<section class="py-5">
    <div class="container">
        <h2 class="section-title mb-5">All Events</h2>
        <div class="row">
            <?php
            include "admin/data/event.php";
            $events = getAllEvents($conn);
            foreach ($events as $event) {
                $event_date = new DateTime($event['event_date']);
                $start_time = new DateTime($event['start_time']);
                $end_time = new DateTime($event['end_time']);
            ?>
            <div class="col-md-6 mb-4">
                <div class="card event-card">
                    <div class="row g-0">
                        <div class="col-md-2 bg-primary text-white d-flex align-items-center justify-content-center">
                            <div class="event-date">
                                <span class="event-day"><?= $event_date->format('d') ?></span>
                                <span class="event-month"><?= strtoupper($event_date->format('M')) ?></span>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($event['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($event['description']) ?></p>
                                <p class="card-text text-muted"><small>
                                    <i class="far fa-clock"></i> 
                                    <?= $start_time->format('g:i a') ?> - <?= $end_time->format('g:i a') ?>
                                </small></p>
                                <p class="card-text text-muted"><small>
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <?= $event['is_online'] ? 'Online Event' : htmlspecialchars($event['location']) ?>
                                </small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>