<?php
	$checked ??= false;
	$exercise ??= null;
	extract($exercise);
?>
<exercise class="grid relative" modal-reveal checkbox>
	<div class="flex justify__space-between align__start inner__1">
		<header class="flex gap__1 align__center">
			<div class="grid" data-checkbox>
				<label for="<?= $id ?>" class="grid">
					<input type="checkbox" id="<?= $id ?>" name="exercises[]" value="<?= $id ?>" <?= e($checked, 'checked') ?>/>
					<div class="exercise__figure grid__stack place__center-center" checkbox>
						<div class="button checkbox border bg__invert/10" ><icon class="op__0"><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></div>
					</div>
				</label>
			</div>
			<div class="grid gap__02 align__center">
				<h2 class="inner-r__8"><?= $name ?></h2>
			</div>
		</header>
	</div>
	<nav class="absolute inset__top-right button__group inner-t__1">
		<div class="button circle op__5"><icon><?= svg('public/assets/images/ui/ui_chevron-right.svg') ?></icon></div>
	</nav>
</exercise>

