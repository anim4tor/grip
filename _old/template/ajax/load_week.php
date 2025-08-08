<?php
session_start(); 
$relpath = '../../';
include_once($relpath . 'template/lib/_api.php');
global $_GLOBAL;

$POST = array();
if (isset($_POST)) {
	$POST = json_decode($_POST['data'], true);
}
var_dump($POST);

?>
<?php
if (isset($POST)) {

	
	$week = load_week(strtotime($POST['d']));

	foreach ($week as $day) { ?>
		<div data-pane>
		<?php

			$WORKOUTS = db_fetch_rows('workouts',"schedule = '{$day['date']}'");

			$WORKOUTS = load_day_workouts($day['date']);
			foreach ($WORKOUTS as $key => $W) {
				// include template
				include('template/layout/workout_item.php');
			} 
		?>
		</div>
	<?php } ?>
	
<?php } ?>
