<?php
	$page = isset($PAGE) ? $PAGE : 'home'; 
?>

<header class="" data-header>
	
	<nav class="nav c-light-5">
		<a href="index.php" class="nav__item button <?php echo $page == 'home' ? 'active' : null ?>"><span class="button__icon icon"><?php echo file_get_contents('dist/img/ui_home.svg') ?></span><div class="button__label">Home</div></a>
		<a href="week.php" class="nav__item button <?php echo $page == 'coach' ? 'active' : null ?>"><span class="button__icon icon"><?php echo file_get_contents('dist/img/ui_workout.svg') ?></span><div class="button__label">Workouts</div></a>
		<a href="stats.php" class="nav__item button <?php echo $page == 'stats' ? 'active' : null ?>"><span class="button__icon icon"><?php echo file_get_contents('dist/img/ui_diet.svg') ?></span><div class="button__label">Stats</div></a>
	</nav>

	<a href="template/forms/form_add_workout.php" class="button fab page__action bg-text c-light"><span class="icon"><?php echo file_get_contents('dist/img/ui_plus.svg') ?><!-- <img src="dist/img/ui_chevron-right.svg" alt=""> --></span></a>

</header>
