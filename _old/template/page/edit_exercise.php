<?php 
	session_start();
	$relpath = '';
	include_once('template/lib/_api.php');
	// include_once('template/lib/_config.php');	
	global $_GLOBAL;
	$now = time();
	$PAGE = 'coach';

	$selected = '';
	$WORKOUT = '';
	$EXERC = array();

	if (isset($_REQUEST['e'])) {
		$selected = $_REQUEST['e'];
		$LIFT = db_fetch_row('lifts',"id", $selected);
		$EXERC = db_fetch_row('exercises',"id", $LIFT['exercise']);
	}
	if (isset($_REQUEST['w'])) {
		$WORKOUT = db_fetch_row('workouts',"id", $_REQUEST['w']);
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

						<?php  
							// var_dump($WORKOUT);
							// var_dump($LIFT);
						?>

						<a href="add_workout.php?w=<?php echo $WORKOUT['id'] ?>" class="page__action c-light"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-left.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></a>
						<!-- <div class="page__title c-light-2">
							<h1>Add exercise</h1>
						</div>
						<div></div> -->
						
						<!-- <div class="form__group c-light-2">
							<div class="form__select">
								<div href="add_exercise.php" class="">
									<h1 default class="">Select exercise</h2>
									
								</div>
								<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-down.svg') ?></span></button>
							</div>
						</div> -->
						<!-- <div> -->
						<form action="template/forms/form_edit_workout.php" method=post class="">
							<input type="hidden" name="workout" value="<?php echo $WORKOUT['id'] ?>">
							<input type="hidden" name="lift" value="<?php echo $LIFT['id'] ?>">
							<div class="" data-select-widget>
								<div class="card__header c-light" data-select-open="body">
									<div class="card__meta ">
									<label class="f-1" for="exercise" data-select-label><?php echo $selected ? $EXERC['name'] : '<span class="c-light-2">Add exercise</span>' ?></label>
									<input readonly type="hidden" class="f-1" placeholder="Select exercise" name=exercise value="<?php echo $selected ? $EXERC['id'] : null ?>" data-select-collector>										
									</div>
									<button class="checkbox"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_chevron-down.svg') ?></span></button>
								</div>
								
							</div>
							<div class="form__group c-light-2"  data-select-widget data-select-multiple>
								<div class="form__select " data-select-open="mods">
									<input type="hidden" name=mods value=<?php echo $LIFT['mods'] ?> data-select-collector>
									<div class="card__header" >
										<div class="tag__list c-light-4" data-select-output>
											<h2 class="c-light-2" data-select-default>Add mods</h2>
											<?php
												foreach (json_decode($LIFT['mods']) as $key => $mod) {
													echo "<div data-option='{$mod}'><span class='tag'>{$mod}</span></div>";
												}
											?>
											
										</div>
										<a href="mods" class="button checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></a>
									</div>
								</div>
							</div>
							<div></div>
							<div class="form__group c-light-2">
								<div class="sets">
									<div class="set set__header bleed c-light-2">
										<div class="grid grid__3">
											<div class="label grid-start ">set</div>
											<div class="label grid-center">weight</div>
											<div class="label grid-end">reps</div>
										</div>
										<!-- <button class="checkbox"><span class="icon"></span></button> -->

									</div>						
									<?php 
										foreach (json_decode($LIFT['sets'], true) as $key => $setID) {
											$SET = db_fetch_row('sets',"id", $setID);
											// var_dump($SET);
											?>
												<div class="set c-light">
													<div class="form__group grid grid__3 center">
														<input readonly type="hidden" name="set[id][]" class=" " value="<?php echo $SET['id'] ?>" placeholder="" data-select-collector>
														
														<div class="grid-start" data-select-widget>
															<div data-select-open="set" class="grid-start">
																<input readonly type="text" name="set[type][]" class=" " value="<?php echo $SET['type'] ?>" placeholder="N" data-select-collector>
															</div>
														</div>
														<div class="grid-center" data-select-widget>
															<div data-select-open="weight" class="grid-center">
																<input readonly type="text" name="set[weight][]" class=" " value="<?php echo $SET['weight'] != '0' ? number_format($SET['weight'],1) : 'BW' ?>" placeholder="-" data-select-collector>
															</div>
														</div>
														<div class="grid-end" data-select-widget>
															<div data-select-open="reps" class="grid-end">
																<input readonly type="text" name="set[reps][]" class=" " value="<?php echo $SET['reps'] ?>" placeholder="-" data-select-collector>
															</div>
														</div>
													</div>
												
												</div>
											<?php
										}
									?>
										
													
								</div>
								<a href="template/forms/form_add_set.php?w=<?php echo $WORKOUT['id'] ?>&l=<?php echo $LIFT['id'] ?>" class="form__group">
									<div class="form__select ">
										<h2 class="">Add set</h2>
										<button class=" checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>
							
									</div>
								</a>
							</div>
						<!-- </div> -->
							<div class="form__group c-light-2">
								<a href="template/forms/form_delete_exercise.php?w=<?php echo $WORKOUT['id'] ?>&l=<?php echo $LIFT['id'] ?>" class="form__group">
									<div class="form__select ">
										<h2 class="">Delete exercise</h2>
										<button class=" checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_delete.svg') ?></span></button>
							
									</div>
								</a>
							</div>

							<button type=submit class="next bg-back c-dark">
								<div class="button --block"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></div>
							</button>

						</form>
					</div>
					
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