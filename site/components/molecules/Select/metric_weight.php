<div class="flex align__center relative grow border__top border__bottom">
	<div class="select__widget --metric font__size__1 xll flex relative grow" data-select=number>
		<div class="select grid gap__05 grow" data-select-scroller>
			<div class="">&nbsp;</div>
			<?php
				//var_dump($POST['selected'])
				for ($i=0; $i <= 100 ; $i++) { ?>
					<div class="option flex justify__end" data-select-option data-value=<?php echo $i ?> data-label=<?php echo $i ?>>
						<div class=""><?php echo $i ?></div>
					</div>
				<?php }
			?>
			<div class="">&nbsp;</div>
		</div>
	</div>
	<div class="font__size__1 xll " >
		<div class="inner-x__05" >
			<div class="option flex justify__center">
				<div class="">.</div>
			</div>
		</div>
	</div>
	
	<div class="select__widget --metric font__size__1 xll flex relative grow" data-select=decimal>
		<div class="select grid gap__05 grow" data-select-scroller>
			<div class="">&nbsp;</div>
			<?php
				//var_dump($POST['selected'])
				for ($i=0; $i < 10 ; $i++) { ?>
					<div class="option flex justify__left" data-select-option data-value=<?php echo $i ?> data-label=<?php echo $i ?>>
						<div class=""><?php echo $i ?></div>
					</div>
				<?php }
			?>
			<div class="">&nbsp;</div>
		</div>
	</div>
</div>