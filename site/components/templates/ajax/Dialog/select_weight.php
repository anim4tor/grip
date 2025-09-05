<?php
	// $exercise = $kirby->controller('get_exercise', [ 'kirby' => $kirby, 'id' => $exercise, 'workout' => $workout ]);
?>
<div class="flex place__stretch-center align__center justify__space-between relative inner-x__1">
	<a class="button circle bg__invert/20 op__2"><icon><?= svg('public/assets/images/ui/ui_minus.svg') ?></icon></a>
	<!-- <a class="button bg__invert/20">+BW</a> -->
	<?= snippet('molecules/Select/weight'); ?>
	<!-- <a class="button bg__invert/20">+BW</a> -->
	<a class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></a>

</div>
<div class="grid gap__1 inner-y__2 inner-x__1 border__top">
	<form action="form/update_set" method="post" modal-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
		<input type="hidden" name="workout" value="<?= $workout ?>">
		<input type="hidden" name="exercise" value="<?= $exercise ?>">
		<input type="hidden" name="index" value="<?= $index ?>">
		<div class="flex justify__space-between gap__05">
			<?= snippet('atoms/Input/toggle', [ 'label' => 'Assisted', 'value' => true, 'id' => 'assisted', 'name' => 'assisted', 'checked' => boolval($assisted), 'submit' => 'update_set' ]) ?>
			<?= snippet('atoms/Input/toggle', [ 'label' => 'Add Bodyweight', 'value' => true , 'id' => 'bw', 'name' => 'bw', 'checked' => boolval($bw), 'submit' => 'update_set' ]) ?>	
		</div>
	</form>
</div>

	