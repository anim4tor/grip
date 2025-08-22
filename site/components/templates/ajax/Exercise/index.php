<?php
	$workout ??= null;
	$workout = $kirby->controller('workout', [ 'id' => $workout ]);

	$exercise ??= null;
	$exercise = $kirby->controller('exercise', [ 'id' => $exercise ]);
	extract($exercise);
?>
<form id="update_exercise" action="form/update_exercise" method="post">
	<input type="hidden" name="workout" value="<?= $workout['id'] ?>">
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
					<h1><?= $name ?></h1>
					<p class="font__size__md">Add or remove sets as you need. When you’re ready to start a workout, perform a set, then tick the checkbox to log it.</p>
				</div>
			</div>

		</div>
	</header>
	<section data-section>
		<list class="grid gap-x__07 gap-y__2 inner__1">
			<?php if (isset($workout['sets'])) : ?>
				<?php foreach ($workout['sets'] as $key => $set) : ?>
					<?= snippet('molecules/Set', compact('exercise','set','key')) ?>
				<?php endforeach ?>
			<?php endif ?>
		</list>
	</section>
</form>
<form action="form/add_set" method="post" modal-reload="modal/exercise/index/workout=<?= $workout['id'] ?>&exercise=<?= $id ?>">
	<input type="hidden" name="workout" value="<?= $workout['id'] ?>">
	<input type="hidden" name="exercise" value="<?= $id ?>">
	<button type="submit" modal-reveal class="flex justify__start align__center gap__1 inner__1">
		<a class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></a>
		<span class="font__size__lg">Add set</span>
	</button>
</form>	
