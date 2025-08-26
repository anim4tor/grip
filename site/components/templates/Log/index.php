<?php

	$today = new DateTime();
	$day = new DateTime();
	$limit = 30;
	$logs = $kirby->controller('log', [ 'limit' => $limit ]);

?>
<header class="fixed inset__top-stretch z__1 border__bottom shadow">
	<div class="inner__1 inner-t__3 inner-b__1 flex align__center justify__space-between gap__05 bg__dark">
		<div class="flex gap__1 align__center ">

			<div class="grid gap__05 align__center">
				<h1><?= $today->format('F') ?></h1>
			</div>
		</div>
		<nav class="button__group">
			<a class="button circle bg__invert/20"><span class="icon"><?= svg('public/assets/images/ui/ui_chevron-down.svg') ?></span></a>
		</nav>
	</div>
</header>

<calendar data-section>
	<month class="sticky inset-t__0 grid gap-x__07 inner-y__1">
		<?php $day->modify('-'.$limit.' days'); ?>

		<?php for ($i=0; $i < $limit + 1; $i++) : ?>
			<<?= $today->format('Y-m-d') == $day->format('Y-m-d') ? 'today' : 'day' ?> class="grid gap__2 relative border__top inner-x__1 inner__2">
				<header class="flex gap__1 align__center ">
					<div class="exercise__figure grid__stack place__center-center ">
						<?php if ($today->format('Y-m-d') == $day->format('Y-m-d')) : ?>
							<button class="button circle bg__invert color__dark"><h3 class="s"><?= $day->format('j') ?></h3></button>
						<?php else: ?>
							<button class="button circle bg__invert/20"><h3 class="s"><?= $day->format('j') ?></h3></button>
						<?php endif ?>
					</div>
					<div class="grid align__center inner-t__03">
						<h3 class="ff__heading s"><?= $day->format('l') ?></h2>
						<p class="font__size__md"><span class="op__5"><?= $day->format('F') ?> <?= $day->format('j') ?></span></p>
					</div>
				</header>
					<?php
						$test = ['date' => $day->format('Y-m-d')];
						$workouts = array_filter($logs, function ($log) use ($test) {
						    return count(array_intersect_assoc($test, $log)) == count($test);
						});
					?>
					<?php foreach ($workouts as $workout) : ?>
						<div class="grid gap__1 inner-l__4">
						<?php
							// var_dump($workout);
							snippet('molecules/Workout/log', [ 'workout' => $workout ]); 
						?>
						</div>
					<?php endforeach ?>
			</<?= $today->format('Y-m-d') == $day->format('Y-m-d') ? 'today' : 'day' ?>>
			<?php $day->modify('+1 day'); ?>
		<?php endfor ?>
	
	</month>
</calendar>
