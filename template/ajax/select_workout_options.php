<?php 
$relpath = '../../';
include_once('../lib/_api.php');
$POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);

	$W = db_fetch_row('workouts','id', $POST['selected']);
}
?>
<div class="select --dialog bg-dark c-dark modal__inner" data-select>
	<?php

		// var_dump($POST['selected']);

	?>
	<!-- <p class="lead c-text-4">Delete item?</p> -->
	<div class="dialog ">
		<a href="template/forms/form_delete_workout.php?w=<?php echo $POST['selected']?>" class="option " data-select-option=<?php echo $POST['selected']?>>
			<button class=""><span class="icon c-light-5"><?php echo file_get_contents('../../dist/img/ui_delete.svg') ?></span></button>
		</a>
		<a href="template/forms/form_duplicate_workout.php?w=<?php echo $POST['selected']?>" class="option " data-select-option=<?php echo $POST['selected']?>>
			<button class=""><span class="icon c-light-5"><?php echo file_get_contents('../../dist/img/ui_copy.svg') ?></span></button>
		</a>
		<?php
			if ($W['status'] == 1) { ?>
				<a href="template/forms/form_uncomplete_workout.php?w=<?php echo $POST['selected'] ?>" class="option"><span class="icon c-light-5"><?php echo file_get_contents($relpath.'dist/img/ui_uncheck.svg') ?></span></a>
			<?php } else { ?>
				<a href="template/forms/form_complete_workout.php?w=<?php echo $POST['selected'] ?>" class="option"><span class="icon c-light-5"><?php echo file_get_contents($relpath.'dist/img/ui_checkmark.svg') ?></span></a>
			<?php }
		?>
	</div>

</div>