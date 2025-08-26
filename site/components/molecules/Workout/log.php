<?php
	$workout ??= null;
	extract($workout);

	$test = ['status' => 1];
	$sets_completed = [];
	$weight_lifted = 0;
	foreach ($sets as $exercise) {
		$sets_completed = array_filter($exercise, function ($set) use ($test) {
	        return count(array_intersect_assoc($test, $set)) == count($test);
	    });
	    foreach ($sets_completed as $set) {
	    	$weight_lifted += $set['weight'];
	    }
	}
	
?>
<card class="grid bg__white/10 relative border" style="--progress: 0.3">
	<a modal-open href="modal/Workout/log/workout=<?= $id ?>" class="grid gap__2 inner__1 inner-y__2">	
		<div class="grid gap__1">
			<h2 class=""><?= $title ?></h2>
			<div class="flex justify__space-between align__center">
				<figure class="font__size__2">
					<span class="xl"><?= $duration ?></span>
					<span class="m op__5 light">min</span>
				</figure>
				<button class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_upload.svg') ?></icon></button>
			</div>
		</div>
		<div class="grid gap__05">
			<div class="flex justify__space-between align__center">
				<p class="op__5">Sets logged</p>
				<p><?= count($sets_completed) ?></p>
			</div>
			<div class="flex justify__space-between align__center">
				<p class="op__5">Weight lifted</p>
				<p><?= number_format($weight_lifted, 0, ',', '.') ?> kg</p>
			</div>
			<div class="flex justify__space-between align__center">
				<p class="op__5">Exercises done</p>
				<p><?= count($exercises) ?></p>
			</div>
		</div>
	</a>
</card>