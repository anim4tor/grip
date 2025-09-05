<div class="select__widget --line font__size__1 xll grid relative grow" data-select=reps data-form="update_exercise">
	<div class="select grid gap__1 grow" data-select-scroller>
		<div class="">&nbsp;</div>
		<?php
			//var_dump($POST['selected'])
			for ($i=0; $i <= 60 ; $i++) { ?>
				<div class="option flex justify__center" data-select-option data-value=<?php echo $i ?> data-label=<?php echo $i ?>>
					<div class=""><?php echo $i ?></div>
				</div>
			<?php }
		?>
		<div class="">&nbsp;</div>
	</div>
</div>