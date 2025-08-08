<?php $POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);

	$selected = empty($POST['selected'][0]) ? false : true;
}
$MODS = array('N' => 'normal','D' => 'dropset','M' => 'myorep', 'C2' => 'cluster 2', 'C3' => 'cluster 3','S' => 'superset', 'W' => 'warmup', 'G' => 'giant');
?>
<div class="select bg-back c-dark modal__inner <?php echo $selected ? 'is-selected' : false ?>" data-select>
	<?php
	foreach ($MODS as $key => $mod) { ?>
		<div class="option <?php echo in_array($key, $POST['selected']) ? 'selected' : null  ?>" data-select-option=<?php echo $key ?>>
	
			<h1 class=""><small><?php echo $mod ?></small></h2>
			<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
		</div>
	<?php } ?>
</div>