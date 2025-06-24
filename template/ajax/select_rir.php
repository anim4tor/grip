<?php 
$relpath = '../../';
include_once('../lib/_api.php');
$POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);

	$selected = sizeof($POST['selected']) > 0 ? true : false;
}
$RIR = array('F','1','2','3+');
?>
<div class="select bg-back c-dark modal__inner <?php echo $selected ? 'is-selected' : false ?>" data-select>
	<?php
	foreach ($RIR as $key => $rir) { ?>
		<div class="option <?php echo $POST['selected'][0] == $rir ? 'selected' : null  ?>" data-select-option=<?php echo $rir ?>>
	
			<h1 class=""><small><?php echo $rir ?></small></h2>
			<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
		</div>
	<?php } ?>
</div>