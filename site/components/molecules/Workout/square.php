<?php
	$workout ? extract($workout) : null;
?>
<card class="grid bg__white/10 relative border" style="--progress: <?= $rest / $frequency ?>">
	<header class="absolute inset__top-stretch flex justify__end inner__05 op__4">
		<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
	</header>
	<a modal-open href="modal/workout/index/workout=<?= $id ?>" class="grid gap__2 place__end-start inner__1 inner-y__2">	
		<figure class="progress --large">
			<h3 class="font__size__1"><?= $rest ?></h3>
		</figure>
		<div class="grid gap__02">
			<h2><?= $title ?></h2>
			<p class="op__5"><?= $schedule ?></p>
		</div>
	</a>
</card>