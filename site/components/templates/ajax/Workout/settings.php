<?php
	$library = collection('Exercises');
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	extract($workout);
	$exercises ??= [];
	$schedule = new DateTime($schedule);
?>
<form action="form/add_exercise" method="post" modal-back="modal/workout/index/workout=<?= $id ?>">
	<input type="hidden" name="workout" value="<?= $id ?>">
	<toolbar class="sticky inset__top-stretch inner-t__2 inner-b__1 inner-r__1 flex align__center justify__space-between gap__2 z__2 bg__inherit">
		<a modal-reveal modal-open="prev" href="modal/workout/index/workout=<?= $id ?>" class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-left.svg') ?></icon></a>
		<nav class="button__group">
			<a open-dialog href="modal/dialog/delete_workout/workout=<?= $id ?>" modal-reveal class="button circle bg__red color__invert"><icon><?= svg('public/assets/images/ui/ui_delete.svg') ?></icon></a>
		</nav>
	</toolbar>
	<header class="">
		<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05">
			<div class="flex gap__1 align__center">

				<div class="grid gap__05 align__center inner-t__04">
					<h1>Settings</h1>
					<p class="font__size__md"><span class="op__6">Schedule and tracking settings for</span> <?= $title ?></p>
				</div>
			</div>

		</div>
	</header>
	<section class="grid">
		<div class="inner__1">
			<?= snippet('atoms/Input/text', [ 'placeholder' => 'My workout', 'value' => $title, 'name' => 'title' ]) ?>
		</div>
	</section>
	<section>
		<list class="grid inner-y__1">
			<a modal-open="next" href="modal/workout/schedule/workout=<?= $id ?>" class="flex justify__space-between align__center gap__1 inner__1">
				<div class="flex gap__1">
					<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></button>
					<div class="grid">
						<h2 class="font__size__lg inner-t__02">Schedule</h2>
						<p class="font__size__md"><span class="op__6"><?= $schedule->format('l, F j') ?></span></p>
					</div>
				</div>
				<button class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></button>
			</a>
			<a modal-open="next" href="modal/workout/target/workout=<?= $id ?>" class="flex justify__space-between align__center gap__1 inner__1">
				<div class="flex gap__1">
					<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_target.svg') ?></icon></button>
					<div class="grid">
						<h2 class="font__size__lg inner-t__02">Targets</h2>
						<p class="font__size__md"><span class="op__6"><?= implode(', ', $bodyparts) ?></span></p>
					</div>
				</div>
				<button class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></button>
			</a>
			<a modal-open="next" href="modal/dialog/select_rest/workout=<?= $id ?>" class="flex justify__space-between align__center gap__1 inner__1">
				<div class="flex gap__1">
					<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_rest.svg') ?></icon></button>
					<div class="grid">
						<h2 class="font__size__lg inner-t__02">Rest time</h2>
						<p class="font__size__md"><span class="op__6"><?= $rest ?>s</span></p>
					</div>
				</div>
				<button class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></button>
			</a>
			<a modal-open="next" href="modal/workout/layout/workout=<?= $id ?>" class="flex justify__space-between align__center gap__1 inner__1">
				<div class="flex gap__1">
					<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_copy.svg') ?></icon></button>
					<div class="grid">
						<h2 class="font__size__lg inner-t__02">Layout</h2>
						<p class="font__size__md"><span class="op__6"><?= ucfirst($layout) ?></span></p>
					</div>
				</div>
				<button class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></button>
			</a>
		</list>
	</section>
</form>
	<!-- <footer class="sticky inset__bottom-stretch z__1 bg__inherit relative">
		<div class="grid inner-y__2 inner-x__1 border__top shadow">
			<div class="grid gap__05 inner-t__02">
				<p class="font__size__5 "><span class="op__6">Add</span> <span>Full body </span><span class="op__6">to your workouts</span></p>
				<p class="op__5">Exercises for all major muscles</p>
			</div>
		</div>
	</footer> -->