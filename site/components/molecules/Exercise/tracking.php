<exercise class="grid relative" modal-reveal >
	<div class="flex justify__space-between align__start inner__1" >
		<header class="flex gap__1 align__center">
			<div class="grid" data-checkbox>
				<label for="<?= $id ?>" class="grid">
					<input type="radio" id="<?= $id ?>" name="tracking" value="<?= $id ?>" <?= e($checked, 'checked') ?>/>
					<div class="exercise__figure grid__stack place__center-center" checkbox>
						<div class="button checkbox radio border bg__invert/10" ><div class="grid__stack"><icon class=""><?= svg('public/assets/images/ui/ui_'.$icon.'.svg') ?></icon><icon class="op__0"><?= svg('public/assets/images/ui/ui_checkmark.svg') ?></icon></div></div>
					</div>
				</label>
			</div>
			<div class="grid align__center">
				<h2 class="font__size__lg inner-t__02"><?= $name ?></h2>
				<p class="font__size__md"><span class="op__6"><?= $desc ?></span></p>
			</div>
		</header>
	</div>
	
</exercise>