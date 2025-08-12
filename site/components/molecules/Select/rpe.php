<div class="select__widget --half font__size__1 xxl grid relative " data-select>
	<div class="select grid grow inner-x__1" >
		<div class="">&nbsp;</div>
		<?php
			//var_dump($POST['selected'])
			for ($i=10; $i > 0 ; $i--) { ?>
				<div class="option flex" data-select-option=<?php echo $i ?>>
					<div class=""><?php echo $i ?></div>
				</div>
			<?php }
		?>
		<div class="">&nbsp;</div>
	</div>
</div>