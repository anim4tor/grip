<div class="set bleed c-light" data-set="<?php echo $SET['id'] ?>">
	<div class="set__inner form__group --card grid grid__5 center">
		<input readonly type="hidden" name="set[id][]" class=" " value="<?php echo $SET['id'] ?>" placeholder="" data-select-output>
		
		<div class="form__input grid-start" data-select-widget>
			<div data-select-open="type" class="grid-start">
				<input readonly type="text" name="set[type][]" class="--<?php echo $SET['type'] ?>-set c-<?php echo $COLOR ?>" value="<?php echo $SET['type'] ?>" placeholder="N" data-select-output>
			</div>
		</div>
		<div class="form__input grid-center" data-select-widget>
			<div data-select-open="weight" class="grid-center">
				<input readonly type="text" name="set[weight][]" class=" " value="<?php echo $SET['weight'] != '0' ? number_format($SET['weight'],1) : 'BW' ?>" placeholder="-" data-select-output>
			</div>
		</div>
		<?php if ($SET['status'] == 1) { ?>
			<!-- <div class="grid form__input "> -->
				<div class="form__input grid-end" data-select-widget>
					<div data-select-open="reps" class="grid-end">
						<input readonly type="text" name="set[reps][]" class=" " value="<?php echo $SET['reps'] ?>" placeholder="-" data-select-output>
						<!-- <span>RIR</span> -->
					</div>
				</div>
				<div class="form__input --small c-light-2 grid-start" data-select-widget>
					<div data-select-open="rir" class="grid-start">
						<!-- <span class="rir">R</span> -->
						<input readonly type="text" name="set[RIR][]" class="label" value="<?php echo $SET['RIR'] ?>" placeholder="RIR" data-select-output>
						<!-- <span>RIR</span> -->
					</div>
				</div>
			<!-- </div> -->
		<?php } else { ?>
			<div class="form__input grid-end" data-select-widget>
				<div data-select-open="goal" class="grid-end c-light-2">
					<input readonly type="text" name="set[goal][]" class=" " value="<?php echo $SET['goal'] ?>" placeholder="-" data-select-output>
					<!-- <span>RIR</span> -->
				</div>
			</div>
			<div class="form__input --small c-light-2 grid-start" data-select-widget>
					<div data-select-open="rir" class="grid-start">
						<!-- <span class="rir">R</span> -->
						<input readonly type="text" name="set[RIR][]" class="label" value="<?php echo $SET['RIR'] ?>" placeholder="RIR" data-select-output>
						<!-- <span>RIR</span> -->
					</div>
				</div>
		<?php } ?>
		
		<!-- <a href="template/forms/form_delete_set.php?w=<?php echo $WORKOUT['id'] ?>&l=<?php echo $LIFT['id']?>&s=<?php echo $SET['id']?>" class="grid-end" data-select-widget data-dialog>
			<div class="" data-select-open="confirm">
				<input readonly type="hidden" class="" placeholder="Delete set" name=delete-set value="" data-select-output>
				<div class=" checkbox" ><span class="icon c-light-2"><?php echo file_get_contents('dist/img/ui_delete.svg') ?></span></div>
			</div>
			
		</a> -->
		<div class="form__input grid-end" data-select-widget data-menu>
			<div class="" data-select-open="set_options">
				<input readonly type="hidden" class="" placeholder="Set options" name="set-options" value="<?php echo $SET['id'] ?>" data-select-output>
				<?php if ($SET['status'] == 1) { ?>
					<div class=" checkbox" ><span class="icon checkbox c-<?php echo $COLOR ?> "><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></div>
				<?php } else { ?>
					<div class=" checkbox" ><span class="icon checkbox c-light-2"><?php echo file_get_contents('dist/img/ui_checkmark.svg') ?></span></div>
				<?php } ?>
			</div>
			
		</div>
	</div>

</div>