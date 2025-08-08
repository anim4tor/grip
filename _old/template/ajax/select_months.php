<?php $POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);
	$selected = empty($POST['selected']) ? false : true;
	
}
?>
<div class="select --line bg-back c-dark modal__inner <?php echo $selected ? 'is-selected' : null ?>" data-select>
	<?php
		//var_dump($POST['selected'])
		for ($i=1; $i <= 12 ; $i++) { 
			$m = str_pad($i, 2, '0', STR_PAD_LEFT);
			?>
			<div class="option <?php echo $POST['selected'][0] == $m ? 'selected' : null  ?>" data-select-option=<?php echo $m ?>>
		
				<h1 class=""><?php echo $m ?></h2>
				<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
			</div>
		<?php }
	?>


</div>