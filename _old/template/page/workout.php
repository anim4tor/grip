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
		// $WORKOUT['date'] = explode(' ', $WORKOUT['schedule'])[0];
		// $WORKOUT['time'] = explode(' ', $WORKOUT['schedule'])[1];
		
	} else {
		$WORKOUT['id'] = db_insert_blank('workouts');
		header('Location: ' . $root.'/add_workout.php?w=' . $WORKOUT['id']);
		$WORKOUT['lifts'] = '[]';

	}

	$BODY = get_workout_bodypart($WORKOUT['id']);
	reset($BODY);
	$COLOR = key($BODY);
	$COLOR = 'invert';
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
		<div id="top" data-barba="container" data-barba-namespace="index" data-barba-container data-page="index" style="--accent: var(--c-<?php echo $COLOR ?>)" class="page c-light bg-dark">
			
			<main class="device" data-scroll-container>

				<div class="screen">

					<div class="app" data-tabs>
						

						<div class="page__title">
							<a href="week.php" class="page__action c-light-5"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-left.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></a>

							<div class="page__action c-light-2" data-select-widget data-menu>
								<div class="" data-select-open="workout_options">
									<input readonly type="hidden" class="" placeholder="Workout options" name=workout-options value="<?php echo $WORKOUT['id'] ?>" data-select-output>
									<div class=" checkbox" ><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></div>
								</div>
								
							</div>
							
						</div>
						<form action="template/forms/form_edit_workout.php" method=post class="" data-tab-widget data-context="workout">
							<input type="hidden" name="id" value="<?php echo $WORKOUT['id'] ?>">
							<div class="form__group bleed c-light-2" >
								<div class="card__header c-light" >
									<div class="card__meta">
										<input class="f-1" type="text" class="" placeholder="Workout" name=title value="<?php echo $WORKOUT['title'] ?>">
										<!-- <h2 class="">Delete workout</h2> -->
									</div>
									<div class=" checkbox"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_edit.svg') ?></span></div>
								</div>
							</div>
							<br>

							<div class="grid__tabs bleed ">
								<div data-tab class="tab"><h4><small>Exercises</small></h4></div>
								<div data-tab class="tab"><h4><small>Config</small></h4></div>
								<a href="stats.php?w=<?php echo $WORKOUT['id'] ?>" class="tab c-light-2" ><h4><small>Stats</small></h4></a>
							</div>


							<div class="" data-tab-wrapper>
								<div data-pane-container>
							
									
									<div data-pane="">
										<div class="app__grid">
											<!-- <div></div>
											<div></div>
											<div></div>
											<div></div> -->
											<!-- <div class="grid bleed c-light-2">
												<div class="grid-center">
													<div class="label">Exercises</div>
												</div>
											</div> -->
											<!-- <div></div> -->
											<!-- <div class="form__group c-invert-2">
												<div class="form__select ">
													<h2 class="">Title</h2>
													<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_history.svg') ?></span></button>
											
												</div>
											</div> -->
											
											<?php
												foreach (json_decode($WORKOUT['lifts'],true) as $key => $id) {
													$L = db_fetch_row('lifts',"id", $id);
													$E = db_fetch_row('exercises',"id", $L['exercise']);
													$B = db_fetch_row("bodypart","id", $E['bodypart']);
													
													// var_dump($E);
													include('template/layout/lift_item.php');
													?>
													
													<?php
													# code...
												}
											?>
										</div>
										<a href="template/forms/form_add_lift.php?w=<?php echo $WORKOUT['id'] ?>" class="form__group c-light-2 bleed" data-select-widget data-redirect>
											<div class="card__header c-light" data-select-open="exercise">
												<div class="card__meta">
													<input readonly type="text" class="" placeholder="Add exercise" name="" value="" data-select-output>
												</div>
												<div class="button"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></div>
											</div>
										</a>	
										
									</div>

									<div data-pane="">
										<div></div>
										<div class="label c-invert-2">Split</div>
										<div class="form__group c-light-2 bleed" >
											<div class="form__radio_group c-light" >
												<div class="form__radio">
													<input id="split-push" class="form__radio_input" type="radio" class="" name=split value="push" <?php echo $WORKOUT['split'] == 'push' ? 'checked' : null ?>>
													<label for="split-push" class="form__radio_label"><h2>Push</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="split-pull" class="form__radio_input" type="radio" class="" name=split value="pull" <?php echo $WORKOUT['split'] == 'pull' ? 'checked' : null ?>>
													<label for="split-pull" class="form__radio_label"><h2>Pull</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="split-legs" class="form__radio_input" type="radio" class="" name=split value="legs" <?php echo $WORKOUT['split'] == 'legs' ? 'checked' : null ?>>
													<label for="split-legs" class="form__radio_label"><h2>Legs</h2></label>
													<!-- <h2 class="">Delete workout</h2> -->
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="split-other" class="form__radio_input" type="radio" class="" name=split value="no" <?php echo $WORKOUT['split'] == 'no' ? 'checked' : null ?>>
													<label for="split-other" class="form__radio_label"><h2>No</h2></label>
													<!-- <h2 class="">Delete workout</h2> -->
												</div>
											</div>
											<div></div>
											<div></div>
											<div></div>
										</div>
										<div></div>
										<div class="label c-invert-2">Schedule</div>
										<div class="form__date form__group c-light-2 bleed">
											<div class="card__header grid-around c-light" >
											<!-- <div class="form__dial dial grid-start" data-dial> -->

												<?php 
													$schedule = explode('-',$WORKOUT['schedule']);
												?>
												<div class="form__input grid-end" data-select-widget>
													<div data-select-open="days" class="grid-start">
														<input readonly class="" type="text" name="schedule[day]" placeholder="<?php echo date('j', time()) ?>" value="<?php echo $schedule[2] ?>" data-select-output>
														<!-- <span>RIR</span> -->
													</div>
												</div>
												<span class="c-light-2">/</span>
												<span>&nbsp;&nbsp;&nbsp;</span>
												<div class="form__input grid-end" data-select-widget>
													<div data-select-open="months" class="grid-start">
														<input readonly class="" type="text" name="schedule[month]" placeholder="<?php echo date('n', time()) ?>" value="<?php echo $schedule[1] ?>" data-select-output>
														<!-- <span>RIR</span> -->
													</div>
												</div>
												<span class="c-light-2">/</span>
												<span>&nbsp;&nbsp;&nbsp;</span>
												<div class="form__input grid-end" data-select-widget>
													<div data-select-open="year" class="grid-start">
														<input readonly class="" type="text" name="schedule[year]" placeholder="<?php echo date('Y', time()) ?>" value="<?php echo $schedule[0] ?>" data-select-output>
														<!-- <span>RIR</span> -->
													</div>
												</div>
												<!-- </div> -->
												<!-- <div class="form__dial dial grid-start" data-dial>
													<input type="time" name="time" value="<?php //echo $WORKOUT['time'] ?>">
												</div>
												<div class="form__dial dial grid-end" data-dial>
													<?php for ($h=1; $h <= 12; $h++) { ?>
														<h2 class="dial__input "><?php echo number_format($h,0) . ':00 AM' ?></h2>
													<?php } ?>
													<?php for ($h=1; $h <= 12; $h++) { ?>
														<h2 class="dial__input "><?php echo number_format($h,0) . ':00 PM' ?></h2>
													<?php } ?>
												</div> -->
											</div>
										</div>

										<div class="label c-invert-2">Bodyweight</div>
										<div class="form__group c-light-2 bleed" >
											<div class="card__header c-light" >
												<div class="card__meta">
													
													<input class="" type="text" class="" placeholder="Bodyweight" name=bodyweight value="<?php echo empty($WORKOUT['bodyweight']) ? null : $WORKOUT['bodyweight'] ?>">
													<!-- <h2 class="">Delete workout</h2> -->
												</div>
												<div class=" checkbox"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></div>
											</div>
										</div>
										<div class="label c-invert-2">Feedback</div>
										<div class="form__group --textarea c-light-2 bleed" >
											<!-- <div class="card__header c-light" > -->
												<textarea class="c-light" placeholder="Add feedback" name=feedback><?php echo $WORKOUT['feedback'] ?></textarea>
												<!-- <div class="button"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></div> -->
											<!-- </div> -->
											
										</div>
										<div class="label c-invert-2">Pump</div>
										<div class="form__group c-light-2 bleed" >
											<div class="form__radio_group c-light" >
												<div class="form__radio">
													<input id="pump-low" class="form__radio_input" type="radio" class="" name=pump value="0" <?php echo $WORKOUT['pump'] == 0 ? 'checked' : null ?>>
													<label for="pump-low" class="form__radio_label"><h2>L</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="pump-medium" class="form__radio_input" type="radio" class="" name=pump value="1" <?php echo $WORKOUT['pump'] == 1 ? 'checked' : null ?>>
													<label for="pump-medium" class="form__radio_label"><h2>M</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="pump-high" class="form__radio_input" type="radio" class="" name=pump value="2" <?php echo $WORKOUT['pump'] == 2 ? 'checked' : null ?>>
													<label for="pump-high" class="form__radio_label"><h2>H</h2></label>
													<!-- <h2 class="">Delete workout</h2> -->
												</div>
											</div>
											<div></div>
											<div></div>
											<div></div>
										</div>
										<div class="label c-invert-2">Fatique</div>
										<div class="form__group c-light-2 bleed" >
											<div class="form__radio_group c-light" >
												<div class="form__radio">
													<input id="fatique-low" class="form__radio_input" type="radio" class="" name=fatique value="0" <?php echo $WORKOUT['fatique'] == 0 ? 'checked' : null ?>>
													<label for="fatique-low" class="form__radio_label"><h2>L</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="fatique-medium" class="form__radio_input" type="radio" class="" name=fatique value="1" <?php echo $WORKOUT['fatique'] == 1 ? 'checked' : null ?>>
													<label for="fatique-medium" class="form__radio_label"><h2>M</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="fatique-high" class="form__radio_input" type="radio" class="" name=fatique value="2" <?php echo $WORKOUT['fatique'] == 2 ? 'checked' : null ?>>
													<label for="fatique-high" class="form__radio_label"><h2>H</h2></label>
													<!-- <h2 class="">Delete workout</h2> -->
												</div>
											</div>
											<div></div>
											<div></div>
											<div></div>
										</div>
										<div class="label c-invert-2">Muscle soreness</div>
										<div class="form__group c-light-2 bleed" >
											<div class="form__radio_group c-light" >
												<div class="form__radio">
													<input id="soreness-low" class="form__radio_input" type="radio" class="" name=soreness value="0" <?php echo $WORKOUT['soreness'] == 0 ? 'checked' : null ?>>
													<label for="soreness-low" class="form__radio_label"><h2>L</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="soreness-medium" class="form__radio_input" type="radio" class="" name=soreness value="1" <?php echo $WORKOUT['soreness'] == 1 ? 'checked' : null ?>>
													<label for="soreness-medium" class="form__radio_label"><h2>M</h2></label>
												</div>
												<span class="form__separator f-3 c-light-2">/</span>
												<div class="form__radio">
													<input id="soreness-high" class="form__radio_input" type="radio" class="" name=soreness value="2" <?php echo $WORKOUT['soreness'] == 2 ? 'checked' : null ?>>
													<label for="soreness-high" class="form__radio_label"><h2>H</h2></label>
													<!-- <h2 class="">Delete workout</h2> -->
												</div>
											</div>
											<div></div>
											<div></div>
											<div></div>
										</div>
									</div>


									<div data-pane="">
										<div class="app__grid">
											<div></div>
											<div class="grid grid__2 bleed c-light-2">
												<div class="grid-center">
													<div class="label">Volume</div>
												</div>
												<div class="grid-center">
													<div class="label">Sets</div>
												</div>
											</div>
											<div class="grid grid__2 bleed">
												<a href="stats.php?w=<?php echo $WORKOUT['id'] ?>" class="form__group --card grid-center grid-pad ">
													<input type="text" readonly placeholder="0" name="volume" value="<?php echo $WORKOUT['volume'] ? $WORKOUT['volume'] : number_format(calc_volume($WORKOUT['id']),0,'','') ?>">
											
												</a>
												
												<div class="form__group --card grid-center">
													<?php 
														$setcount = calc_sets(json_decode($WORKOUT['lifts'], true));
													?>
											
													<h2><br><?php echo $setcount ?><br><br></h2>
												</div>
											</div>
											<div></div>
											<div></div>
										</div>
									</div>
								</div>
							</div>

							<?php
								// var_dump($WORKOUT);
							?>
							<button type=submit class="next bg-<?php echo $COLOR ?> c-dark">
								<div class="button --block"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></div>
							</button>

							<!-- <header class="" data-header>
								<span></span>
								<button type="submit" class="button fab bg-<?php echo $COLOR ?> c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></button>

							</header> -->
						</form>
					</div>
				</div>

				<?php
					$page = isset($PAGE) ? $PAGE : 'home'; 
				?>


				
				

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

		// let container = document.querySelectorAll('[data-dial]')

		// container.forEach((dial, i)=>{

		// 	// Timer, used to detect whether horizontal scrolling is over
		// 	var timer = null;
		// 	// Scrolling event start
		// 	dial.addEventListener('scroll', function () {
		// 	    clearTimeout(timer);
		// 	    // Renew timer
		// 	    timer = setTimeout(function () {
		// 	        // No scrolling event triggered. It is considered that
		// 	        // scrolling has stopped do what you want to do, such
		// 	        // as callback processing
		// 	        // console.log('active')
		// 	        Array.from(dial).slice.call(dial.children).forEach(function (ele, index) {
		// 	            // console.log(Math.abs(ele.getBoundingClientRect().top - dial.getBoundingClientRect().top))
		// 	            if (Math.abs(ele.getBoundingClientRect().top - dial.getBoundingClientRect().top) == 0) {
		// 	                // The 'ele' element at this moment is the element currently
		// 	                console.log('active')
		// 	                // positioned. Add class .active for example!
		// 	                ele.classList.add('active')
		// 	            } else {
		// 	                // The 'ele' element at the moment is not
		// 	                // the currently positioned element
		// 	                ele.classList.remove('active')
		// 	            }
		// 	        });
		// 	    }, 0);
		// 	});
		       
	    // })

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