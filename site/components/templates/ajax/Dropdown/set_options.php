<?php
	$set = $kirby->controller('get_set', compact('kirby','workout','exercise','set'));
	$set['dropset'] ??= 0;
	$set['warmup'] ??= 0;
?>
<div class="grid gap__05 bg__dark/30" data-dropdown>
	<div class="grid inner-x__1 bg__invert/5">
		<form action="form/warm_set" method="post" class="grid <?= $set['warmup'] ? 'op__3' : null ?>" modal-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercise" value="<?= $exercise ?>">
			<input type="hidden" name="index" value="<?= $set['index'] ?>">
			<input type="hidden" name="warmup" value="<?= !$set['warmup'] ? true : false ?>">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 ">
				<icon><?= svg('public/assets/images/ui/ui_warmup.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Warmup</span>
			</button>
		</form>
		<form action="form/drop_set" method="post" class="grid <?= $set['dropset'] ? 'op__3' : null ?>" modal-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercise" value="<?= $exercise ?>">
			<input type="hidden" name="index" value="<?= $set['index'] ?>">
			<input type="hidden" name="dropset" value="<?= !$set['dropset'] ? true : false ?>">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 ">
				<icon><?= svg('public/assets/images/ui/ui_dropset.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Dropset</span>
			</button>
		</form>
	</div>
	<div class="grid inner-x__1 bg__invert/5">
		<form action="form/move_set" method="post" class="grid" modal-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercise" value="<?= $exercise ?>">
			<input type="hidden" name="key" value="<?= $set['index'] ?>">
			<input type="hidden" name="dir" value="up">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_before.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Move before</span>
			</button>
		</form>
		<form action="form/move_set" method="post" class="grid" modal-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercise" value="<?= $exercise ?>">
			<input type="hidden" name="key" value="<?= $set['index'] ?>">
			<input type="hidden" name="dir" value="down">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 ">
				<icon><?= svg('public/assets/images/ui/ui_after.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Move after</span>
			</button>
		</form>
	</div>
	<div class="grid inner-x__1 bg__invert/5">
		<form action="form/duplicate_set" method="post" class="grid" modal-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercise" value="<?= $exercise ?>">
			<input type="hidden" name="index" value="<?= $set['index'] ?>">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_copy.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Duplicate</span>
			</button>
		</form>
		<form action="form/remove_set" method="post" class="grid" modal-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
			<input type="hidden" name="workout" value="<?= $workout ?>">
			<input type="hidden" name="exercise" value="<?= $exercise ?>">
			<input type="hidden" name="index" value="<?= $set['index'] ?>">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 ">
				<icon><?= svg('public/assets/images/ui/ui_delete.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Delete</span>
			</button>
		</form>
	</div>
	
</div>