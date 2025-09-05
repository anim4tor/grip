<div class="select__widget --line font__size__1 xll flex align__center grow" data-select=weight data-form="update_exercise">
	<div class="select grid gap__1 grow" data-select-scroller>
		<div class="">&nbsp;</div>
		<!-- <?php for ($i=-30; $i <= 0 ; $i+=5) { ?>
			<div class="option flex justify__center" data-select-option data-value=<?= number_format($i,1) ?> data-label=<?= number_format($i,1) ?>>
				<div class=""><?= number_format($i,1) ?></div>
			</div>
		<?php } ?> -->
		<!-- <div class="option flex justify__end" data-select-option data-value=85.0 data-label=BW>
			<div class="">BW</div>
		</div> -->
		<?php for ($i=0.0; $i <= 100 ; $i+=0.5) { ?>
			<div class="option flex justify__center" data-select-option data-value=<?= number_format($i,1) ?> data-label=<?= number_format($i,1) ?>>
				<div class=""><?= number_format($i,1) ?></div>
			</div>
		<?php } ?>
		<div class="">&nbsp;</div>
	</div>
	<!-- <div class="grid gap__2">
		<div class="option flex justify__start">
			<div class="font__size__1 xl">.</div>
		</div>
	</div>
	<div class="select --line grid gap__2 grow">
		<div class="font__size__1 m">&nbsp;</div>
		<?php
			for ($decimal=0; $decimal < 10 ; $decimal++) { ?>
				<div class="option flex justify__start">
					<div class="font__size__1 xl"><?php echo $decimal ?></div>
				</div>
			<?php }
		?>
		<div class="font__size__1 m">&nbsp;</div>
	</div> -->
</div>