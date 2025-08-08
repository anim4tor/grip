<?php
$_this = 'organisms/Header/';
if(!$page->isMobile()):
	snippet($_this.'desktop');
else:
	snippet($_this.'mobile');
	snippet('organisms/Aside');
endif;
?>