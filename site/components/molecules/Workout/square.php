<?php
	$workout ? extract($workout) : null;
?>
<card class="grid bg__white/10 relative border" style="--progress: <?= $rest / $frequency ?>">
	<header class="absolute inset__top-stretch flex justify__end inner__05 op__4">
		<a open-dropdown href="modal/dropdown/workout_options/workout=<?= $id ?>&key=<?= $key ?>&layout=<?= $layout ?>&dashboard=workout" class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
	</header>
	<a modal-open href="modal/workout/index/workout=<?= $id ?>" class="grid gap__2 place__end-start inner__1 inner-y__2">	
		<figure class="progress --large <?= $rest > 0 ? $rest : 'button bg__invert color__dark' ?>">
			<h3 class="font__size__1"><?= $rest > 0 ? $rest : '+' ?></h3>
		</figure>
		<div class="grid gap__02">
			<h2><?= $title ?></h2>
			<?php if ($ago) : ?>
				<p class="op__5"><?= $ago ?></p>
			<?php else: ?>
				<p class="op__5">Every <?= $frequency != 7 && empty($weekdays) ? $frequency . ' days' : implode(', ',$weekdays) ?></p>
			<?php endif ?>
		</div>
	</a>
</card>