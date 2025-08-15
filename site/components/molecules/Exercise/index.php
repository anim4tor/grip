<?php
	$completed = isset($completed) ? $completed : false;
	$superset = isset($superset) ? $superset : false;
	$progress = isset($progress) ? $progress : 0.0;

?>
<exercise class="grid relative" modal-reveal style="--progress: <?= $progress ?>">
	<a modal-open="next" href="modal/exercise/index" class="flex justify__space-between align__start inner-y__1 inner-l__1">
		<header class="flex gap__1 align__start">
			<div class="exercise__figure grid__stack place__center-center ">
				<?php if ($completed) : ?>
					<button class="button circle bg__invert color__dark"><icon><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></button>
					<figure class="progress --exercise op__0"></figure>
					<div superset class="superset absolute <?= !$superset ? 'op__3' : null ?>">
						<icon><?= svg('public/assets/images/ui/ui_superset.svg') ?></icon>
					</div>
				<?php else: ?>
					<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_workout.svg') ?></icon></button>
					<figure class="progress --exercise"></figure>
					<div superset class="superset absolute <?= !$superset ? 'op__3' : null ?>">
						<icon><?= svg('public/assets/images/ui/ui_superset.svg') ?></icon>
					</div>
				<?php endif ?>
			</div>
			<div class="grid gap__02 align__center wrap-t__08">
				<h2>Pull Ups (weighted) </h2>
				<p class="font__size__md"><span class="op__5">3 sets</span></p>
			</div>
		</header>
	</a>
	<nav class="absolute inset__top-right button__group wrap-t__1 inner-t__05">
		<button open-dropdown href="modal/dropdown/exercise_options" class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></button>
		<button class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></button>
	</nav>
</exercise>