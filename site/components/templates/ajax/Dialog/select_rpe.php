<div class="grid ">
	<div class="grid gap__1 inner-y__2 inner-x__1 border__bottom">
		<div class="flex justify__space-between">
			<div class="grid gap__05 inner-t__02">
				<h1 class="">RPE</h1>
				<p class="op__6">Rate of perceived exercion is an subjective estimation of how hard you had to work to complete the set. People use it to adjust based on daily form.</p>
				<p class="font__size__2 m inner-y__1">“I gave it my absolute all”</p>
			</div>
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_battery.svg') ?></icon></a>
		</div>
	</div>
	<div class="grid bg__dark/50">
		<?= snippet('molecules/Select/rpe'); ?>
	</div>
	<div class="grid gap__1 inner-y__2 inner-x__1 border__top">
		<div class="grid__2 gap__05">
			<?php if ($status) : ?>
				<div></div>
				<form action="form/update_status" method="post" class="grid" modal-close-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
					<input type="hidden" name="workout" value="<?= $workout ?>">
					<input type="hidden" name="exercise" value="<?= $exercise ?>">
					<input type="hidden" name="index" value="<?= $index ?>">
					<input type="hidden" name="status" value="0">
					<button type="submit" class="button justify__center bg__invert/20"><span>Unset</span></button>
				</form>
			<?php else: ?>
				<div></div>
				<form action="form/update_status" method="post" class="grid" modal-close-reload="modal/exercise/index/workout=<?= $workout ?>&exercise=<?= $exercise ?>">
					<input type="hidden" name="workout" value="<?= $workout ?>">
					<input type="hidden" name="exercise" value="<?= $exercise ?>">
					<input type="hidden" name="index" value="<?= $index ?>">
					<input type="hidden" name="status" value="1">
					<button type="submit" class="button justify__center bg__invert color__dark"><span>Finish</span></button>
				</form>
			<?php endif ?>
			
		</div>
	</div>
</div>

