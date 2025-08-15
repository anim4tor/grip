<div class="select__widget --half font__size__1 xxl flex justify__space-between align__center inner-x__1 relative bg__invert/5 border__top border__bottom" data-select>
	<div class="select grid grow inner-x__1" >
		<div class="">&nbsp;</div>
		<?php
			//var_dump($POST['selected'])
			for ($i=1; $i <= 7 ; $i++) { ?>
				<div class="option flex justify__start" data-select-option=<?php echo $i ?>>
					<div class=""><?php echo $i ?></div>
				</div>
			<?php }
		?>
		<div class="">&nbsp;</div>
	</div>
	<a class="button bg__invert/20">days</a>
</div>