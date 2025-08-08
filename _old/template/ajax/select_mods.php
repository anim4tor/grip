<?php 
$relpath = '../../';
include_once('../lib/_api.php');
$POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);

	$selected = sizeof($POST['selected']) > 0 ? true : false;
}
$MODS = array('assisted','weighted','unilateral','diagonal','crossover','high','low','inclined','declined','deficit','cable','rings','barbell','dumbell');
$MODS = db_fetch_table('mods');
?>
<div class="select bg-back c-dark modal__inner <?php echo $selected ? 'is-selected' : false ?>" data-select>
	<?php
	foreach ($MODS as $key => $mod) { ?>
		<div class="option <?php echo in_array($mod['slug'], $POST['selected']) ? 'selected' : null  ?>" data-select-option=<?php echo $mod['slug'] ?>>
	
			<h1 class=""><small><?php echo $mod['slug'] ?></small></h2>
			<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
		</div>
	<?php } ?>
</div>