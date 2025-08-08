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
		<div id="top" data-barba="container" data-barba-namespace="index" data-barba-container data-page="index" class="page c-text bg-back">
			
			<main class="device" data-scroll-container>

				<div class="screen">

					<div class="app">
						
						<a href="add_workout.php" class="page__action"><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-left.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></a>
						<div class="page__title">
							<h1>Back</h1>
						</div>
						<div></div>
						<div class="grid grid__2">
							<div class="card bg-dark c-light">
								<div class="card__header">
									<div class="card__meta">
										<h2><large>4</large></h2>
									</div>
									
								</div>
								<div class="card__end end-xs">
									<p class="label c-light-5">exercises</p>
								</div>
							</div>
							<div class="card bg-dark c-light">
								<div class="card__header">
									<div class="card__meta">
										<h2><large>20</large></h2>
									</div>
									
								</div>
								<div class="card__end end-xs">
									<p class="label c-light-5">sets</p>
								</div>
							</div>
						</div>
						
						
						<div class="form__group c-text-3">
							<div class="label c-dark">Exercise 1</div>

							<div class="card__header c-dark">
								<div class="card__meta">
									<h2>Pull Ups <span class="tag">weighted</span></h2>
								</div>
								<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></button>
							</div>
							<div class="form__group">
								<!-- <div class="label">Sets</div> -->

								<div class="form__select ">
									<h2 class="">Add set</h2>
									<button class=" checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

								</div>
							</div>
						</div>
						
						<div class="form__group c-text-3">

							<div class="card bleed">
								<div class="label c-dark">Exercise 2</div>
								<div class="card__header c-dark">
									<div class="card__meta">
										<h2>Cable Pull <br>Downs <span class="tag">unilateral</span></h2>
										
									</div>
									<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></button>
								</div>
							</div>
							<div></div>
							<div class="sets">
								
								<div class="set set__header c-text-3 bleed">
									<div class="form__group grid grid__3 center c-dark">
										<div class="label">set</div>
										<div class="label">weight</div>
										<div class="label">reps</div>
									</div>
									<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></button>
								</div>						
								<div class="set card card__inline c-dark bleed">
									<div class="form__group grid grid__3 center">
										<h2 class="dial__input">N</h2>
										<h2 class="dial__input">25.0</h2>
										<h2 class="dial__input">12</h2>
									</div>
									
									<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></button>
								</div>						
								<div class="set card card__inline c-dark bleed">
									<div class="form__group grid grid__3 center">
										<h2 class="dial__input">N</h2>
										<h2 class="dial__input">25.0</h2>
										<h2 class="dial__input">12</h2>
									</div>
									
									<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></button>
								</div>						
								<div class="set">
									<div class="form card card__inline pad-0 bg-dark c-light bleed">
										<div class="form__group grid grid__3">
											<div class="form__dial dial" data-dial>
												<h2 class="dial__input">N</h2>
												<h2 class="dial__input">D</h2>
												<h2 class="dial__input">C</h2>
												<h2 class="dial__input">M</h2>
												<h2 class="dial__input">G</h2>
											</div>
											<div class="form__dial dial" data-dial>
												<h2 class="dial__input ">BW</h2>
												<?php for ($w=0.0; $w < 100.0; $w+=0.5) { ?>
													<h2 class="dial__input "><?php echo number_format($w,1) ?></h2>
												<?php } ?>
											</div>
											<div class="form__dial dial" data-dial>
												<?php for ($r=1; $r < 30; $r++) { ?>
													<h2 class="dial__input "><?php echo number_format($r,0) ?></h2>
												<?php } ?>
											</div>
										</div>
										<button class="checkbox bg-dark c-purple"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></button>
									</div>
								</div>
							</div>
							<div class="form__group">
								<div class="form__select ">
									<h2 class="">Add set</h2>
									<button class=" checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

								</div>
							</div>
						</div>

						<div class="form__group c-text-3">
							<div class="card__header c-dark">
								<div class="card__meta">
									<h2>Bentover Rows <span class="tag">unilateral</span> <span class="tag">dumbell</span></h2>
									<!-- <p class="">unilateral</p> -->
								</div>
								<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></button>
							</div>
							<div class="form__group">
								<!-- <div class="label">Sets</div> -->

								<div class="form__select ">
									<h2 class="">Add set</h2>
									<button class=" checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

								</div>
							</div>
						</div>
						
						<div class="form__group c-text-3">
							<div class="card__header c-dark">
								<div class="card__meta">
									<h2>Lat Pullover <span class="tag">unilateral</span></h2>
									<!-- <p class="">unilateral</p> -->
								</div>
								<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></button>
							</div>
							<div class="form__group">
								<!-- <div class="label">Sets</div> -->

								<div class="form__select ">
									<h2 class="">Add set</h2>
									<button class=" checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

								</div>
							</div>
						</div>
						
						<div class="form__group c-text-3">
							<!-- <div class="label">Sets</div> -->
							<div class="form__select ">
								<h2 class="">Add exercise</h2>
								<button class="checkbox"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?></span></button>

							</div>
						</div>
						

						
					</div>
					
				</div>

				<div class="next bg-dark c-light"><!-- <div class="btn__label">Continue</div> -->
					<button class="c-light-5"><span class="icon"><?php echo file_get_contents('dist/img/ui_delete.svg') ?></span></button>
					
					<button><span class="icon"><?php echo file_get_contents('dist/img/ui_chevron-right.svg') ?></span></button>
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
			        console.log('active')
			        Array.from(dial).slice.call(dial.children).forEach(function (ele, index) {
			            console.log(Math.abs(ele.getBoundingClientRect().top - dial.getBoundingClientRect().top))
			            if (Math.abs(ele.getBoundingClientRect().top - dial.getBoundingClientRect().top) == 0) {
			                // The 'ele' element at this moment is the element currently
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