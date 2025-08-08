<?php 
	session_start();
	$relpath = '';
	include_once('template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'stats';

	if (isset($_REQUEST['l'])) {
		$L = db_fetch_row('lifts',"id", $_REQUEST['l']);
		$E = db_fetch_row('exercises',"id", $L['exercise']);
	}
	if (isset($_REQUEST['w'])) {
		$W = db_fetch_row('workouts',"id", $_REQUEST['w']);
	// 	$LIFTS = db_fetch_rows('lifts',"workout = {$W['id']}","volume DESC");
	// 	$max = 0;
	// 	foreach ($LIFTS as $key => $L) {
	// 		$LIFTS[$key]['exercise'] = db_fetch_row('exercises',"id", $L['exercise']);
	// 		$max = $max < $L['volume'] ? $L['volume'] : $max;
	// 	}
	}

	$PROGRESS = get_lift_history($L['id']);
	$max = 0;
	foreach ($PROGRESS as $key => $l) {
		$max = $max < $l['volume'] ? $l['volume'] : $max;
	}
	$BODY = get_lift_bodypart($L['id']);
	reset($BODY);
	$COLOR = key($BODY);
	$COLOR = 'invert';
	// var_dump(get_lift_bodypart($L['id']));
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
		<div id="top" data-barba="container" data-barba-namespace="index" data-barba-container data-page="index" class="page c-dark bg-<?php echo $COLOR ?>">
			
			<main class="device" data-scroll-container>

				<div class="screen">

					<div class="app">

						<?php  
							// var_dump($WORKOUT);
							// var_dump($LIFT);
						?>
								
						<a href="workout.php?w=<?php echo $W['id'] ?>" class="page__action"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-left.svg') ?></span></a>
						<!-- <div class="tag__list">
							<div class="tag --fill bg-dark-5 c-text-5"><?php echo $W['title'] ?></div>
							<div class="tag --fill bg-dark-5 c-text-5"><?php echo $W['schedule'] ?></div>
							
						</div> -->
						<div class="page__title ">
							<a href="coach.php">
								<h1><?php echo $E['name'] ?></h1>
							</a>
						</div>
						<div class="tag__list">
						<?php foreach (json_decode($L['mods'],true) as $mod) {
							echo "<div class='tag'>{$mod}</div>";# code...
						} ?>
						</div>
						<div></div>
						<div class="table --columns bleed">
							<div class="table__inner">
								<?php
									
									// var_dump($PROGRESS);
									foreach ($PROGRESS as $L) { ?>
										<div class="table__column__outer">
										<a href="exercise.php?e=<?php echo $L['id'] ?>" class="table__column" style="--size: <?php echo $L['volume']/$max ?>">

											<div class="table__value end-xs">
												<h4><?php echo $L['volume'] ?></h4>
											</div>
											<div class="table__label">
												<div class="tag__list">
												<?php foreach (json_decode($L['mods'],true) as $mod) {
													//echo "<div class='tag'>{$mod}</div>";# code...
												} ?>
												</div>
											</div>
										</a>
										</div>
									<?php }
								?>
							</div>
						</div>

						<div class="summary bleed bg-<?php echo $COLOR ?>">
							<!-- <div></div> -->
							<div class="summary__header">
								<h1><large><?php echo $max ?></large></h1>
								<p class="lead c-text-4">Max score</p>
							</div>
							<!-- <p class="c-text-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus aliquid magnam itaque</p> -->
							<div></div>
							<div class="summary__end">
								<a href="exercise.php?e=<?php echo $L['id'] ?>" class="button bg-light c-dark"><div class="button__icon icon"><?php echo file_get_contents('dist/img/ui_close.svg') ?></div></a>
								<!-- <div class="button bg-dark c-light"><div class="button__label">Progress</div></div> -->
							</div>
						</div>

						<!-- <a class="form__group c-text-4 bleed" data-select-widget data-redirect>
							<div class="card__header" data-select-open="exercise">
								<div class="card__meta">
									<h2>Show more</h2>
								</div>
								<div class="button"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></div>
							</div>
							
						</a> -->
						
					</div>
					
				</div>

				<!-- component templates -->
				<?php // include('template/body/header.php') ?>

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