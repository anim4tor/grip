<?php $POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);
}
?>
<div class="select --dialog bg-dark c-light-2 modal__inner" data-select>
	<?php

		// var_dump($POST['selected']);

	?>
	<!-- <p class="lead c-text-4">Delete item?</p> -->
	<div class="dialog ">
		<a href="template/forms/form_delete_set.php?s=<?php echo $POST['selected']?>" class="option " data-select-option=<?php echo $POST['selected']?>>
			<button class=""><span class="icon c-light-5"><?php echo file_get_contents('../../dist/img/ui_delete.svg') ?></span></button>
		</a>
		<a href="template/forms/form_duplicate_set.php?s=<?php echo $POST['selected']?>" class="option " data-select-option=1>
			<button class=""><span class="icon c-light-5"><?php echo file_get_contents('../../dist/img/ui_duplicate.svg') ?></span></button>
		</a>
		<a href="template/forms/form_complete_set.php?s=<?php echo $POST['selected']?> " class="option" data-select-option=2>
			<button class=""><span class="icon c-light-5"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
		</a>
	</div>

</div>