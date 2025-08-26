<?php
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
?>
<div class="grid ">
	<div class="grid gap__3 inner-y__3 inner-x__1">
		<div class="flex justify__space-between">
			<div class="grid gap__05 inner-t__02">
				<h1 class="">Delete workout</h1>
				<p class="op__6 font__size__lg">Delete <?= $workout['title'] ?> from dahsboard?</p>
			</div>
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_delete.svg') ?></icon></a>
		</div>
		<div class="grid__2 gap__1">
			<a close-dialog class="button bg__invert/10 justify__center"><span>No</span></a>
			<form action="form/delete_workout" method="post" class="grid" reload="/log">
				<input type="hidden" name="id" value="<?= $workout['id'] ?>">
				<button type="submit" class="button bg__red color__invert justify__center"><span>Yes</span></button>
			</form>
		</div>
	</div>
</div>
