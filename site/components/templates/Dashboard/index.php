
<header class="fixed inset__top-stretch z__1 bg__inherit">
	<div class="inner__1 inner-t__3 inner-b__1 flex align__center justify__space-between gap__05 ">
		<div class="flex gap__1 align__center ">
			<!-- <a class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_chevron-down.svg') ?></icon></a> -->
			<div class="grid gap__05 align__center">
				<h1>Workouts</h1>
				<!-- <p class="font__size__md flex align__center gap__05 op__8"><span>17 logs</span><span class="dot"></span><span>Last log 20 Mar</span></p> -->
			</div>
		</div>
		<nav class="button__group">
			<a class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
			<a open-dropdown href="modal/dropdown/workouts_add" class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></a>
		</nav>
	</div>
</header>

<section data-section>
	<div class="grid grid__2 gap-x__07 gap-y__1 inner__1">

		<?php foreach (collection('Workouts') as $workout) : /*var_dump($workout);*/ ?>
			<?= snippet('molecules/Workout', compact('workout')) ?>
		<?php endforeach; ?>

		<card class="grid inner__1 inner-y__2 bg__white/10 relative border">
			<header class="absolute inset__top-stretch flex justify__end inner__05 op__4">
				<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
			</header>
			<div class="grid gap__2 place__end-start">	
				<figure class="font__size__1">
					<span class="l">86</span>
					<span class="s op__5 light">%</span>
				</figure>
				<div class="grid gap__02">
					<h2>Body weight</h2>
					<p class="op__5">31 min ago</p>
				</div>
			</div>
		</card>

		<card class="grid span__2 inner__1 inner-y__2 bg__white/10 relative border" style="--progress: 0.7">
			<div class="grid gap__2 place__center-stretch">	
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
							<h3 class="font__size__2">2</h3>
						</figure>
						<div class="grid gap__02">
							<h2>Body weight</h2>
							<p class="op__5">31 min ago</p>
						</div>
					</div>
					<div class="op__4">
						<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
					</div>
				</div>
			</div>
		</card>

		<card class="grid span__2 inner__1 inner-y__1 bg__white/5 relative border" style="--progress: 0.66">
			<div class="card__progress "></div>
			<div class="flex justify__space-between align__center">
				<div class="flex gap__1 align__center">	
					<div class="grid ">
						<h2>Volume lifted</h2>
						<p class="op__5">Last 7 days</p>
					</div>
				</div>
				<figure class="font__size__2">
					<span class="l">3.200</span>
					<span class="s op__5 light">kg</span>
				</figure>
				<div class="op__4">
					<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
				</div>
			</div>
		</card>

		<card class="grid inner__1 inner-y__2 bg__white/10 relative border">
			<header class="absolute inset__top-stretch flex justify__end inner__05 op__4">
				<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
			</header>
			<div class="grid gap__2 place__end-start">	
				<figure class="font__size__1">
					<span class="l">86</span>
					<span class="s op__5 light">%</span>
				</figure>
				<div class="grid gap__02">
					<h2>Body weight</h2>
					<p class="op__5">31 min ago</p>
				</div>
			</div>
		</card>
		
		<card class="grid inner__1 inner-y__2 bg__white/10 relative border" style="--progress: 0.3">
			<header class="absolute inset__top-stretch flex justify__end inner__05 op__4">
				<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
			</header>
			<div class="grid gap__2 place__end-start">	
				<figure class="progress --large">
					<h3 class="font__size__1">2</h3>
				</figure>
				<div class="grid gap__02">
					<h2>Chest + triceps</h2>
					<p class="op__5">Fridays</p>
				</div>
			</div>
		</card>

		<card class="grid span__2 inner__1 inner-y__2 bg__white/10 relative border">
			<div class="grid gap__2 place__center-stretch">	
				<figure class="font__size__1">
					<span class="xl">86</span>
					<span class="m op__5 light">%</span>
				</figure>
				<div class="flex justify__space-between align__center">
					<div class="grid gap__02">
						<h2>Body weight</h2>
						<p class="op__5">31 min ago</p>
					</div>
					<div class="op__4">
						<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
					</div>
				</div>
			</div>
		</card>
		
	</div>
</section>
<?php foreach (collection('Workouts') as $workout) : /*var_dump($workout);*/ ?>
	<?php if ($workout['start']): ?>
		<div modal-open href="modal/workout/index/workout=<?= $workout['id'] ?>" class="fixed inset__bottom-stretch left__05 right__05 inner-x__1 inner-b__7">
			<?= snippet('molecules/Workout/current', compact('workout')) ?>
		</div>
	<?php endif ?>
<?php endforeach; ?>
