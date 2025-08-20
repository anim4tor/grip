<?php
	$title ??= 'Pull Ups (weighted)';
	$desc ??= '3 sets';
	$progress ??= 0.0;
	$superset ??= false;
	$completed ??= false;

	$workout ??= null;
	$exercise ??= null;
	$exercise = collection('Exercises')[array_search($exercise, array_column(collection('Exercises'), 'id'))];
	// var_dump($workout);
	extract($exercise);
	// extract($exercise);
?>
<exercise class="grid relative" modal-reveal style="--progress: <?= $progress ?>">
	<a modal-open="next" href="modal/exercise/index/workout=<?= $workout['id'] ?>&exercise=<?= $id ?>" class="flex justify__space-between align__start inner-y__0 inner-l__1">
		<header class="flex gap__1 align__start">
			<div class="exercise__figure grid__stack place__center-center ">
				<?php if ($completed) : ?>
					<button class="button circle bg__invert color__dark"><icon><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></button>
					<figure class="progress --exercise op__0"></figure>
				<?php else: ?>
					<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_workout.svg') ?></icon></button>
					<figure class="progress --exercise"></figure>
				<?php endif ?>
			</div>
			<div class="grid gap__02 align__center wrap-t__08">
				<h2 class="inner-r__8"><?= $name ?></h2>
				<p class="font__size__md"><span class="op__5"><?= $desc ?></span></p>
			</div>
		</header>
	</a>
	<nav class="absolute inset__top-right button__group inner-t__05">
		<button open-dropdown href="modal/dropdown/exercise_options" class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></button>
		<button class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></button>
	</nav>
</exercise>
<?= snippet('atoms/Input/superset', [ 'label' => 'Superset', 'value' => 'Superset', 'id' => 'superset-'.rand(0,1000), 'name' => 'superset[]', 'checked' => $superset ]) ?>