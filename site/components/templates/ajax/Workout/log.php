<?php
	$workout ??= null;
	$workout = $kirby->controller('get_log', [ 'id' => $workout ]);
	$exercises = [];
	foreach ($workout['exercises'] ??= [] as $id) {
		$exercises[] = $kirby->controller('get_log_exercise', [ 'kirby' => $kirby, 'id' => $id, 'workout' => $workout['id'] ]);
	}
	$date = new DateTime();
  	$date->setTimestamp($workout['end']);
	// extract($workout);
	$superset = false;
	
?>
<toolbar class="sticky inset__top-stretch inner-r__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05 z__1 bg__inherit">
	<a modal-reveal close-modal class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
	<nav class="button__group">
		<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></a>
		<a open-dialog href="modal/dialog/delete_log/log=<?= $workout['id'] ?>" modal-reveal class="button circle bg__red color__invert"><icon><?= svg('public/assets/images/ui/ui_delete.svg') ?></icon></a>
		
	</nav>
</toolbar>
<header class="">
	<div class="inner-x__1 inner-b__1 flex align__center justify__space-between gap__05">
		<div class="flex gap__1 align__center">

			<div class="grid gap__05 align__center inner-t__04">
				<h1><?= $workout['title'] ?></h1>
				<p class="flex align__center gap__04 op__6"><?= $date->format('l') ?><span class="dot"></span><?= $date->format('F') ?> <?= $date->format('j') ?><span class="dot"></span><?= $workout['duration'] ?> min</p>
			</div>
		</div>

	</div>
</header>
<section data-section>
	<list class="grid inner-y__1">
		<?php if (isset($exercises)) : ?>
			<?php foreach ($exercises as $key => $exercise) : ?>
				<?php $last = $key == count($exercises) - 1 ? true : false ?>
				<?= snippet('molecules/Exercise/log', compact('exercise', 'workout', 'key', 'last')) ?>
			<?php endforeach ?>
		<?php endif ?>
	</list>
</section>
