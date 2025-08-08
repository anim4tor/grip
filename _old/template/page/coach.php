<?php 
	session_start();
	$relpath = '';
	include_once('template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'coach';

	if (isset($_REQUEST['d'])) {
		$today = strtotime($_REQUEST['d']);
	} else {
		$today = strtotime('Today');
	}
	$WEEK = load_week($today);
	$activeDay = date('N', $today);

	foreach ($WEEK as $key => $DAY) {
		$WEEK[$key]['workouts'] = load_day_workouts($DAY['date']);
	}

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
		<div id="top" data-barba="container" data-barba-namespace="index" data-barba-container data-page="index" class="page c-text bg-light">
			
			<main class="device" data-scroll-container>

				<div class="screen" data-tabs>

					<div class="app" data-tab-widget=<?php echo $activeDay ?> data-context="week" data-leaguess="mkl">
						
						<div class="page__title">
							<a href="coach.php">
								<h1><?php echo date('F',$today) ?></h1>
							</a>
							<h2>
								<a href="coach.php">D</a><span class="w-tiny c-text-5">/</span><a href="week.php" class="c-text-5">W</a><span class="w-tiny c-text-5">/</span><a href="month.php" class="c-text-5">M</a>
							</h2>
						</div>
						<div></div>
						<div class="calendar">

							<div class="calendar__week c-dark">
								<?php
									foreach ($WEEK as $key => $DAY) { 
										// var_dump($DAY);
										?>
										<div data-tab class="calendar__day" data-day="<?php echo $DAY['date'] ?>">
											<div class="label"><?php echo $DAY['name'] ?></div>
											<div class="day">
												<div class='num'><?php echo $DAY['daynum']?></div>
												<div class="events">
													<!-- <span class="event --spacer"></span> -->
													<?php foreach ($DAY['workouts'] as $key => $W) { 
														$color = '';
														switch ($W['title']) {
															case 'Push workout':
																// code...
																$color = "chest";
																break;
															case 'Pull workout':
																// code...
																$color = "back";
																break;
															case 'Leg workout':
																// code...
																$color = "quad";
																break;
															
															default:
																// code...
																$color = "rest";
																break;
														}
														?>
														<div data-event="" class="event bg-<?php echo $color ?>">
															<span class="event__label"></span>
														</div>
													<?php } ?>
													
												</div>
											</div>
										</div>
									<?php }
								?>
							</div>
							
						</div>
						<div></div>
						<?php
							//var_dump($week);

						?>
						<div class="" data-tab-wrapper>
							<div data-pane-container>
								<?php
								foreach ($WEEK as $DAY) { 
									// var_dump($DAY);
									?>
									<div data-pane="<?php echo $DAY['date'] ?>">
									<?php
										
										foreach ($DAY['workouts'] as $key => $W) {
											// include template
											include('template/layout/workout_item.php');
										} 
									?>
									</div>
								<?php } 
								?>
							</div>
						</div>
						

					</div>
					
				</div>
				
				<!-- component templates -->
				<?php include('template/body/header.php') ?>

			</main>

		</div> <!-- barba container end -->

	</div> <!-- scroll container end --><!-- barba wrapper end -->


	<!-- external js -->
	<?php include('template/body/js.php'); ?>


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