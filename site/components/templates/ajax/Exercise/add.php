<?php
	$library = collection('Exercises');
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	extract($workout);
	$exercises ??= [];
?>
<form action="form/add_exercise" method="post" modal-back="modal/workout/index/workout=<?= $id ?>">
	<input type="hidden" name="workout" value="<?= $id ?>">
	<toolbar class="sticky inset__top-stretch inner-t__2 inner-b__1 inner-r__1 flex align__center justify__space-between gap__2 z__2 bg__inherit">
		<a modal-reveal modal-open="prev" href="modal/workout/index/workout=<?= $id ?>" class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-left.svg') ?></icon></a>
		<nav class="button__group">
			<a modal-reveal class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_add.svg') ?></icon></a>
			<button type="submit" modal-reveal class="button bg__invert color__dark">Done</button>
		</nav>
	</toolbar>
	<header class="">
		<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05">
			<div class="flex gap__1 align__center">

				<div class="grid gap__05 align__center inner-t__04">
					<h1>Library</h1>
					<p class="font__size__lg"><span class="op__6"><?= count($library) ?> exercises related to</span> Upper body</p>
				</div>
			</div>

		</div>
	</header>
	<section>
		<list class="grid inner-y__1">
			<?php foreach ($library as $key => $exercise) : ?>
				<?php $checked = in_array($key, $exercises) ? true : false ?> 
				<?= snippet('molecules/Exercise/input', compact('exercise','checked')) ?>
			<?php endforeach ?>
		</list>
	</section>
</form>
	<!-- <footer class="sticky inset__bottom-stretch z__1 bg__inherit relative">
		<div class="grid inner-y__2 inner-x__1 border__top shadow">
			<div class="grid gap__05 inner-t__02">
				<p class="font__size__5 "><span class="op__6">Add</span> <span>Full body </span><span class="op__6">to your workouts</span></p>
				<p class="op__5">Exercises for all major muscles</p>
			</div>
		</div>
	</footer> -->