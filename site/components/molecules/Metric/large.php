<?php

	$metric ? extract($metric) : null;

?>
<card class="grid span__2 bg__white/10 relative border" >
	<header class="absolute inset__top-stretch flex justify__end inner__05 op__4">
		<a open-dropdown href="modal/dropdown/workout_options/workout=<?= $id ?>&key=<?= $key ?>&layout=<?= $layout ?>&dashboard=metric" class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
	</header>
	<a modal-open href="modal/metric/log/metric=<?= $id ?>" class="grid gap__2 place__end-start inner__1 inner-y__2">	
		<figure class="font__size__1">
			<span class="xl"><?= (float) $current ?></span>
			<span class="s op__5 light"><?= $figure['affix'] ?></span>
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