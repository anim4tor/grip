<?php
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	$exercise ??= null;
	$exercise = $kirby->controller('get_exercise', [ 'kirby' => $kirby, 'id' => $exercise, 'workout' => $workout['id'] ]);
	$workout['mods'][$exercise['id']] ??= [];
	extract($exercise);
	
?>
<div class="grid ">
	<div class="grid gap__3 inner-y__3 inner-x__1">
		<div class="flex justify__space-between">
			<div class="grid gap__05 inner-t__02">
				<h1 class="">Exercise mods</h1>
				<p class="font__size__md"><span class="op__6">Select exercise</span> modifications</span></p>
			</div>
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		</div>
		<form action="form/update_mods" method="post" modal-reload="modal/exercise/index/workout=<?= $workout['id'] ?>&exercise=<?= $exercise['id'] ?>">
			<input type="hidden" name="workout" value="<?= $workout['id'] ?>">
			<input type="hidden" name="exercise" value="<?= $exercise['id'] ?>">
			<button-list class="flex align__start gap__1 wrap">
				<?php foreach (collection('Mods') as $mod) : ?>
					<?= snippet('atoms/Input/toggle', [ 'label' => ucfirst($mod['slug']), 'value' => $mod['slug'], 'id' => $mod['slug'], 'name' => 'mods['.$exercise['id'].'][]', 'checked' => in_array($mod['slug'], $workout['mods'][$exercise['id']]) ?? false, 'submit' => 'update_mods' ]) ?>	
				<?php endforeach ?>
			</button-list>
		</form>
	</div>
</div>
