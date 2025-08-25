<?php

	$today = new DateTime();

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

<section data-section>
	<div class="grid gap-x__07 inner-y__1">
		<?php $today->modify('-15 days'); ?>

		<?php for ($i=0; $i < 30; $i++) : ?>
			<day class="grid gap__2 relative border__top inner-x__1 inner__2">
				<header class="flex gap__1 align__center ">
					<div class="exercise__figure grid__stack place__center-center ">
						<button class="button circle bg__invert/20"><h3 class="s"><?= $today->format('j') ?></h3></button>
					</div>
					<div class="grid align__center inner-t__03">
						<h3 class="ff__heading s"><?= $today->format('l') ?></h2>
						<p class="font__size__md"><span class="op__5"><?= $today->format('F') ?> <?= $today->format('j') ?></span></p>
					</div>
				</header>
				<?php
					$test = ['date' => $today->format('Y-m-d')];
					$workout = array_filter(collection('Log'), function ($log) use ($test) {
					    return count(array_intersect_assoc($test, $log)) == count($test);
					});
					if ($workout) {
						// var_dump($workout);
						snippet('molecules/Workout/log', [ 'workout' => $workout[0] ]); 
					}
				?>
			</day>
			<?php $today->modify('+1 day'); ?>
		<?php endfor ?>
		
		<?php foreach (collection('Log') as $workout) : /*var_dump($workout);*/ ?>
			<?= snippet('molecules/Workout', compact('workout')) ?>
		<?php endforeach; ?>

		
	</div>
</section>
