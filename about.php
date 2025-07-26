<?php include "header.php"; ?>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <h2 class="text-center section-title">About <?=$setting['school_name']?></h2>
            <div class="row ">
                <div class="col-lg-6">
                    <img src="img/about.jpg" alt="About our school" class="img-fluid rounded" width="100%">
                </div>
                <div class="col-lg-6">
                    <p><?=$setting['about']?></p>
                <!--    <a href="#" class="btn btn-primary mt-3">Read More</a>  -->
                </div>
            </div>
			<div class="row ">
                <img src="img/rank.jpg" alt="our school ranking" class="img-fluid rounded" >
            </div>
        </div>
    </section>
    
    <!-- Quick Features -->
    <section class="py-5">
        <div class="container">
            <div class="row">
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-map-marked-alt"></i>
						</div>
						<h3>TOTAL LAND</h3>
						<p>150 Decimals</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-futbol"></i>
						</div>
						<h3>PLAYGROUND</h3>
						<p>90 Decimals</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-building"></i>
						</div>
						<h3>FLOOR SPACE</h3>
						<p>21,575 Sq. Ft.</p>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-user-tie"></i>
						</div>
						<h3>AVERAGE TEACHER AGE</h3>
						<p>49 Years</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-chalkboard-teacher"></i>
						</div>
						<h3>STUDENT TO TEACHER</h3>
						<p>Ratio 48:1</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="feature-box">
						<div class="feature-icon">
							<i class="fas fa-users"></i>
						</div>
						<h3>STUDENT TO EMPLOYEE</h3>
						<p>Ratio 144:1</p>
					</div>
				</div>
			</div>
        </div>
    </section>

<?php include "footer.php"; ?>