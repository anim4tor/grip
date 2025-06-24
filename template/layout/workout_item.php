<?php
	// var_dump($W);
	$LIFTS = db_fetch_rows('lifts',"workout = {$W['id']}");
	$parts = array();
	$sets = 0;
	$color = 'invert';
	switch ($W['title']) {
		case 'Push workout':
			// code...
			// $color = "chest";
			break;
		case 'Pull workout':
			// code...
			// $color = "back";
			break;
		case 'Leg workout':
			// code...
			// $color = "quad";
			break;
		
		default:
			// code...
			// $color = "red";
			break;
	}
	foreach ($LIFTS as $L) {
		$sets += count(json_decode($L['sets'], true));
		
	}

	$BODY = get_workout_bodypart($W['id']);
	reset($BODY);
	$color = key($BODY) ? key($BODY) : 'red';
	
	// $E = db_fetch_row('exercises',"id", $LIFTS[0]['exercise']);
	// $color = db_fetch_element('bodypart','slug',"id = {$E['bodypart']}");
?>
<?php if ($color == 'red') { ?>
		<a href="workout.php?w=<?php echo $W['id'] ?>" class="card bg-red c-text">
		<div class="card__header">
			<div class="card__meta">

				<h2><?php echo $W['title'] ?></h2>
				<!-- <p class="c-light-5"><?php echo count($LIFTS) ?> exercises, <?php echo $sets ?> sets </p> -->
			</div>
			<button class="card__action c-dark"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></button>
		</div>
		<div></div>
		<div></div>
		<div></div>
		<div></div>
		<div class="card__blocks blocks --grid-3 --dimm">
			<?php
				$blockCount = $sets / 5;
				for ($i=0; $i < $blockCount ; $i++) { 
					// code...
					echo '<div class="block completed"></div>';
				}
				// foreach ($LIFTS as $L) {
					// $E = db_fetch_row('exercises',"id", $L['exercise']);
					// $B = db_fetch_row('bodypart',"id", $E['bodypart']);

					
				// }
			?>
		</div>
	</a>
<?php } else { ?>
<a href="workout.php?w=<?php echo $W['id'] ?>" class="card bg-text c-light c-<?php echo $color ?> ">
	<div class="card__header">
		<div class="card__meta">
			<h2><?php echo $W['title'] ?></h2>
			<div class="tag_list">
				<?php 
				foreach (get_workout_bodypart($W['id']) as $bodypart) { ?>
					<div class="tag --fill bg-<?php echo $bodypart['slug'] ?>-2 c-light-5"><?php echo $bodypart['name'] ?></div>
				<?php } ?>
			</div>
		</div>
		<?php 
			// var_dump(strtotime($W['completed']));
			if ($W['status'] == 1) { ?>
				<button class="card__action c-<?php echo $color ?>"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></button>
			<?php } else { ?>
				<button class="card__action bg-light c-dark-4"><span class="icon"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></button>
			<?php } ?>
	</div>
	
	<div class="card__blocks blocks --grid-3 --dimm">
		<?php
			$blockCount = $sets / 5;
			for ($i=0; $i < $blockCount ; $i++) { 
				// code...
				echo '<div class="block completed"></div>';
			}
			// foreach ($LIFTS as $L) {
				// $E = db_fetch_row('exercises',"id", $L['exercise']);
				// $B = db_fetch_row('bodypart',"id", $E['bodypart']);

				
			// }
		?>
	</div>
</a>
<?php } ?>