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

<set class="flex justify__space-between align__start relative" modal-reveal>
	<header class="flex gap__05 align__start">
		<?php if($set['done']): ?>
			<a class="button checkbox bg__invert color__dark"><icon class=""><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php else: ?>
			<a class="button checkbox border bg__invert/10"><icon class="op__0"><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></a>
		<?php endif ?>
		<a open-dialog href="dialog/exercise/1" class="button border">0.0 kg</a>
		<a open-dialog href="dialog/exercise/1" class="button border">0 reps</a>
	</header>
	<nav class="button__group">
		<a class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_options.svg') ?></icon></a>
	</nav>
</set>
