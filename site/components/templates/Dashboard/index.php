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

		<?php foreach (collection('Dashboard') as $key => $item) : /*var_dump($workout);*/ ?>
			<?= snippet('molecules/'.ucFirst($item['dashboard']), [ $item['dashboard'] => $item ]) ?>
		<?php endforeach; ?>

	</div>
</section>
<?php foreach (collection('Workouts') as $workout) : /*var_dump($workout);*/ ?>
	<?php if ($workout['start']): ?>
		<div modal-open href="modal/workout/index/workout=<?= $workout['id'] ?>" class="fixed inset__bottom-stretch left__05 right__05 inner-x__1 inner-b__7">
			<?= snippet('molecules/Workout/current', compact('workout')) ?>
		</div>
	<?php endif ?>
<?php endforeach; ?>
