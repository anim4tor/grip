<?php
	$workout ? extract($workout) : null;
?>
<card class="grid span__2 inner__1 inner-y__1 bg__card relative border" style="--progress: 0.66">
	<div class="flex justify__space-between align__center">
		<a modal-open href="modal/workout/index/workout=<?= $id ?>" class="flex gap__1 align__center">	
			<figure class="progress">
				<h3 class="font__size__2">2</h3>
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
		<div class="op__4">
			<a open-dropdown href="modal/dropdown/workout_options/workout=<?= $id ?>&key=<?= $key ?>&layout=<?= $layout ?>&dashboard=workout" class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		</div>
	</div>
</card>