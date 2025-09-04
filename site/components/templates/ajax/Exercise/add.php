<?php
	$library = collection('Exercises');
	$workout ??= null;
	$workout = $kirby->controller('get_workout', [ 'id' => $workout ]);
	extract($workout);
	$exercises ??= [];
?>
<form action="form/add_exercise" method="post" modal-back="modal/workout/index/workout=<?= $id ?>">
	<input type="hidden" name="id" value="">
	<?php foreach ($workout['bodyparts'] as $b) : ?>
		<input type="hidden" name="bodyparts[]" value="<?= $b ?>">
	<?php endforeach ?>
	<input type="hidden" name="mods[]" value="">
	<input type="hidden" name="bw_factor" value="1">
	<input type="hidden" name="img" value="">
	<tabs data-tabs class="grid modal__content rows__auto-1 " style="--progress: 0">
		<toolbar class="inset__top-stretch h__6 inner-t__2 inner-b__1 flex align__center justify__space-between gap__2 z__2 bg__inherit">
			<a modal-reveal modal-open="prev" href="modal/library/index/workout=<?= $workout['id'] ?>" class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-left.svg') ?></icon></a>
			<div class="tabs__progress bg__white/10 h__04 grow radius" >
				<div class="progress__bar bg__invert radius h__04" data-tabs-progress></div>
				<span data-tab ></span>
				<span data-tab ></span>
			</div>
			<a modal-reveal close-modal class="button circle op__0"></a>
		</toolbar>
		<div data-pane-container class="relative inset__stretch">
			<pane data-pane theme class="absolute inset__stretch grid rows__1-auto">
				<div class="grid align__start">
					<header class="">
						<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05">
							<div class="flex gap__1 align__center">
								<div class="grid gap__05 align__center inner-t__04">
									<h1>Create exercise</h1>
									<p class="font__size__lg"><span class="op__6">Add a custom exercise to</span> <span><?= $workout['title'] ?></span></p>
								</div>
							</div>
						</div>
					</header>
					<div class="grid">
						<div class="inner__1">
							<?= snippet('atoms/Input/text', [ 'placeholder' => 'Name ...', 'value' => '', 'name' => 'name', 'update' => 'name' ]) ?>
						</div>
					</div>
				</div>
				<footer class="inset__bottom-stretch z__1 bg__inherit relative">
					<div class="grid inner-y__2 inner-x__1 border__top shadow">
						<div class="flex justify__end gap__05">
							<a modal-reveal modal-open="prev" href="modal/library/index/workout=<?= $workout['id'] ?>" class="button circle border"><icon><?= svg('public/assets/images/ui/ui_arrow-left.svg') ?></icon></a>
							<a modal-reveal data-tab-next class="button bg__invert color__dark">Continue <icon><?= svg('public/assets/images/ui/ui_arrow-right.svg') ?></icon></a>
						</div>
					</div>
				</footer>
			</pane>
			
			<pane data-pane theme class="absolute inset__stretch grid rows__1-auto">
				<div class="grid align__start">
					<header class="">
						<div class="inner-x__1 inner-b__2 flex align__center justify__space-between gap__05">
							<div class="flex gap__1 align__center">
								<div class="grid gap__05 align__center inner-t__04">
									<h1><span data-bind="name">Tracking</span></h1>
									<p class="font__size__lg"><span class="op__6">How to track it</p>
								</div>
							</div>
						</div>
					</header>
					<list class="grid inner-y__1">
						<?= snippet('molecules/Exercise/tracking', [ 'id' => 'sets', 'name' => 'Sets', 'desc' => 'Classic strenght training with sets of reps', 'icon' => 'workout', 'checked' => false ]) ?>
						<?= snippet('molecules/Exercise/tracking', [ 'id' => 'duration', 'name' => 'Duration', 'desc' => 'Perform for a duration, like 5 min treadmill', 'icon' => 'timer', 'checked' => false ]) ?>
						<?= snippet('molecules/Exercise/tracking', [ 'id' => 'intervals', 'name' => 'Intervals', 'desc' => 'Perform for a duration for a number of intervals', 'icon' => 'intervals', 'checked' => false ]) ?>
						<?= snippet('molecules/Exercise/tracking', [ 'id' => 'distance', 'name' => 'Distance', 'desc' => 'Perform for a distance, like running', 'icon' => 'metric', 'checked' => false ]) ?>
						<?= snippet('molecules/Exercise/tracking', [ 'id' => 'calories', 'name' => 'Calories', 'desc' => 'Perform for a number of calories', 'icon' => 'power', 'checked' => false ]) ?>
						<?= snippet('molecules/Exercise/tracking', [ 'id' => 'checkoff', 'name' => 'Check off', 'desc' => 'Check-off without tracking details', 'icon' => 'checkmark', 'checked' => false ]) ?>
					</list>
				</div>
				<footer class="inset__bottom-stretch z__1 bg__inherit relative">
					<div class="grid inner-y__2 inner-x__1 border__top shadow">
						<div class="flex justify__end gap__05">
							<a modal-reveal data-tab-prev class="button circle border"><icon><?= svg('public/assets/images/ui/ui_arrow-left.svg') ?></icon></a>
							<button modal-reveal type=submit class="button bg__invert color__dark">Create <icon><?= svg('public/assets/images/ui/ui_arrow-right.svg') ?></icon></button>
						</div>
					</div>
				</footer>
			</pane>

		</div>
	</tabs>
</form>
	<!-- <footer class="sticky inset__bottom-stretch z__1 bg__inherit relative">
		<div class="grid inner-y__2 inner-x__1 border__top shadow">
			<div class="grid gap__05 inner-t__02">
				<p class="font__size__5 "><span class="op__6">Add</span> <span>Full body </span><span class="op__6">to your workouts</span></p>
				<p class="op__5">Exercises for all major muscles</p>
			</div>
		</div>
	</footer> -->