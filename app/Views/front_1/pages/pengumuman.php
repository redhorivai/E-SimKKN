<?= $this->extend('front/layout/main_layout') ?>
<?= $this->section('content'); ?>

<head>
	<title>Courses</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Unicat project">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/styles/bootstrap4/bootstrap.min.css">
	<link href="<?= base_url(); ?>/assets-front/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?= base_url(); ?>/assets-front/plugins/colorbox/colorbox.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/animate.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/styles/courses.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets-front/styles/courses_responsive.css">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url(); ?>/assets-front/styles/bootstrap4/popper.js"></script>
	<script src="<?= base_url(); ?>/assets-front/styles/bootstrap4/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>/assets-front/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
	<script src="<?= base_url(); ?>/assets-front/plugins/easing/easing.js"></script>
	<script src="<?= base_url(); ?>/assets-front/plugins/parallax-js-master/parallax.min.js"></script>
	<script src="<?= base_url(); ?>/assets-front/plugins/colorbox/jquery.colorbox-min.js"></script>
	<script src="<?= base_url(); ?>/assets-front/js/courses.js"></script>
</head>

<!-- <div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.html">Home</a></li>
								<li><a href="courses.html">Courses</a></li>
								<li>Course Details</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div> -->
<div class="super_container">

	<div class="home">
		<div class="breadcrumbs_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="breadcrumbs">
							<ul>
								<li><a href="index.html">Beranda</a></li>
								<li><?= $title; ?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="courses">
		<div class="container">
			<div class="row">

				<!-- Courses Main Content -->
				<div class="col-lg-8">
					<!-- <div class="courses_search_container">
						<form action="#" id="courses_search_form" class="courses_search_form d-flex flex-row align-items-center justify-content-start">
							<input type="search" class="courses_search_input" placeholder="Search Courses" required="required">
							<select id="courses_search_select" class="courses_search_select courses_search_input">
								<option>All Categories</option>
								<option>Category</option>
								<option>Category</option>
								<option>Category</option>
							</select>
							<button action="submit" class="courses_search_button ml-auto">search now</button>
						</form>
					</div> -->
					<div class="courses_container">
						<div class="row courses_row">

							<!-- Course -->
							<div class="col-lg-6 course_col">
								<!-- <div class="course">
									<div class="course_image"><img src="<?= base_url(); ?>/image/pdf.png" alt=""></div>
									<div class="course_body">
										<h3 class="course_title"><a href="course.html">Software Training</a></h3>
										<div class="course_teacher">Mr. John Taylor</div>
										<div class="course_text">
											<p>Lorem ipsum dolor sit amet, consectetur adipi elitsed do eiusmod tempor</p>
										</div>
									</div>
									<div class="course_footer">
										<div class="course_footer_content d-flex flex-row align-items-center justify-content-start">
											<div class="course_info">
												<i class="fa fa-graduation-cap" aria-hidden="true"></i>
												<span>20 Student</span>
											</div>
											<div class="course_info">
												<i class="fa fa-star" aria-hidden="true"></i>
												<span>5 Ratings</span>
											</div>
											<div class="course_price ml-auto">$130</div>
										</div>
									</div>
								</div> -->
							<?= $resContent; ?>

							</div>
						</div>
						<div class="row pagination_row">
							<div class="col">
								<div class="pagination_container d-flex flex-row align-items-center justify-content-start">
									<ul class="pagination_list">
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Courses Sidebar -->
				<div class="col-lg-4">
					<div class="sidebar">

						<!-- Categories -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Categories</div>
							<div class="sidebar_categories">
								<ul>
									<li><a href="#">Art & Design</a></li>
									<li><a href="#">Business</a></li>
									<li><a href="#">IT & Software</a></li>
									<li><a href="#">Languages</a></li>
									<li><a href="#">Programming</a></li>
								</ul>
							</div>
						</div>

						<!-- Latest Course -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Latest Courses</div>
							<div class="sidebar_latest">

								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image">
										<div><img src="<?= base_url(); ?>/assets-front/images/latest_1.jpg" alt=""></div>
									</div>
									<div class="latest_content">
										<div class="latest_title"><a href="course.html">How to Design a Logo a Beginners Course</a></div>
										<div class="latest_price">Free</div>
									</div>
								</div>

								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image">
										<div><img src="<?= base_url(); ?>/assets-front/images/latest_2.jpg" alt=""></div>
									</div>
									<div class="latest_content">
										<div class="latest_title"><a href="course.html">Photography for Beginners Masterclass</a></div>
										<div class="latest_price">$170</div>
									</div>
								</div>

								<!-- Latest Course -->
								<div class="latest d-flex flex-row align-items-start justify-content-start">
									<div class="latest_image">
										<div><img src="<?= base_url(); ?>/assets-front/images/latest_3.jpg" alt=""></div>
									</div>
									<div class="latest_content">
										<div class="latest_title"><a href="course.html">The Secrets of Body Language</a></div>
										<div class="latest_price">$220</div>
									</div>
								</div>

							</div>
						</div>


						<!-- Tags -->
						<div class="sidebar_section">
							<div class="sidebar_section_title">Tags</div>
							<div class="sidebar_tags">
								<ul class="tags_list">
									<li><a href="#">creative</a></li>
									<li><a href="#">unique</a></li>
									<li><a href="#">photography</a></li>
									<li><a href="#">ideas</a></li>
									<li><a href="#">wordpress</a></li>
									<li><a href="#">startup</a></li>
								</ul>
							</div>
						</div>

						<!-- Banner -->
						<div class="sidebar_section">
							<div class="sidebar_banner d-flex flex-column align-items-center justify-content-center text-center">
								<div class="sidebar_banner_background" style="background-image:url(images/banner_1.jpg)"></div>
								<div class="sidebar_banner_overlay"></div>
								<div class="sidebar_banner_content">
									<div class="banner_title">Free Book</div>
									<div class="banner_button"><a href="#">download now</a></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="newsletter_background parallax-window" data-parallax="scroll" data-image-src="images/newsletter.jpg" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-center justify-content-start">

						<!-- Newsletter Content -->
						<div class="newsletter_content text-lg-left text-center">
							<div class="newsletter_title">sign up for news and offers</div>
							<div class="newsletter_subtitle">Subcribe to lastest smartphones news & great deals we offer</div>
						</div>

						<!-- Newsletter Form -->
						<div class="newsletter_form_container ml-lg-auto">
							<form action="#" id="newsletter_form" class="newsletter_form d-flex flex-row align-items-center justify-content-center">
								<input type="email" class="newsletter_input" placeholder="Your Email" required="required">
								<button type="submit" class="newsletter_button">subscribe</button>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?= $this->endSection() ?>