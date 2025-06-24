<?php 
$relpath = '../../';
include_once('../lib/_api.php');

$POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);

	// get set data
	$S = db_fetch_row('sets','id', $POST['selected']);
}
?>
<div class="select --dialog bg-dark c-dark modal__inner" data-select>
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

		<?php
			if ($S['status'] == 1) { ?>
				<a href="template/forms/form_uncomplete_set.php?s=<?php echo $POST['selected']?> " class="option" data-select-option=<?php echo $POST['selected']?>>
					<button class=""><span class="icon c-light-5"><?php echo file_get_contents('../../dist/img/ui_uncheck.svg') ?></span></button>
				</a>
			<?php } else { ?>
				<a href="template/forms/form_complete_set.php?s=<?php echo $POST['selected']?>" class="option" data-select-widget data-redirect>
					<div class="" data-select-open="reps" data-select-post="<?php echo $POST['selected']?>">
						<div class="" data-select-option=<?php echo $S['id'] ?> data-select-output value="<?php echo $S['goal'] ?>">
							<button class=""><span class="icon c-light-5"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
						</div>
					</div>
				</a>


			<?php }
		?>
	</div>

</div>