<form action="form/add_metric" method="post" modal-close page-reload>
	<input type="hidden" name="id" value="<?= time() ?>">
	<tabs data-tabs class="grid modal__content rows__auto-1 ">
		<toolbar class="inset__top-stretch h__6 inner-t__2 inner-b__1 flex align__center justify__space-between gap__2 z__2 bg__inherit">
			<a modal-reveal close-modal class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
			<div class="tabs__progress bg__white/10 h__04 grow radius" >
				<div class="progress__bar bg__invert radius h__04" data-tabs-progress></div>
				<span data-tab ></span>
				<span data-tab ></span>
				<span data-tab ></span>
				<span data-tab ></span>
			</div>
			<a modal-reveal data-tab-prev class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-left.svg') ?></icon></a>
		</toolbar>
		<div data-pane-container class="relative inset__stretch">
			<pane data-pane theme class="absolute inset__stretch grid rows__1-auto">
				<input type="hidden" name="metric" data-select-bind=metric data-update="title" value="Weight">
				<div class="select__widget --full relative" data-select=metric>
					<div class="selector absolute inset__stretch z__1">
						<div class="bg__dark/80" data-click-disabled></div>
						<div class="flex justify__end align__center inner__1 h__6 border__bottom border__top ">
							<a open-dialog href="modal/dialog/select_rpe" class="button circle bg__invert color__dark"><icon class=""><?= svg('public/assets/images/ui/ui_arrow-right.svg') ?></icon></a>
						</div>
						<div class="bg__dark/80" data-click-disabled></div>
					</div>
					<div class="select absolute inset__stretch grid" data-select-scroller>
						<?php
							//var_dump($POST['selected'])
							foreach (collection('Figures') as $metric) { ?>
								<a href="" data-tab-next class="option flex align__center inner__1 inner-y__2 h__6" data-select-option data-value='<?php echo $metric['name'] ?>'>
									<h1 class=""><?php echo $metric['name'] ?></h1>
								</a>
							<?php }
						?>
					</div>
				</div>
				<footer class="inset__bottom-stretch z__1 h__8 bg__inherit relative">
					<div class="grid inner-y__2 inner-x__1 border__top shadow">
						<div class="grid gap__05 inner-t__02">
							<p class="font__size__5 ">A metric measured in centimeters</p>
							<p class="op__5">For example arm or waist circumference</p>
						</div>
					</div>
				</footer>
			</pane>
			<pane data-pane theme class="absolute inset__stretch grid rows__1-auto">
				<div class="grid align__start">
					<header class="">
						<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05">
							<div class="flex gap__1 align__center">
								<div class="grid gap__05 align__center inner-t__04">
									<h1><span data-bind="title">Weight</span></h1>
									<p class="font__size__md op__6">Customize the name if you like</p>
								</div>
							</div>
						</div>
					</header>
					<div class="grid">
						<div class="inner__1">
							<?= snippet('atoms/Input/text', [ 'placeholder' => 'My workout', 'value' => 'Weight', 'name' => 'title', 'bind' => 'title', 'update' => 'title' ]) ?>
						</div>
					</div>
				</div>
				<footer class="inset__bottom-stretch z__1 bg__inherit relative">
					<div class="grid inner-y__2 inner-x__1 border__top shadow">
						<div class="flex justify__end gap__05">
							<a modal-reveal close-modal class="button circle border"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
							<a modal-reveal data-tab-next class="button bg__invert color__dark">Continue <icon><?= svg('public/assets/images/ui/ui_arrow-right.svg') ?></icon></a>
						</div>
					</div>
				</footer>
			</pane>
			<pane data-pane theme class="absolute inset__stretch grid rows__1-auto">
				<div class="grid rows__auto-1">
					<header class="">
						<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05 op__0">
							<div class="flex gap__1 align__center">
								<div class="grid gap__05 align__center inner-t__04">
									<h1>Layout</h1>
									<p class="font__size__md op__6"><span class="">How often do you plan to do upper body workouts?</span></p>
								</div>
							</div>
						</div>
					</header>
					<carousel class="carousel" data-carousel data-init data-value dynamic class="inner-x__1 ">
						<input type="hidden" name="layout" data-carousel-input value="square">
						<div class="carousel__list gap__1" data-carousel-slides>
							<slide data-slide="square" class="w__60 grid align__start">
								<card class="grid h__15 inner__1 inner-y__2 bg__card relative border" style="--progress: 0.0">
									<header class="absolute inset__top-stretch flex justify__end inner__05 op__4">
										<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
									</header>
									<div class="grid gap__2 place__end-start">	
										<figure class="progress --large">
											<h3 class="font__size__1">0</h3>
										</figure>
										<div class="grid gap__02">
											<h2><span data-bind="title">Full body</span></h2>
											<p class="op__5">Every week</p>
										</div>
									</div>
								</card>
								<div class="grid justify__center align__start">
									<div class="grid gap__05 w__15 justify__center inner-t__3">
										<h2 class="m">Square layout</h2>
										<p class="font__size__md text-center op__6"><span class="">The standard layout, highlights your cooldowns and streaks</span></p>
									</div>
								</div>
							</slide>
							<slide data-slide="large" class="w__80 grid align__start">
								<card class="grid h__15 inner__1 inner-y__2 inner-b__1 bg__card relative border" style="--progress: 0.0">
									<div class="grid gap__2 place__center-stretch align__space-between">	
										<calendar class="grid__3 gap__1">
											<month class="grid gap__1 justify__center">
												<h4 class="font__size__default">Jan</h4>
												<div class="grid gap__05">
													<week class="flex gap__05">
														<div class="dot large op__0"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
													</week>
												</div>
											</month>
											<month class="grid gap__1 justify__center">
												<h4 class="font__size__default">Feb</h4>
												<div class="grid gap__05">
													<week class="flex gap__05">
														<div class="dot large op__0"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
													</week>
												</div>
											</month>
											<month class="grid gap__1 justify__center">
												<h4 class="font__size__default">Mar</h4>
												<div class="grid gap__05">
													<week class="flex gap__05">
														<div class="dot large op__0"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large "></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
													</week>
													<week class="flex gap__05">
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__2"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
														<div class="dot large op__0"></div>
													</week>
												</div>
											</month>
										</calendar>
										<div class="flex justify__space-between align__center">
											<div class="flex gap__1 align__center">	
												<figure class="progress">
													<h3 class="font__size__2">0</h3>
												</figure>
												<div class="grid gap__02 inner-t__02">
													<h2><span data-bind="title">Full body</span></h2>
													<p class="op__5">Every week</p>
												</div>
											</div>
											<div class="op__4">
												<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
											</div>
										</div>
									</div>
								</card>
								<div class="grid justify__center align__start">
									<div class="grid gap__05 w__15 justify__center inner-t__3">
										<h2 class="m">Large layout</h2>
										<p class="font__size__md text-center op__6"><span class="">For a birds-eye-view of your activity the last three months</span></p>
									</div>
								</div>
							</slide>
							<slide data-slide="slim" class="w__80 grid align__start">
								<div class="grid h__15 place__end-stretch align__bottom">
									<card class="grid inner__1 inner-y__1 bg__card relative border" style="--progress: 0.0">
										<div class="flex justify__space-between align__center">
											<div class="flex gap__1 align__center">	
												<figure class="progress">
													<h3 class="font__size__2">0</h3>
												</figure>
												<div class="grid gap__02 inner-t__02">
													<h2><span data-bind="title">Full body</span></h2>
													<p class="op__5">Every week</p>
												</div>
											</div>
											<div class="op__4">
												<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
											</div>
										</div>
									</card>
								</div>
								<div class="grid justify__center align__start">
									<div class="grid gap__05 w__15 justify__center inner-t__3">
										<h2 class="m">Slim layout</h2>
										<p class="font__size__md text-center op__6"><span class="">A light package of the essentials</span></p>
									</div>
								</div>
							</slide>	
						</div>
						
					</carousel>
				</div>
				<footer class="inset__bottom-stretch z__1 bg__inherit relative">
					<a class="grid inner-y__2 inner-x__1 border__top shadow">
						<div class="flex justify__start align__center gap__1">
							<button modal-reveal type="submit" class="button circle bg__invert color__dark"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></button>
							<p class="font__size__lg "><span class="">Add to dashboard</p>
						</div>
					</a>
				</footer>
			</pane>
		</div>
	</tabs>
</form>