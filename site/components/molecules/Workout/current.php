<?php
	$workout ? extract($workout) : null;
	$duration = gmdate("i:s", time() - $start);
	$test = ['status' => 1];
	$sets_scheduled = 0;
	$sets_completed = 0;
	$weight_lifted = 0;
	foreach ($sets ?? [] as $exercise) {
		$sets_completed += count(array_filter($exercise, function ($set) use ($test) {
	        return count(array_intersect_assoc($test, $set)) == count($test);
	    }));
	    $sets_scheduled += count($exercise);
	}
?>
<card class="grid span__2 inner__1 inner-y__1 bg__card relative border shadow__small modal__notification" style="--progress: 0.66">
	<div class="flex justify__space-between align__start inner-t__05">
		<a modal-open href="modal/workout/index/workout=<?= $id ?>" class="flex gap__1 align__center">	
			<div class="grid gap__03">
				<h2 class="l"><strong data-duration="<?= $start ?>"><?= $duration ?></strong></h2>
				<p class="flex align__center gap__04"><?= $title ?><span class="dot op__6"></span><span class="op__6"><?= $sets_completed ?> of <?= $sets_scheduled ?> sets</span></p>
			</div>
		</a>
		<button class="button circle bg__invert/20 color__invert"><icon><?= svg('public/assets/images/ui/ui_arrow-up.svg') ?></icon></button>
	</div>
</card>