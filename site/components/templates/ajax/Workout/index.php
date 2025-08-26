<?php
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	$exercises = [];
	foreach ($workout['exercises'] ??= [] as $id) {
		$exercises[] = $kirby->controller('get_exercise', [ 'kirby' => $kirby, 'id' => $id, 'workout' => $workout['id'] ]);
	}
	// extract($workout);
	
?>
<toolbar class="sticky inset__top-stretch inner-r__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05 z__1 bg__inherit">
	<a modal-reveal modal-close class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
	<nav class="button__group">
		<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></a>
		<?php if (!$workout['start']) : ?>
			<form action="form/start_workout" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout['id'] ?>">
				<input type="hidden" name="workout" value="<?= $workout['id'] ?>">
				<button type="submit" modal-reveal class="button bg__invert color__dark">Start</button>
			</form>
		<?php else: ?>
			<a open-dialog href="modal/dialog/finish_session/workout=<?= $workout['id'] ?>" modal-reveal class="button bg__invert color__dark">Finish</a>
		<?php endif ?>

	</nav>
</toolbar>
<form id="update_workout" action="form/update_workout" method="post" >
	<input type="hidden" name="id" value="<?= $workout['id'] ?>">
	<header class="">
		<div class="inner-x__1 inner-b__1 flex align__center justify__space-between gap__05">
			<div class="flex gap__1 align__center">

				<div class="grid gap__05 align__center inner-t__04">
					<h1><?= $workout['title'] ?></h1>
					<p class="font__size__lg"><?= $workout['bodypart'] ?> <span class="op__5">workout</span></p>
				</div>
			</div>

		</div>
	</header>
	<section data-section>
		<list class="grid inner-y__1">
			<?php if (isset($exercises)) : ?>
				<?php foreach ($exercises as $key => $exercise) : ?>
					<?= snippet('molecules/Exercise', compact('exercise', 'workout', 'key')) ?>
				<?php endforeach ?>
			<?php endif ?>
		</list>
		<a modal-open="next" href="modal/exercise/add/workout=<?= $workout['id'] ?>" class="flex justify__start align__center gap__1 inner__1">
			<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></button>
			<span class="font__size__lg">Add exercise</span>
		</a>
	</section>
</form>
