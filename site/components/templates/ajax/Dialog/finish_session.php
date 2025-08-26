<div class="grid ">
	<div class="grid gap__3 inner-y__3 inner-x__1">
		<div class="flex justify__space-between">
			<div class="grid gap__05 inner-t__02">
				<h1 class="">Finish session</h1>
				<p class="op__6 font__size__lg">Log or discard this session</p>
			</div>
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_calendar.svg') ?></icon></a>
		</div>
		<div class="grid gap__1">
			<form action="form/discard_workout" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout ?>">
				<input type="hidden" name="workout" value="<?= $workout ?>">
				<button type="submit" class="button bg__invert/10 justify__center"><span>Discard session</span></button>
			</form>
			<form action="form/log_workout" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout ?>">
				<input type="hidden" name="workout" value="<?= $workout ?>">
				<button type="submit" class="button bg__invert color__dark justify__center"><span>Log session</span></button>
			</form>
		</div>
	</div>
</div>
