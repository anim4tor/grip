<?php
	$bodyparts = [
		'Push',
		'Pull',
		'Full body',
		'Upper body',
		'Legs',
		'Glutes',
		'Back',
		'Chest',
		'Shoulders',
		'Arms',
		'Biceps',
		'Triceps',
		'Forearms',
		'Quads',
		'Hamstrings',
		'Calves',
	]
?>
<toolbar class="sticky inset__top-stretch inner-r__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05 z__1 bg__inherit shadow">
	<a modal-reveal modal-close class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
	<nav class="button__group">
		<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></a>
		<a open-dialog href="modal/dialog/finish_session" modal-reveal class="button bg__invert color__dark">Start</a>
	</nav>
</toolbar>
<div class="sticky top__20 left__0 right__0 ">
	<div class="flex justify__end align__center inner__1 h__6 border__bottom border__top">
		<a open-dialog href="modal/dialog/select_rpe" class="button circle bg__invert color__dark"><icon class=""><?= svg('public/assets/images/ui/ui_arrow-right.svg') ?></icon></a>
	</div>
</div>
<section class="-wrap-t__6">
	<div class="grid inner-t__14 inner-b__20">
		<?php
			//var_dump($POST['selected'])
			foreach ($bodyparts as $bodypart) { ?>
				<div class="option flex align__center inner__1 h__6" data-select-option=<?php echo $bodypart ?>>
					<h1 class=""><?php echo $bodypart ?></h1>
				</div>
			<?php }
		?>
	</div>
</section>
<footer class="sticky inset__bottom-stretch z__1 bg__inherit">
	<div class="grid inner-y__2 inner-x__1 border__top shadow">
		<div class="grid gap__05 inner-t__02">
			<p class="font__size__5 "><span class="op__6">Add</span> <span>Full body </span><span class="op__6">to your workouts</span></p>
			<p class="op__5">Exercises for all major muscles</p>
		</div>
	</div>
</footer>