<?php
	$name = $name ?? null;
	$id = $id ?? null;
	$label = $label ?? null;
	$value = $value ?? $label;
	$checked = $checked ?? false;
?>
<div class="field" data-checkbox>
	<label for="<?= $id ?>">
		<input type="checkbox" id="<?= $id ?>" name="<?= $name ?>" value="<?= $value ?>" <?= e($checked, 'checked') ?>/>
		<div class="button bg__invert/10" ><span><?= $label ?></span></div>
	</label>
</div>