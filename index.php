<?php 
	session_start();
	$relpath = '';
	include_once('template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'home';

	if (isset($_REQUEST['d'])) {
		$today = strtotime($_REQUEST['d']);
	} else {
		$today = strtotime('Today');
	}
	$week = load_week($today);
	// var_dump($week);
	$activeDay = date('N', $today);
	$todayDate = strftime('%G-%m-%d', $today);
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

				<div class="screen">

					<div class="app">
						<a href="week.php" class="page__title">
							<h1><span><?php echo date('l, j',$today) ?></span><small class="c-dark-5"><?php echo date('n',$today) ?> / <?php echo number_format(date('W',$today),0) ?></small></h1>
							<button class="page__action bg-light c-text"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-right.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></button>
						</a>
						
						<?php
						$WORKOUTS = db_fetch_rows('workouts',"schedule = '{$todayDate}'");
						foreach ($WORKOUTS as $key => $W) {
							// include template
							include('template/layout/workout_item.php');
						} ?>

						<?php
							$LOAD = calc_week_load($week);
							// var_dump($LOAD);
						?>
						
						<div></div>				
						<div></div>		
						<div class="grid grid__2 grid-middle">
							<h1><?php echo $LOAD['sets'] ?> <span class="c-dark-4">sets</span></h1>
							<p class="c-text-3">You scored <?php echo $LOAD['total'] ?> this week, keep pushing!</p>
						</div>		
						<div class="blocks blocks__grid">
							<?php
							foreach ($week as $day) { ?>
								<div class="blocks__column">
								<?php
									$load = $LOAD['week'][$day['date']];
									$counter = 0;
									foreach ($load as $body => $part) {
										$color = $body;
										$blockCount = $part['count'] / $LOAD['unit'];
										// var_dump($blockCount);
										for ($i = 0; $i < $blockCount ; $i++) { 
											// code...
										?>
											<div class="block <?php echo $day['this'] ? '--today' : '--grayscale' ?> <?php echo $day['yesterday'] ? '--yesterday' : '' ?> bg-<?php echo $color ?>"></div>
										
										<?php
											// echo $i;
											$counter++;
										}
										# code...
									}
								?>
								<?php
									for ($remains = 7; $remains > $counter ; $remains--) { 
										// code...
										echo '<div class="block completed"></div>';
									}
								?>
								</div>
							<?php } 
							?>
							
						</div>

					</div>
					
				</div>
				
				<!-- component templates -->
				<?php include('template/body/header.php') ?>

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