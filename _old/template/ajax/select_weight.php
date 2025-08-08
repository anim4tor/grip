<?php $POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);
	$selected = empty($POST['selected']) ? false : true;
	$POST['selected'] = is_array($POST['selected']) ? $POST['selected'][0] : $POST['selected'];

}
?>
<div class="select bg-back c-dark modal__inner <?php echo $selected ? 'is-selected' : null ?>" data-select>
	<?php
		// var_dump($POST['selected']);
	?>
	<?php
		// var_dump($selected);
		for ($i=-20; $i <= 0 ; $i+=5) { ?>
			<div class="option <?php echo $POST['selected'] == number_format($i,1) ? 'selected' : null  ?>" data-select-option=<?php echo number_format($i,1) ?>>
		
				<h1 class=""><?php echo number_format($i,1) ?></h2>
				<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
			</div>
		<?php }
	?>
	<div class="option <?php echo $POST['selected'] == "BW" ? 'selected' : null  ?>" data-select-option="BW" ?>

		<h1 class="">BW</h2>
		<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
	</div>
	<?php
		// var_dump($selected);
		for ($i=2.0; $i <= 100 ; $i+=0.5) { ?>
			<div class="option <?php echo $POST['selected'] == number_format($i,1) ? 'selected' : null  ?>" data-select-option=<?php echo number_format($i,1) ?>>
		
				<h1 class=""><?php echo number_format($i,1) ?></h2>
				<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
			</div>
		<?php }
	?>

	
</div>