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
				<p class="op__5"><?= implode(', ',$weekdays) ?></p>
			</div>
		</a>
		<div class="op__4">
			<a class="button circle"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		</div>
	</div>
</card>