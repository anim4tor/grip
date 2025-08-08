<?php 
	session_start();
	$relpath = '';
	include_once('template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'coach';
	$WORKOUT = array();

	if (isset($_REQUEST['w'])) {
		$WORKOUT = db_fetch_row('workouts',"id", $_REQUEST['w']);
		// $WORKOUT['lifts'] = db_fetch_rows('lifts',"workout = {$WORKOUT['id']}");
		
	} else {
		$WORKOUT['id'] = db_insert_blank('workouts');
		header('Location: ' . $root.'/add_workout.php?w=' . $WORKOUT['id']);
		$WORKOUT['lifts'] = '[]';

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
							<!-- <div class="label">Name</div> -->

							<div class="form__select ">
								<h2 class="">Title</h2>
								<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_history.svg') ?></span></button>

							</div>
						</div>
						<div></div>
						<div class="form__group grid c-invert-2">
							<!-- <div class="label">Timeline</div> -->
							<div class="form__group --inline bg-dark c-light bleed">
								<div class="form__dial dial grid-start" data-dial>
									<h2 class="dial__input">Tue 19</h2>
									<h2 class="dial__input">Wen 20</h2>
									<h2 class="dial__input">Today</h2>
									<h2 class="dial__input">Fri 22</h2>
									<h2 class="dial__input">Sat 23</h2>
								</div>
								<div class="form__dial dial grid-end" data-dial>
									<?php for ($h=1; $h <= 12; $h++) { ?>
										<h2 class="dial__input "><?php echo number_format($h,0) . ':00 AM' ?></h2>
									<?php } ?>
									<?php for ($h=1; $h <= 12; $h++) { ?>
										<h2 class="dial__input "><?php echo number_format($h,0) . ':00 PM' ?></h2>
									<?php } ?>
								</div>
							</div>

						</div>
						<?php
							foreach (json_decode($WORKOUT['lifts'],true) as $key => $id) {
								$L = db_fetch_row('lifts',"id", $id);
								$E = db_fetch_row('exercises',"id", $L['exercise']);
								$SETS = db_fetch_rows('sets',"workout = {$WORKOUT['id']} AND lift = {$L['id']}");
								// var_dump($L);
								?>
								<div class="form__group c-invert-2">
									<a href="edit_exercise.php?e=<?php echo $L['id'] ?>&w=<?php echo $WORKOUT['id'] ?>" class="card__header c-light ">
										<div class="card__meta">
											<h2><?php echo $E['name'] ?></h2>
											<div class="tag__list c-light-4">
												<?php
													foreach (json_decode($L['mods'], true) as $mod) {
														echo "<div class='tag'>{$mod}</div>";
													}
												?>
											</div>
										</div>
										<button class="card__action"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_chevron-right.svg') ?></span></button>
									</a>
									
									<div class="card__blocks blocks grid__3_2 c-purple-4">
										<?php
											foreach ($SETS as $set) {
												echo '<div class="block"></div>';
											}
										?>
										
									</div>
								</div>
								<?php
								# code...
							}
						?>
						
					
						<a href="add_exercise.php?w=<?php echo $WORKOUT['id'] ?>" class="form__group c-light-2 bleed" data-select-widget data-redirect>
							<div class="card__header c-light" data-select-open="body">
								<div class="card__meta">
									<!-- <h2 class="" data-select-default>Select exercise</h2> -->

								<input readonly type="text" class="" placeholder="Add exercise" name=exercise value="" data-select-collector>
									<!-- <h1>Lat Pullover </h1> -->
									
								</div>
								<button class="checkbox"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>
							</div>
							
						</a>
						<?php
							// var_dump($WORKOUT);
						?>
					</div>
				</div>

				<div class="next bg-purple c-dark"><!-- <div class="btn__label">Continue</div> -->
					<!-- <button class="c-text-5"><span class="icon"><?php echo file_get_contents('dist/img/ui_delete.svg') ?></span></button> -->
					<a href="add_exercise.php" class="button"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></a>
				</div>
				
				

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

		let container = document.querySelectorAll('[data-dial]')

		container.forEach((dial, i)=>{

			// Timer, used to detect whether horizontal scrolling is over
			var timer = null;
			// Scrolling event start
			dial.addEventListener('scroll', function () {
			    clearTimeout(timer);
			    // Renew timer
			    timer = setTimeout(function () {
			        // No scrolling event triggered. It is considered that
			        // scrolling has stopped do what you want to do, such
			        // as callback processing
			        // console.log('active')
			        Array.from(dial).slice.call(dial.children).forEach(function (ele, index) {
			            // console.log(Math.abs(ele.getBoundingClientRect().top - dial.getBoundingClientRect().top))
			            if (Math.abs(ele.getBoundingClientRect().top - dial.getBoundingClientRect().top) == 0) {
			                // The 'ele' element at this moment is the element currently
			                console.log('active')
			                // positioned. Add class .active for example!
			                ele.classList.add('active')
			            } else {
			                // The 'ele' element at the moment is not
			                // the currently positioned element
			                ele.classList.remove('active')
			            }
			        });
			    }, 0);
			});
		       
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