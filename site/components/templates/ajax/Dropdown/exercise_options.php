<div class="grid gap__05 bg__dark/30" data-dropdown>
	<div class="grid inner-x__1 bg__invert/5">
		<form action="form/move_exercise" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="key" value="<?= $key ?>">
			<input type="hidden" name="dir" value="up">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_before.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Move before</span>
			</button>
		</form>
		<form action="form/move_exercise" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="key" value="<?= $key ?>">
			<input type="hidden" name="dir" value="down">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 ">
				<icon><?= svg('public/assets/images/ui/ui_after.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Move after</span>
			</button>
		</form>
	</div>
	<div class="grid inner-x__1 bg__invert/5">
		<form action="form/duplicate_exercise" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercises[]" value="<?= $exercise ?>">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_copy.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Duplicate</span>
			</button>
		</form>
		<form action="form/remove_exercise" method="post" class="grid" modal-reload="modal/workout/index/workout=<?= $workout ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercises[]" value="<?= $exercise ?>">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 ">
				<icon><?= svg('public/assets/images/ui/ui_delete.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Delete</span>
			</button>
		</form>
	</div>
</div>