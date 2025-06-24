<?php $POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);
}
?>
<div class="select bg-dark c-dark modal__inner" data-select>
	<!-- <p class="lead c-text-4">Delete item?</p> -->
	<div class="dialog c-light-4">
		<div class="option " data-select-option=0>
			<h1 class="">No</h2>
			<!-- <button class="checkbox"><span class="icon"><?php //echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button> -->
		</div>
		<div class="option " data-select-option=1>
			<h1 class="">Yes</h2>
			<!-- <button class="checkbox"><span class="icon"><?php //echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button> -->
		</div>
	</div>

</div>