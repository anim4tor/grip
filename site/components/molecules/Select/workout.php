<?php
	$bodyparts = [
		'Push',
		'Pull',
		'Full body',
		'Upper body',
		'Legs',
		'Glutes',
		'Back',
		'Chest',
		'Shoulders',
		'Arms',
		'Biceps',
		'Triceps',
		'Forearms',
		'Quads',
		'Hamstrings',
		'Calves',
	]
?>
<div class="select__widget --line --workout font__size__1 xl  grid relative grow" data-select>
	<div class="select grid gap__1 grow" >
		<div class="inner-t__20">&nbsp;</div>
		<?php
			//var_dump($POST['selected'])
			foreach ($bodyparts as $bodypart) { ?>
				<div class="option flex justify__center" data-select-option=<?php echo $bodypart ?>>
					<h1 class=""><?php echo $bodypart ?></h1>
				</div>
			<?php }
		?>
		<div class="">&nbsp;</div>
	</div>
</div>