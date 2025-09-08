<?php
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	$exercises = [];
	foreach ($workout['exercises'] ??= [] as $id) {
		$exercises[] = $kirby->controller('get_exercise', [ 'kirby' => $kirby, 'id' => $id, 'workout' => $workout['id'] ]);
	}
	// extract($workout);
	$superset = true;

	$duration = gmdate("i:s", time() - $workout['start']);
	
?>
<toolbar class="sticky inset__top-stretch inner-r__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05 z__10 bg__inherit">
	<a modal-reveal close-modal class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
	<nav class="button__group">
		<a modal-reveal modal-open="next" href="modal/workout/settings/workout=<?= $workout['id'] ?>" class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		<a modal-reveal modal-open="next" href="modal/workout/log/workout=<?= $workout['id'] ?>" class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></a>
		<?php if (!$workout['start']) : ?>
			<form action="form/start_workout" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout['id'] ?>">
				<input type="hidden" name="workout" value="<?= $workout['id'] ?>">
				<button type="submit" modal-reveal class="button bg__invert color__dark">Start</button>
			</form>
		<?php else: ?>
			<a open-dialog href="modal/dialog/finish_session/workout=<?= $workout['id'] ?>" modal-reveal class="button color__invert border">Finish</a>
		<?php endif ?>

	</nav>
</toolbar>
<header class="sticky inset__top-stretch ">
	<div class="inner-x__1 inner-b__1 flex align__center justify__space-between gap__05">
		<div class="flex gap__1 align__center">

			<div class="grid gap__05 align__center inner-t__04">
				<h1><?= $workout['title'] ?></h1>
				<p class="font__size__lg"><?= implode(', ',$workout['bodyparts']) ?> <span class="op__5">workout</span></p>
			</div>
		</div>

	</div>
</header>
<form id="update_workout" class="inner-b__8" action="form/update_workout" method="post" >
	<input type="hidden" name="id" value="<?= $workout['id'] ?>">
	<section data-section>
		<list class="grid inner-y__1">
			<?php if (isset($exercises)) : ?>
				<?php foreach ($exercises as $key => $exercise) : ?>
					<?php $last = $key == count($exercises) - 1 ? true : false ?>
					<?= snippet('molecules/Exercise', compact('exercise', 'workout', 'key', 'last')) ?>
				<?php endforeach ?>
			<?php endif ?>
		</list>
		<a modal-open="next" href="modal/library/index/workout=<?= $workout['id'] ?>" class="flex justify__start align__center gap__1 inner__1">
			<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></button>
			<span class="font__size__lg">Add exercise</span>
		</a>
	</section>
</form>
<?php if ($workout['start']) : ?>
	<footer class="fixed inset__bottom-stretch z__1 bg__inherit relative">
		<div class="grid inner-y__1 inner-x__1 bg__invert/5 border__top shadow">
			<div class="flex inner-y__05 justify__space-between align__center">
				<div class="flex align__center gap__1">
					<div class="exercise__figure grid__stack place__center-center ">
						<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_pause.svg') ?></icon></button>
						<figure class="progress --exercise"></figure>
					</div>
					<figure class="font__size__2">
						<h2 class="xl"><strong  data-duration="<?= $workout['start'] ?>"><?= $duration ?></strong></h2>
					</figure>
				</div>
				<div class="flex gap__05 align__center">
					<button class="button circle bg__invert/20 color__invert"><icon><?= svg('public/assets/images/ui/ui_close.svg') ?></icon></button>
					<button class="button circle bg__invert color__dark"><icon><?= svg('public/assets/images/ui/ui_arrow-right.svg') ?></icon></button>
				</div>
			</div>
		</div>
	</footer>
<?php endif ?>