<?php 
	$_this = 'molecules/Set';
	$exercise ??= null;
	$set ??= null;
	$key ??= null;
	extract($set);
?>

<set class="flex justify__space-between align__start relative" modal-reveal data-dialog-parent>
	<input type="hidden" name="sets[<?= $key ?>][index]" value="<?= $key ?? 0 ?>">
	<input type="hidden" name="sets[<?= $key ?>][status]" value="<?= $status ?? 0 ?>">
	<input type="hidden" name="sets[<?= $key ?>][exercise]" value="<?= $exercise ?? 0 ?>">
	<input type="hidden" name="sets[<?= $key ?>][reps]" data-select-bind=reps value="<?= $reps ?? 0 ?>">
	<input type="hidden" name="sets[<?= $key ?>][weight]" data-select-bind=weight value="<?= $weight ?? 0.0 ?>">
	<input type="hidden" name="sets[<?= $key ?>][rpe]" data-select-bind=rpe value="<?= $rpe ?? 0 ?>">

	<header class="flex gap__05 align__start">
		<?php if($status ?? 0): ?>
			<a open-dialog href="modal/dialog/select_rpe/workout=<?= $workout['id'] ?>&exercise=<?= $exercise ?>&index=<?= $index ?>&status=<?= $status ?>" class="button checkbox bg__invert color__dark"><icon class=""><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php else: ?>
			<a open-dialog href="modal/dialog/select_rpe/workout=<?= $workout['id'] ?>&exercise=<?= $exercise ?>&index=<?= $index ?>&status=<?= $status ?>" class="button checkbox border bg__invert/10"><icon class="op__0"><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php endif ?>
		<a open-dialog href="modal/dialog/select_weight" class="button border"><span><span data-select-output=weight><?= $weight ?? 0.0 ?></span> kg</span></a>
		<a open-dialog href="modal/dialog/select_reps" class="button border"><span><span data-select-output=reps><?= $reps ?? 0 ?></span> reps</span></a>
	</header>
	<nav class="button__group">
		<a open-dropdown href="modal/dropdown/set_options" class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></a>
	</nav>
</set>
