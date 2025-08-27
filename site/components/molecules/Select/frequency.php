<div class="select__widget --half font__size__1 xxl flex justify__space-between align__center inner-x__1 relative bg__invert/5 border__top border__bottom" data-select=frequency>
	<div class="select grid grow inner-x__1" data-select-scroller>
		<div class="">&nbsp;</div>
		<?php
			//var_dump($POST['selected'])
			for ($i=7; $i > 0 ; $i--) { ?>
				<div class="option flex justify__start" data-select-option data-value=<?php echo $i ?> data-label=<?php echo $i ?>>
					<div class=""><?php echo $i ?></div>
				</div>
			<?php }
		?>
		<div class="">&nbsp;</div>
	</div>
	<a class="button bg__invert/20">days</a>
</div>