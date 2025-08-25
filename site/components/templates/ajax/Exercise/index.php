<?php
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	$exercise ??= null;
	$exercise = $kirby->controller('get_exercise', [ 'kirby' => $kirby, 'id' => $exercise, 'workout' => $workout['id'] ]);
	extract($exercise);
?>
<form id="update_exercise" action="form/update_exercise" method="post">
	<input type="hidden" name="workout" value="<?= $workout['id'] ?>">
	<input type="hidden" name="exercise" value="<?= $exercise['id'] ?>">
	<toolbar class="sticky inset__top-stretch inner-r__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05 z__1 bg__inherit">
		<a modal-reveal modal-open="prev" href="modal/workout/index/workout=<?= $workout['id'] ?>" class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-left.svg') ?></icon></a>
		<nav class="button__group">
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		</nav>
	</toolbar>
	<header class="">
		<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05">
			<div class="flex gap__1 align__center">

				<div class="grid gap__05 align__center inner-t__04">
					<h1><?= $head['name'] ?></h1>
					<?php if (sizeof($sets) > 0) : ?>
						<?php 
							$test = ['status' => 1];
							$completed = array_filter($sets, function ($set) use ($test) {
						        return count(array_intersect_assoc($test, $set)) == count($test);
						    });
						?>
						<div class="flex align__center gap__1">
							<p class="font__size__md"><?= count($completed) ?> of <?= count($sets) ?> sets completed</p>
							<?php if(in_array($exercise['id'], $workout['superset'])) : ?>
								<div class="button tag bg__invert color__dark"><span>Superset</span></div>
							<?php endif ?>
						</div>
					<?php else: ?>
						<p class="font__size__md op__6">Add or remove sets as you need. When you’re ready to start a workout, perform a set, then tick the checkbox to log it.</p>
					<?php endif ?>
				</div>
			</div>

		</div>
	</header>
	<section data-section>
		<list class="grid gap-x__07 gap-y__2 inner__1">
			<?php if (isset($sets)) : ?>
				<?php foreach ($sets as $key => $set) : ?>
					<?= snippet('molecules/Set', compact('workout','set','key')) ?>
				<?php endforeach ?>
			<?php endif ?>
		</list>
	</section>
</form>
<form action="form/add_set" method="post" modal-reload="modal/exercise/index/workout=<?= $workout['id'] ?>&exercise=<?= $id ?>">
	<input type="hidden" name="workout" value="<?= $workout['id'] ?>">
	<input type="hidden" name="exercise" value="<?= $id ?>">
	<input type="hidden" name="index" value="<?= isset($key) ? $key + 1 : 0 ?>">
	<button type="submit" modal-reveal class="flex justify__start align__center gap__1 inner__1">
		<a class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></a>
		<span class="font__size__lg">Add set</span>
	</button>
</form>	
