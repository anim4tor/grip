<?php
	$name = $name ?? null;
	$id = $id ?? null;
	$placeholder = $placeholder ?? null;
	$value = $value ?? null;
?>
<div class="field">
	<input type="text" id="<?= $id ?>" name="<?= $name ?>" placeholder="<?= $placeholder ?>" value="<?= $value ?>">
</div>