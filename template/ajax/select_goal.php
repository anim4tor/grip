<?php $POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);
	$selected = empty($POST['selected']) ? false : true;
	
}
?>
<div class="select --line bg-back c-dark modal__inner <?php echo $selected ? 'is-selected' : null ?>" data-select>
	<?php
		//var_dump($POST['selected'])
		for ($i=1; $i <= 60 ; $i++) { ?>
			<div class="option <?php echo $POST['selected'] == $i ? 'selected' : null  ?>" data-select-option=<?php echo $i ?>>
		
				<h1 class=""><?php echo $i ?></h2>
				<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
			</div>
		<?php }
	?>


</div>