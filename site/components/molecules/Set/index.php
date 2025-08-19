<?php 
	$_this = 'molecules/Set';
	$set = [
		'done' => isset($status) ? $status : false,
		'dropset' => isset($dropset) ? $dropset : false,
		'warmup' => isset($dropset) ? $dropset : false,
		// 'weight' => $weight ?: null,
		// 'reps' => $reps ?: null,
		// 'rpe' => $rpe ?: null
	]
?>

<set class="flex justify__space-between align__start relative" modal-reveal data-dialog-parent>
	<input type="hidden" name="set[id][]" value="">
	<input type="hidden" name="set[reps][]" data-select-bind=reps value="">
	<input type="hidden" name="set[weight][]" data-select-bind=weight value="">

	<header class="flex gap__05 align__start">
		<?php if($set['done']): ?>
			<a open-dialog href="modal/dialog/select_rpe" class="button checkbox bg__invert color__dark"><icon class=""><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php else: ?>
			<a open-dialog href="modal/dialog/select_rpe" class="button checkbox border bg__invert/10"><icon class="op__0"><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php endif ?>
		<a open-dialog href="modal/dialog/select_weight" class="button border"><span><span data-select-output=weight>0.0</span> kg</span></a>
		<a open-dialog href="modal/dialog/select_reps" class="button border"><span><span data-select-output=reps>0</span> reps</span></a>
	</header>
	<nav class="button__group">
		<a open-dropdown href="modal/dropdown/set_options" class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></a>
	</nav>
</set>
