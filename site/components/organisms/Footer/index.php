<footer id="footer" data-footer>
	<div class="inner__1 inner-t__05 inner-b__2 bg__dark">
		<nav class="flex justify__space-between">
			<a href="workouts" class="button circle <?= $page == "workouts" ? null : 'op__4' ?> "><span class="icon"><?= svg('public/assets/images/ui/ui_dashboard.svg') ?></span></a>
			<a href="log" class="button circle <?= $page == "log" ? null : 'op__4' ?> "><span class="icon"><?= svg('public/assets/images/ui/ui_calendar.svg') ?></span></a>
			<a href="stats" class="button circle <?= $page == "stats" ? null : 'op__4' ?> "><span class="icon"><?= svg('public/assets/images/ui/ui_stats.svg') ?></span></a>
			<a class="button circle <?= $page == "social" ? null : 'op__4' ?>"><span class="icon"><?= svg('public/assets/images/ui/ui_intervals.svg') ?></span></a>
		</nav>
	</div>
</footer>