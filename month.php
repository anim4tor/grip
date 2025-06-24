<?php 
	session_start();
	$relpath = '';
	include_once('template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'coach';

	if (isset($_REQUEST['d'])) {
		$today = date('Y-m-d', strtotime($_REQUEST['d']));
	} else {
		$today = date('Y-m-d', strtotime('Today'));
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

					<div class="app" data-tab-widget=1 data-context="month">

						<div class="" data-tab-wrapper>
							<div data-tab=""></div>
							<div data-pane-container>
								<div data-pane=<?php echo $today ?>>
									
							<?php
								// $now = date("Y-m-d", time());
								$calendar = new Calendar($today);

								// fetch events
								
								// add events
								$WORKOUTS = db_fetch_table('workouts');
								foreach ($WORKOUTS as $key => $W) {
									$BODY = get_workout_bodypart($W['id']);
									reset($BODY);
									$color = key($BODY) ? key($BODY) : 'red';
									$calendar->add_event($W['title'], $W['schedule'], 1, $color, 0);
								} 
		
								echo $calendar;
							?>
								</div>
							</div>
						</div>

						<div></div>
						

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