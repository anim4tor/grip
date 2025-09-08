<?php
	$metric ??= null;
	$metric = $kirby->controller('get_metric', [ 'id' => $metric ]);
	extract($metric);
	$current ??= 0.0;
?>
<form action="form/log_metric" method="post" class="grid" modal-close page-reload>
	<input type="hidden" name="id" value="<?= $id ?>">
	<input type="hidden" name="number" data-select-bind=number value="<?= floor($current) ?>">
	<input type="hidden" name="decimal" data-select-bind=decimal value="<?= ceil(($current - floor($current))*10) ?>">
	<toolbar class="sticky inset__top-stretch inner-r__1 inner-t__2 inner-b__1 flex align__center justify__space-between gap__05 z__1 bg__inherit">
		<a modal-reveal close-modal class="button circle"><icon><?= svg('public/assets/images/ui/ui_arrow-down.svg') ?></icon></a>
		<nav class="button__group">
			<a modal-reveal modal-open="next" href="modal/metric/settings/metric=<?= $id ?>" class="button circle bg__invert/20"><icon><?= svg('public/assets/images/ui/ui_settings.svg') ?></icon></a>
		</nav>
	</toolbar>
	<header class="sticky inset__top-stretch ">
		<div class="inner-x__1 inner-b__1 flex align__center justify__space-between gap__05">
			<div class="flex gap__1 align__center">

				<div class="grid gap__05 align__center inner-t__04">
					<h1><?= $title ?></h1>
					<p class="font__size__md"><span class="op__5">Add a new log</span></p>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="grid inner__1 inner-t__2">
			<p class="font__size__lg"><?= $figure['name'] ?></p>
		</div>
		<div class="flex place__stretch-center align__center justify__space-between relative ">
			<?= snippet('molecules/Select/metric_weight',[ '' => '' ]); ?>
		</div>
	</section>
	<footer class="fixed inset__bottom-stretch z__1 bg__inherit relative">
		<div class="grid inner-y__2 inner-x__1 border__top shadow">
			<div class="flex justify__end gap__05">
				<button type="submit" modal-reveal data-tab-next class="button bg__invert color__dark">Log</button>
			</div>
		</div>
	</footer>
</form>
