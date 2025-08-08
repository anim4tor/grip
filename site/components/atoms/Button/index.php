<?php
	$template = $button->action()->toString();
	$url = $template == 'modal' ? $button->{$template}()->toPage()->slug() : $button->{$template}()->toUrl();
	$label = $button->label();
	$class = isset($render) ? $render : false;
?>
<?= snippet('atoms/Button/'.$template, compact('url','label','class')); ?>