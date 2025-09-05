<div class="grid gap__05 bg__dark/30" data-dropdown>
	<div class="grid inner-x__1 bg__invert/5">
		<form action="form/change_position" method="post" class="grid" page-reload>
			<input type="hidden" name="dashboard" value="<?= $dashboard ?>">
			<input type="hidden" name="id" value="<?= $workout ?>">
			<input type="hidden" name="key" value="<?= $key ?>">
			<input type="hidden" name="dir" value="up">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_before.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Move before</span>
			</button>
		</form>
		<form action="form/change_position" method="post" class="grid" page-reload>
			<input type="hidden" name="dashboard" value="<?= $dashboard ?>">
			<input type="hidden" name="id" value="<?= $workout ?>">
			<input type="hidden" name="key" value="<?= $key ?>">
			<input type="hidden" name="dir" value="down">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 ">
				<icon><?= svg('public/assets/images/ui/ui_after.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Move after</span>
			</button>
		</form>
	</div>
	<div class="grid inner-x__1 bg__invert/5">
		<form action="form/change_layout" method="post" class="grid <?= $layout == 'square' ? 'op__3' : null ?>" page-reload>
			<input type="hidden" name="dashboard" value="<?= $dashboard ?>">
			<input type="hidden" name="id" value="<?= $workout ?>">
			<input type="hidden" name="layout" value="square">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_copy.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Square layout</span>
			</button>
		</form>
		<form action="form/change_layout" method="post" class="grid <?= $layout == 'large' ? 'op__3' : null ?>" page-reload>
			<input type="hidden" name="dashboard" value="<?= $dashboard ?>">
			<input type="hidden" name="id" value="<?= $workout ?>">
			<input type="hidden" name="layout" value="large">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_copy.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Large layout</span>
			</button>
		</form>
		<form action="form/change_layout" method="post" class="grid <?= $layout == 'slim' ? 'op__3' : null ?>" page-reload>
			<input type="hidden" name="dashboard" value="<?= $dashboard ?>">
			<input type="hidden" name="id" value="<?= $workout ?>">
			<input type="hidden" name="layout" value="slim">
			<button type="submit" class="flex justify__start align__center gap__1 inner-y__1 inner-r__3 border__bottom">
				<icon><?= svg('public/assets/images/ui/ui_copy.svg') ?></icon>
				<span class="font__size__5 inner-y__02">Slim layout</span>
			</button>
		</form>
	</div>
</div>