<?php
	$name ??= null;
	$id ??= null;
	$label ??= null;
	$value ??= $label;
	$checked ??= false;
?>
<div class="field superset wrap-l__1 inner-l__07 inner-y__03" data-checkbox>
	<label for="<?= $id ?>">
		<input type="checkbox" id="<?= $id ?>" name="<?= $name ?>" value="<?= $value ?>" <?= e($checked, 'checked') ?>/>
		<div superset class="op__3">
			<icon><?= svg('public/assets/images/ui/ui_superset.svg') ?></icon>
		</div>
	</label>
</div>
