<?php 
	$_this = 'molecules/Set';
	$id ??= 0;
	$status ??= false;
	$dropset ??= false;
	$dropset ??= false;
	$weight ??= 0.0;
	$reps ??= 0;
	$rpe ??= 0;

	$exercise ??= null;
?>

<set class="flex justify__space-between align__start relative" modal-reveal data-dialog-parent>
	<input type="hidden" name="sets[<?= $key ?>][exercise]" value="<?= $exercise['id'] ?>">
	<input type="hidden" name="sets[<?= $key ?>][reps]" data-select-bind=reps value="<?= $reps ?>">
	<input type="hidden" name="sets[<?= $key ?>][weight]" data-select-bind=weight value="<?= $weight ?>">
	<input type="hidden" name="sets[<?= $key ?>][rpe]" data-select-bind=rpe value="<?= $rpe ?>">

	<header class="flex gap__05 align__start">
		<?php if($status): ?>
			<a open-dialog href="modal/dialog/select_rpe" class="button checkbox bg__invert color__dark"><icon class=""><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php else: ?>
			<a open-dialog href="modal/dialog/select_rpe" class="button checkbox border bg__invert/10"><icon class="op__0"><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php endif ?>
		<a open-dialog href="modal/dialog/select_weight" class="button border"><span><span data-select-output=weight><?= $weight ?></span> kg</span></a>
		<a open-dialog href="modal/dialog/select_reps" class="button border"><span><span data-select-output=reps><?= $reps ?></span> reps</span></a>
	</header>
	<nav class="button__group">
		<a open-dropdown href="modal/dropdown/set_options" class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></a>
	</nav>
</set>
