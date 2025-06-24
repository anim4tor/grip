<?php 

session_start();
$relpath = '../../';
include_once('../lib/_api.php');
// include_once('template/lib/_config.php');	
global $_GLOBAL;

if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);

	$POST['selected'] = is_array($POST['selected']) ? $POST['selected'] : array($POST['selected']);

	$selected = empty($POST['selected'][0]) ? false : true;
}

$BODY = db_fetch_table('bodypart', null, 'name ASC');
$EXERCS = db_fetch_table('exercises');
// $EXERCS = array();

foreach ($BODY as $id => $PART) {
	$EXERCS[$PART['slug']] = db_fetch_table('exercises',"bodypart = {$PART['id']}", 'name ASC');
	// $EXERCS[$PART['slug']] = array_filter($EXERCS, function($exrc) {
	// 	return ($exrc['bodypart'] == $PART['id']);
	// });
}


?>
<div data-select-group class="bg-back c-dark modal__inner <?php echo $selected ? 'open' : null ?>">
	<?php 
		//var_dump($EXERCS);
	// var_dump($POST['selected'][0]);

	?>
	<div class="select <?php echo $selected ? 'is-selected' : null ?>" data-select>
		<?php
		// var_dump($POST['selected']);
		foreach ($BODY as $b => $PART) { ?>
			<!-- <div class="select__group" data-select-group> -->
				<div class="option" data-select-sub="<?php echo $b ?>">
					<h1 class=""><small><?php echo $PART['name'] ?></small></h2>
					<button class=""><span class="icon"><?php echo file_get_contents('../../dist/img/ui_plus.svg') ?></span></button>
				</div>
			<!-- </div> -->
		<?php } ?>
		
	</div>

	<?php
		// var_dump($POST['selected']);
		foreach ($BODY as $b => $PART) { ?>
		<div class="select --sub <?php echo in_array($POST['selected'][0], array_column($EXERCS[$PART['slug']], 'id')) ? 'is-selected active' : null ?>" data-subselect="<?php echo $b ?>">
			<!-- <div class="option c-dark-5" data-select-back="">
				<h3 class="">Back</h3>
			</div> -->
			<?php foreach ($EXERCS[$PART['slug']] as $e => $E) { ?>
				<div class="option grid-center <?php echo in_array($E['id'], $POST['selected']) ? 'selected' : null  ?>" data-select-option="<?php echo $E['id'] ?>" data-select-label="<?php echo $E['name'] ?>">
			
					<h1 class=""><small><?php echo $E['name'] ?></small></h2>
					<button class="checkbox"><span class="icon"><?php echo file_get_contents('../../dist/img/ui_checkmark.svg') ?></span></button>
				</div>
			<?php } ?>
			<br><br>
			<div class="option c-dark-5" data-select-back="">
				<h3 class="">Back</h3>
			</div>
		</div>
	<?php } ?>
</div>s