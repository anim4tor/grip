<?php
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	$exercises = [];
	foreach ($workout['exercises'] ??= [] as $id) {
		$exercises[] = $kirby->controller('get_exercise', [ 'kirby' => $kirby, 'id' => $id, 'workout' => $workout['id'] ]);
	}
	// extract($workout);
	
?>
<form action="form/update_workout" method="post" >
	<input type="hidden" name="id" value="<?= $workout['id'] ?>">
	<toolbar class="sticky inset__top-stretch inner-r__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05 z__1 bg__inherit">
		<a modal-reveal modal-close class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
		<nav class="button__group">
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></a>
			<a open-dialog href="modal/dialog/finish_session/workout=<?= $workout['id'] ?>" modal-reveal class="button bg__invert color__dark">Start</a>
		</nav>
	</toolbar>
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
					<?php
						$progress = 0;
						// $test = ['status' => 1];
						// $progress = sizeof(array_filter($exercise['sets'], function ($set) use ($test) {
						//     return count(array_intersect_assoc($test, $set)) == count($test);
						// }));
					?>
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
