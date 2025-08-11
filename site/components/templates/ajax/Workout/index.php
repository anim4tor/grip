<toolbar class="inner__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05">
	<a modal-reveal modal-close class="button circle --left"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
	<nav class="button__group">
		<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></a>
		<a modal-reveal class="button bg__invert color__dark">Start</a>
	</nav>
</toolbar>
<header class="">
	<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05">
		<div class="flex gap__1 align__center bg__inherit">

			<div class="grid gap__05 align__center inner-t__04">
				<h1>Upper body</h1>
				<p class="font__size__lg">Upper body <span class="op__5">workout</span></p>
			</div>
		</div>

	</div>
</header>
<section data-section>
	<list class="grid gap-x__07 gap-y__2 inner__1">
		<?= snippet('molecules/Exercise') ?>
		<exercise class="flex justify__space-between align__start relative" modal-reveal>
			<header class="flex gap__1 align__start">
				<div class="grid__stack place__center-center ">
					<a class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_workout.svg') ?></icon></a>
					<figure class="progress --exercise"></figure>
					<div superset class="superset absolute op__3">
						<icon><?= svg('public/assets/images/ui/ui_superset.svg') ?></icon>
					</div>
				</div>
				<div class="grid gap__02 align__center wrap-y__07">
					<h2>Pull Ups (weighted) (weighted)(weighted) </h2>
					<p class="font__size__md"><span class="op__5">3 sets</span></p>
				</div>
			</header>
			<nav class="button__group wrap-t__03">
				<a class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></a>
				<a class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></a>
			</nav>
		</exercise>
		<exercise class="flex justify__space-between align__start relative" modal-reveal>
			<header class="flex gap__1 align__start">
				<div class="grid__stack place__center-center ">
					<a class="button circle bg__invert color__dark"><icon><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
					<figure class="progress --exercise op__0"></figure>
				</div>
				<div class="grid gap__02 align__center wrap-y__07">
					<h2>Pull Ups (weighted) </h2>
					<p class="font__size__md"><span class="op__5">3 sets</span></p>
				</div>
			</header>
			<nav class="button__group wrap-t__03">
				<a class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></a>
				<a class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></a>
			</nav>
		</exercise>	
	</list>
	<div class="flex justify__start align__center gap__1 inner__1">
		<a class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></a>
		<span class="font__size__lg">Add exercise</span>
	</div>
</section>
