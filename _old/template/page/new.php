<?php 
	session_start();
	$relpath = '';
	include_once('template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'coach';
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
		<div id="top" data-barba="container" data-barba-namespace="index" data-barba-container data-page="index" class="page c-light bg-dark">
			
			<main class="device" data-scroll-container>

				<div class="screen">

					<div class="app">
						
						<a href="<?php echo $root ?>/../" class="page__action c-light"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-left.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></a>
						<div class="page__title">
							<h1>New workout</h1>
						</div>
						<div></div>
						<div class="form__group c-invert-2">
							<div class="label">Name</div>

							<div class="form__select ">
								<h2 class="">Title</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-down.svg') ?></span></button>

							</div>
						</div>
						<div></div>
						<div class="form__group c-invert-2">
							<div class="label">Timeline</div>
							<div class="form__roll">
								<div class="form__select ">
									<h2 class="">Sun 1</h2>
									<h2>4:00 PM</h2>
								</div>
								<div class="form__select c-invert ">
									<h2 class="">Today</h2>
									<h2>5:00 PM</h2>
								</div>
								<div class="form__select ">
									<h2 class="">Tue 3</h2>
									<h2>6:00 PM</h2>
								</div>
							</div>
						</div>
						<div></div>
						<div class="form__group c-invert-2">
							<div class="label">Muscle group</div>
							<div class="form__select c-light">
								<h2 class="">Back</h2>
								<button class="button checkbox bg-back "><span class="icon"></span></button>
							</div>
							<div class="form__select c-light">
								<h2 class="">Biceps</h2>
								<button class="button checkbox bg-biceps "><span class="icon"></span></button>
							</div>
							<!-- <div class="form__select ">
								<h2 class="">Chest</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

							</div>
							<div class="form__select ">
								<h2 class="">Calves</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

							</div>
							<div class="form__select ">
								<h2 class="">Delts</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

							</div>
							<div class="form__select ">
								<h2 class="">Forearms</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

							</div>
							<div class="form__select ">
								<h2 class="">Hams</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

							</div>
							<div class="form__select ">
								<h2 class="">Quads</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

							</div> -->

							<div class="form__select ">
								<h2 class="">Add group</h2>
								<button class="bg-medium checkbox c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

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


						
					</div>
					
				</div>

				<div class="next bg-purple c-dark"><!-- <div class="btn__label">Continue</div> -->
					<button class="c-text-5"><span class="icon"><?php echo file_get_contents('dist/img/ui_delete.svg') ?></span></button>
					<button class="c-text-5"><span class="icon"><?php echo file_get_contents('dist/img/ui_history.svg') ?></span></button>
					<a href="add_exercise.php" class="button"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-right.svg') ?></span></a>
				</div>
				
				

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
				
			},0)

		});

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