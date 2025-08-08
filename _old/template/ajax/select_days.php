<?php $POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);
	$selected = empty($POST['selected']) ? false : true;
	
}
?>
<div class="select --line bg-back c-dark modal__inner <?php echo $selected ? 'is-selected' : null ?>" data-select>
	<?php
		//var_dump($POST['selected'])
		for ($i=1; $i <= 31 ; $i++) { 
			$d = str_pad($i, 2, '0', STR_PAD_LEFT);
			?>
			<div class="option <?php echo $POST['selected'][0] == $d ? 'selected' : null  ?>" data-select-option=<?php echo $d ?>>
		
				<h1 class=""><?php echo $d ?></h2>
				<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
			</div>
		<?php }
	?>


</div>