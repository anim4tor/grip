<?php

	$metric ? extract($metric) : null;

?>
<card class="grid span__2 bg__card relative border" style="--progress: 0.66">
	<a modal-open href="modal/metric/log/metric=<?= $id ?>" class="flex justify__space-between align__center inner__1 inner-y__1 ">
		<div class="flex gap__1 align__center">	
			<figure class="font__size__2">
				<span class="xl"><?= (float) $current ?></span>
				<span class="m op__5 light"><?= $figure['affix'] ?></span>
			</figure>
			<div class="grid gap__02 inner-t__01">
				<h2><?= $title ?></h2>
				<?php if ($ago) : ?>
					<p class="op__5"><?= $ago ?></p>
				<?php else: ?>
					<p class="op__5">Every <?= $frequency != 7 && empty($weekdays) ? $frequency . ' days' : implode(', ',$weekdays) ?></p>
				<?php endif ?>
			</div>
		</div>
	</a>
	<div class="absolute inset__stretch-right op__4 inner-t__08 inner-x__05">
		<a open-dropdown href="modal/dropdown/workout_options/workout=<?= $id ?>&key=<?= $key ?>&layout=<?= $layout ?>&dashboard=metric" class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
	</div>
</card>