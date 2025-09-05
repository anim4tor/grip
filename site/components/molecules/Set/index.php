<?php 
	$_this = 'molecules/Set';
	$exercise ??= null;
	$set ??= null;
	$key ??= null;
	extract($set);

?>

<set class="flex justify__space-between align__start relative <?= $dropset ?? 0 ? 'inner-l__2' : null ?>" modal-reveal data-dialog-parent>
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][index]" value="<?= $key ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][status]" value="<?= $status ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][bw]" value="<?= $bw ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][assisetd]" value="<?= $assisted ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][dropset]" value="<?= $dropset ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][warmup]" value="<?= $warmup ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][exercise]" value="<?= $exercise ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][reps]" data-select-bind=reps value="<?= $reps ?? 0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][weight]" data-select-bind=weight value="<?= $weight ?? 0.0 ?>">
	<input type="hidden" name="sets[<?= $exercise ?>][<?= $index ?>][rpe]" data-select-bind=rpe value="<?= $rpe ?? 0 ?>">

	<header class="flex gap__05 align__start">
		<?php if($status ?? 0): ?>
			<a open-dialog href="modal/dialog/select_rpe/workout=<?= $workout['id'] ?>&exercise=<?= $exercise ?>&index=<?= $key ?>&status=<?= $status ?>" class="button checkbox bg__invert color__dark"><icon class=""><?= $warmup ?? 0 ? svg('public/assets/images/ui/ui_warmup.svg') : svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php else: ?>
			<a open-dialog href="modal/dialog/select_rpe/workout=<?= $workout['id'] ?>&exercise=<?= $exercise ?>&index=<?= $key ?>&status=<?= $status ?>" class="button checkbox border bg__invert/10"><icon class="op__3"><?= $dropset ?? 0 ? svg('public/assets/images/ui/ui_dropset.svg') : null ?> <?= $warmup ?? 0 ? svg('public/assets/images/ui/ui_warmup.svg') : null ?></icon></a>
		<?php endif ?>
		<a open-dialog href="modal/dialog/select_weight/workout=<?= $workout['id'] ?>&exercise=<?= $exercise ?>&index=<?= $key ?>&bw=<?= $bw ?? 0 ?>&assisted=<?= $assisted ?? 0 ?>" class="button border"><span><span data-select-output=weight><?= $weight ?? 0.0 ?></span> kg</span></a>
		<a open-dialog href="modal/dialog/select_reps/workout=<?= $workout['id'] ?>&exercise=<?= $exercise ?>&index=<?= $key ?>" class="button border"><span><span data-select-output=reps><?= $reps ?? 0 ?></span> reps</span></a>
	</header>
	<nav class="button__group">
		<a open-dropdown href="modal/dropdown/set_options/workout=<?= $workout['id'] ?>&exercise=<?= $exercise ?>&set=<?= $key ?>" class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></a>
	</nav>
</set>
