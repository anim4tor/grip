<?php 
	session_start();
	$relpath = '';
	include_once('_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'home';
?>

<!-- head template -->
<?php include('template/body/head.php'); ?>

<body>
	
	<!-- <img id="mockup" src="dist/img/mockup.jpg" alt=""> -->

	<!-- component templates -->
	<?php include('template/body/components.php') ?>

	<!-- scroll container --><!-- barba wrapper -->
	<div data-barba="wrapper" data-main>

		<!-- barba container -->
		<div id="top" data-barba="container" data-barba-namespace="index" data-barba-container data-page="index" class="page c-text">
			
			<main class="device" data-scroll-container>

				<main class="screen">

					<div class="app">
						<a href="/" class="page__action bg-light c-text"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-left.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></a>
						<div class="page__title">
							<h1>February</h1>
							<h2>W<span class="c-text-5">/M</span></h2>
						</div>
						<div></div>
						<div class="calendar">
							<div class="calendar__header">
								<div class="c-text-5">Mon</div>
								<div class="">Tue</div>
								<div class="c-text-5">Wen</div>
								<div class="c-text-5">Thu</div>
								<div class="c-text-5">Fri</div>
								<div class="c-text-5">Sat</div>
								<div class="c-text-5">Sun</div>
							</div>
							<div class="calendar__week">
								<div class="day c-text-5">5</div>
								<div class="day ">6</div>
								<div class="day c-text-5">7</div>
								<div class="day c-text-5">8</div>
								<div class="day c-text-5">9</div>
								<div class="day c-text-5">10</div>
								<div class="day c-text-5">11</div>
							</div>
						</div>
						<div></div>
						<!-- <div class="card bg-text c-purple">
							<div class="card__header">
								<div class="card__meta">
									<h2>Pull Day</h2>
									<p class="c-light-5">Lats, Biceps</p>
								</div>
								<button class="card__action bg-light c-text-5"><span class="icon"><img src="dist/img/ui_close.svg" alt=""></span></button>
							</div>
							<div class="card__blocks blocks">
								<div class="block"></div>
								<div class="block"></div>
								<div class="block"></div>
								<div class="block"></div>
							</div>
						</div> -->
						<div class="card bg-breakfast c-text">
							<div class="card__header">
								<div class="card__meta">
									<h2>Breakfast<br> meal</h2>
									<p class="c-text-5">50g Protein, 100g Carbs</p>
								</div>
								<button class="card__action bg-light c-text-5"><span class="icon"><img src="dist/img/ui_checkmark.svg" alt=""></span></button>
							</div>
							
							<div class="card__blocks blocks">
								<div class="block"></div>
								
							</div>
						</div>
						<div class="card bg-text c-sand ">
							<div class="card__header">
								<div class="card__meta">
									<h2>Push <br>workout</h2>
									<p class="c-light-5">Chest, Triceps, Delts</p>
								</div>
								<button class="card__action bg-light c-text-5"><span class="icon"><img src="dist/img/ui_checkmark.svg" alt=""></span></button>
							</div>
							
							<div class="card__blocks blocks">
								<div class="block"></div>
								<div class="block"></div>
								<div class="block"></div>
								<div class="block"></div>
							</div>
						</div>
						<div class="card bg-workout c-text">
							<div class="card__header">
								<div class="card__meta">
									<h2>Post- <br> Workout <br> meal</h2>
									<p class="c-text-5">50g Protein, 100g Carbs</p>
								</div>
								<button class="card__action bg-light c-text-5"><span class="icon"><img src="dist/img/ui_checkmark.svg" alt=""></span></button>
							</div>
							
							<div class="card__blocks blocks">
								<div class="block"></div>
								
							</div>
						</div>
						<div class="card bg-dinner c-text">
							<div class="card__header">
								<div class="card__meta">
									<h2>Dinner <br> meal</h2>
									<p class="c-text-5">50g Protein, 100g Carbs</p>
								</div>
								<button class="card__action bg-light c-text-5"><span class="icon"><img src="dist/img/ui_checkmark.svg" alt=""></span></button>
							</div>
							
							<div class="card__blocks blocks">
								<div class="block"></div>
								
							</div>
						</div>
						<div></div>
						

					</div>
					
				</main>
				


			</main>

		</div> <!-- barba container end -->

	</div> <!-- scroll container end --><!-- barba wrapper end -->


	<!-- external js -->
	<?php include($root . 'template/body/js.php'); ?>


	<!-- global js -->
	<script src="<?php echo $root ?>dist/js/app.dist.js?v=<?php echo $now ?>"></script>

	<!-- local js -->
	<script type="text/javascript">

		window.addEventListener('load', (event) => {
			setTimeout(function() {
				// CURSOR.reset()
				// initLocomotion(document)
				// Locomotion.update()
				const slider = document.querySelector('.flex');
				let isDown = false;
				let startX;
				let scrollLeft;

				slider.addEventListener('mousedown', (e) => {
				  isDown = true;
				  slider.classList.add('active');
				  startX = e.clientX - slider.offsetLeft;
				  scrollLeft = slider.scrollLeft;
				});
				slider.addEventListener('mouseleave', () => {
				  isDown = false;
				  slider.classList.remove('active');
				});
				slider.addEventListener('mouseup', () => {
				  isDown = false;
				  slider.classList.remove('active');
				});
				slider.addEventListener('mousemove', (e) => {
				  if(!isDown) return;
				  e.preventDefault();
				  const x = e.clientX - slider.offsetLeft;
				  const walk = (x - startX) * 3; //scroll-fast
				  slider.scrollLeft = scrollLeft - walk;
				  console.log(walk);
				});
			},0)

		});
		document.querySelectorAll('[data-sticky]').forEach(el => {
			// el.
			console.log(el.querySelector('img').getAttribute('src'))
			el.style.backgroundImage = 'url(/' + el.querySelector('img').getAttribute('src') + ')';

		})
		

	</script>

	<!-- end html -->
	<?php include($root . 'template/body/end.php'); ?>


<?php
	// generate dist 
	// ob_start();
	// include __FILE__;
	// $file_dist = ob_get_contents();
	// file_put_contents('dist/'.__FILE__, $file_dist);
	// ob_end_clean();
?>