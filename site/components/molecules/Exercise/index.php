<?php
	$title ??= 'Pull Ups (weighted)';
	$desc ??= '3 sets';
	$progress ??= 0.0;
	$superset ??= false;
	$completed ??= false;

	$index ??= null;
	$last ??= false;
	$workout ??= null;
	$exercise ??= null;
	$exercise['head'] = collection('Exercises')[array_search($exercise['id'], array_column(collection('Exercises'), 'id'))];
	// var_dump($exercise);
	// extract($exercise);
	$workout['mods'][$exercise['id']] ??= [];
	extract($exercise);
?>
<exercise class="grid relative" modal-reveal style="--progress: <?= $progress ? $progress : 0 ?>">
	<a modal-open="next" href="modal/exercise/index/workout=<?= $workout['id'] ?>&exercise=<?= $id ?>" class="flex justify__space-between align__start inner-y__1 inner-l__1">
		<header class="flex gap__1 align__start">
			<div class="exercise__figure grid__stack place__center-center ">
				<?php if ($progress == 1) : ?>
					<button class="button circle bg__invert color__dark"><icon><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></button>
					<figure class="progress --exercise op__0"></figure>
				<?php else: ?>
					<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_workout.svg') ?></icon></button>
					<figure class="progress --exercise"></figure>
				<?php endif ?>
			</div>
			<div class="grid gap__02 align__center wrap-t__08">
				<h2 class="inner-r__8"><?= $head['name'] ?></h2>
				<p class="font__size__md op__5 flex gap__02 align__center"><?= !empty($workout['mods'][$exercise['id']]) ? '<span>' . implode(', ', $workout['mods'][$exercise['id']]) . '</span>' : null ?><?= !empty($workout['mods'][$exercise['id']]) ? '<span class="dot"></span>' : null ?> <span class=""><?= sizeof($sets) ?> sets</span></p>
			</div>
		</header>
	</a>
	<nav class="absolute inset__top-right button__group wrap-t__05 inner-t__1">
		<button open-dropdown href="modal/dropdown/exercise_options/workout=<?= $workout['id'] ?>&exercise=<?= $id ?>&key=<?= $key ?>" class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></button>
		<button class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></button>
	</nav>
	<?php if (!$last) : ?>
		<?= snippet('atoms/Input/superset', [ 'label' => 'Superset', 'value' => $id, 'id' => 'superset-'.rand(0,1000), 'name' => 'superset[]', 'checked' => in_array($id, $workout['superset']) ? true : false ]) ?>
	<?php endif ?>
	
</exercise>
