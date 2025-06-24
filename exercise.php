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
		$WORKOUT = db_fetch_row('workouts',"id", $LIFT['workout']);
	}
	if (isset($_REQUEST['w'])) {
	}

	$BODY = get_lift_bodypart($LIFT['id']);
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
		<div id="top" data-barba="container" data-barba-namespace="index" data-barba-container data-page="index" class="page c-light bg-dark">
			
			<main class="device" data-scroll-container>

				<div class="screen">

					<div class="app">

						<?php  
							// var_dump($WORKOUT);
							// var_dump($LIFT);
						?>
								
						<div class="page__title">
							<a href="workout.php?w=<?php echo $WORKOUT['id'] ?>" class="page__action c-light"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-left.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></a>

							<div class="page__action c-light-2" data-select-widget data-menu>
								<!-- <div class=" checkbox" ><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_stats.svg') ?></span></div> -->
								<div class="" data-select-open="lift_options">
									<input readonly type="hidden" class="" placeholder="Lift options" name=lift-options value="<?php echo $WORKOUT['id'] ?>" data-select-output>
									<div class=" checkbox" ><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></div>
								</div>
							</div>
						</div>

						<form action="template/forms/form_edit_lift.php" method=post class="" data-lift="<?php echo $LIFT['id'] ?>"> 
							<input type="hidden" name="workout" value="<?php echo $WORKOUT['id'] ?>">
							<input type="hidden" name="lift"  value="<?php echo $LIFT['id'] ?>">
							<div class="tag_list">
								<?php 
								foreach (get_lift_bodypart($LIFT['id']) as $bodypart) { ?>
									<div class="tag --fill c-<?php echo $bodypart['slug'] ?> bg-<?php echo $bodypart['slug'] ?>-2"><?php echo $bodypart['name'] ?></div>
								<?php } ?>
							</div>
							<a href="" class="form__group bleed c-light-2" data-select-widget>
								<div class="card__header c-light" data-select-open="exercise">
									<div class="card__meta ">
										<label class="f-1" for="exercise" data-select-label><?php echo $selected ? $EXERC['name'] : '<span class="c-light-2">Add exercise</span>' ?></label>
										<input readonly type="hidden" class="f-1" placeholder="Select exercise" name=exercise value="<?php echo $selected ? $EXERC['id'] : null ?>" data-select-output>										
									</div>
									<button class="checkbox"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_chevron-down.svg') ?></span></button>
								</div>
								
							</a>
							<div class="form__group bleed c-light-2"  data-select-widget data-select-multiple>
								<div class="form__select " data-select-open="mods">
									<input type="hidden" name=mods value=<?php echo $LIFT['mods'] ?> data-select-output>
									<div class="card__header" >
										<div class="tag__list c-light-4" data-select-output-html>
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
							<div class="c-light-2">
								<div class="sets app__grid">
									<div class="set set__header bleed c-light-2">
										<div class="grid grid__5">
											<div class="label grid-start ">set</div>
											<div class="label grid-center">weight</div>
											<!-- <div class="label grid-end">goal</div> -->
											<div class="label grid-end">reps&nbsp;</div>
											<div class="label --no-gap-left grid-start">• RIR</div>
											<div class="label grid-end"></div>
										</div>
										<!-- <button class="checkbox"><span class="icon"></span></button> -->

									</div>						
									<?php 
										foreach (json_decode($LIFT['sets'], true) as $key => $setID) {
											$SET = db_fetch_row('sets',"id", $setID);
											// var_dump($SET); 
											include('template/layout/set_item.php');
										}
									?>
										
													
								</div>
							</div>
							<a href="template/forms/form_add_set.php?w=<?php echo $WORKOUT['id'] ?>&l=<?php echo $LIFT['id'] ?>" class="form__group bleed c-light-2">
								<div class="card__header">
									<div class="card__meta">
										<input readonly type="text" class="" placeholder="Add set" name= value="" >
									</div>
									<div class=" checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></div>
								</div>
							</a>
							<div class="app__grid">	
								<div></div>
								<div></div>
								<div class="grid bleed c-light-2">
									<div class="grid-center">
										<div class="label">Volume</div>
										<?php
											$progress = get_lift_progress($LIFT['id']);
											$dir = $progress > 0 ? 'up' : 'down';
										?>
									</div>
				
								</div>
								<div class="grid bleed">
									<a href="progress.php?l=<?php echo $LIFT['id'] ?>&w=<?php echo $LIFT['workout'] ?>" class="form__group --card grid-center grid-pad ">
										<input readonly type="text" placeholder="0" name="volume" value="<?php echo $LIFT['volume'] ? $LIFT['volume'] : number_format(calc_lift_score($LIFT['id']),0,'','') ?>">
										<div class=" card__progress"><span class="icon arrow-<?php echo $dir ?>"></span></div>
									</a>
								</div>

							</div>

							<div class="form__group --textarea c-light-2 bleed" >
								<!-- <div class="card__header c-light" > -->
									<textarea class="c-light" placeholder="Feedback" name="feedback"><?php echo $LIFT['feedback'] ?></textarea>
									<!-- <div class="button"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></div> -->
								<!-- </div> -->
								
							</div>
						<!-- </div> -->
							<!-- <a href="template/forms/form_delete_lift.php?w=<?php echo $WORKOUT['id'] ?>&l=<?php echo $LIFT['id'] ?>" class="form__group bleed c-light-2" data-select-widget data-dialog>
								<div class="card__header c-light" data-select-open="confirm">
									<div class="card__meta">
										<input readonly type="text" class="" placeholder="Delete exercise" name=delete-exercise value="" data-select-output>
									</div>
									<div class=" checkbox"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_delete.svg') ?></span></div>
								</div>
							</a>
 -->
							<button type=submit class="next bg-<?php echo $COLOR ?> c-dark">
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