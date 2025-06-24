<a href="exercise.php?e=<?php echo $L['id'] ?>&w=<?php echo $WORKOUT['id'] ?>" class="form__group --card bleed c-invert-2" style="--c-bodypart: <?php echo $B['color'] ?>">
	<div class="card__header flex-start c-light flex-start">
		<div class="card__meta">
			<input type="hidden" name="lifts[]" value="<?php echo $L['id'] ?>">
			<h2><?php echo $E['name'] ?></h2>
			<div class="tag__list c-light-4">
				
				<?php  
					foreach (json_decode($L['mods'], true) as $mod) {
						echo "<div class='tag '>{$mod}</div>";
					}
				?>
			</div>
			<!-- <div class="c-light-2"><?php echo calc_lift_score($L['id']) ?></div> -->
		</div>
		<div class="grid-end" data-select-widget data-menu>
			<div class="card__action" data-select-open="lift_options">
				<input readonly type="hidden" class="" placeholder="Lift options" name value="<?php echo $L['id'] ?>" data-select-output>
				<?php if ($L['completed'] == 1) { ?>
					<div class=" checkbox" ><span class="icon c-back"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></div>
				<?php } else { ?>
					<div class=" checkbox" ><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_options.svg') ?></span></div>
				<?php } ?>
			</div>
			
		</div>
		<!-- <div class="card__action"><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_chevron-right.svg') ?></span></div> -->
	</div>
	<?php
		// $sets = json_decode($L['sets'],true);
		// $SETS = array();
		// $max = 0;
		// $second = 0;
		// $third = 0;
		// foreach ($sets as $key => $set) {
		// 	$SETS[$key] = db_fetch_row('sets',"id", $set);
		// 	if ($SETS[$key]['type'] != 'W') {
		// 		// code...
		// 		$score = get_set_score($set);
		// 		$SETS[$key]['score'] = $score;
		// 		$max = $max < $score ? $score : $max;
		// 	} else {
		// 		unset($SETS[$key]);
		// 	}
		// }

		// // sort by score and get indexes
		// $sorted = $SETS;
		// array_multisort(array_column($sorted, 'score'), SORT_NUMERIC, SORT_DESC, $sorted);
		
	?>
	<div class="card__end">
		<?php 
			foreach (get_lift_bodypart($L['id']) as $bodypart) { ?>
				<div class="tag --fill c-<?php echo $bodypart['slug'] ?> bg-<?php echo $bodypart['slug'] ?>-2"><?php echo $bodypart['name'] ?></div>
		<?php } ?>
	</div>
	<!-- <div class="card__blocks blocks grid c-<?php echo $B['slug'] ?>">
		<?php
			

			// var_dump($SETS);
			foreach ($SETS as $S) {
				if ($S['status'] == 1 && $S['type'] != "W") { ?>
					<div class="block --scored <?php echo array_search($S['id'],array_column($sorted,'id')) == 0 ? '--first' : '' ?> <?php echo array_search($S['id'],array_column($sorted,'id')) == 1 ? '--second' : '' ?> <?php echo array_search($S['id'],array_column($sorted,'id')) == 2 ? '--third' : '' ?> completed" style="--size: <?php echo $S['score']/$max ?>"></div>
				<?php } else {
					// echo '<div class="block --scored " style="--size: '. $S['score']/$max .'"></div>';
				}
			}
		?>
		
	</div> -->
</a>