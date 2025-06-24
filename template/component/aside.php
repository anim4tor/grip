<aside class="menu bgc-red c-black" data-aside>
	<section class="menu__inner ">
		<nav class="menu__nav row s__inner --pad --small">
			<a href="<?php echo $root?>studio" class="menu__nav__item" <?php echo $PAGE=='about' ? 'data-active' : '' ?> data-aside-nav>
				<h2 class="--small"><span>Program</span></h2>
			</a>
			<a href="<?php echo $root?>portfolio" class="menu__nav__item" <?php echo $PAGE=='folio' ? 'data-active' : '' ?> data-aside-nav>
				<h2 class="--small"><span>Repertoár</span></h2>
			</a>
			<a href="<?php echo $root?>projekty" class="menu__nav__item" <?php echo $PAGE=='works' ? 'data-active' : '' ?> data-aside-nav>
				<h2 class="--small"><span>Ansámbl</span></h2>
			</a>
			<a href="<?php echo $root?>kontakt" class="menu__nav__item" <?php echo $PAGE=='contact' ? 'data-active' : '' ?> data-aside-nav>
				<h2 class="--small"><span>Vstupenky</span></h2>
			</a>
			<a href="<?php echo $root?>studio" class="menu__nav__item" <?php echo $PAGE=='about' ? 'data-active' : '' ?> data-aside-nav>
				<h2 class="--small"><span>Zákulisník</span></h2>
			</a>
			<a href="<?php echo $root?>studio" class="menu__nav__item" <?php echo $PAGE=='about' ? 'data-active' : '' ?> data-aside-nav>
				<h2 class="--small"><span>Divadlo</span></h2>
			</a>
			<a href="<?php echo $root?>studio" class="menu__nav__item" <?php echo $PAGE=='about' ? 'data-active' : '' ?> data-aside-nav>
				<h2 class="--small"><span>Kontakt</span></h2>
			</a>
			<div class="menu__nav__item row">
				<br><br>	
				<div class="row">
					<div class="col-md-4">
						<p data-aside-text class="--small"><a href="mailto:artme@post.cz">vstupenky@divadloungelt.cz</a></p>
						<p data-aside-text class="--small"><a href="">(+420) 224 828 082</a></p>
					</div>
					<div class="col-md-4">
						<p data-aside-text class="--small"><strong>Kamenná scéna</strong></p>
						<p data-aside-text class="--small"><a href="">Malá Štupartská 1</a></p>
						<p data-aside-text class="--small"><a href="">110 00 Praha 1 - Staré Město</a></p>
					</div>
					<div class="col-md-4">
						<p data-aside-text class="--small"><strong>Letní scéna</strong></p>
						<p data-aside-text class="--small"><a href="">Nový Svět</a></p>
						<p data-aside-text class="--small"><a href="">118 00 Praha 1 - Hradčany</a></p>
					</div>
				</div>
			</div>
		</nav>
	</section>
	<div class="menu__close"  data-menu-close></div>
</aside>

<div class="news bgc-invert c-red" data-news>
	<section class="news__inner " data-inner-scroll>
		<div class="card" data-aside-left>
			<div class="card__inner">
				<div class="card__head">
					<!-- <h2>N</h2> -->
					<span class="label">Novinka</span>
				</div>
				<div class="card__body">
					<div class="card__hover c-red"><div class="icon  --arrow-top-right"><?php echo file_get_contents('dist/img/ui_link.svg') ?></div></div>
					<!-- <figure class="card__figure"><img src="dist/img/new_01.jpg" alt=""></figure> -->
					<h4 class="card__title">Překladatel Pavel Dominik dnes slaví narozeniny</h4>
					<div class="card__excerpt">
						<p class="">Dnes přejeme vše nejlepší k narozeninám našemu vzácnému panu překladateli Pavlovi Dominikovi. Posíláme mu tímto virtuální dort, který má 13 pater! Jedno patro za každý z jeho vynikajících 13 překladů, které pro nás dosud vytvořil. V současné chvíli jich máme na repertoáru neuvěřitelných 9.</p>
					</div>
					<div class="btn__group">
						<a href="" class="btn "><span class="btn__label">Více</span></a>
					</div>
				</div>
			</div>
		</div>
		<div class="card" data-aside-left>
			<div class="card__inner">
				<div class="card__head">
					<!-- <h2>N</h2> -->
					<span class="label">Novinka</span>
				</div>
				<!-- <figure class="card__figure"><img src="dist/img/artist_kubarova.jpg" alt=""></figure> -->
				<div class="card__body">
					<div class="card__hover c-red"><div class="icon  --arrow-top-right"><?php echo file_get_contents('dist/img/ui_link.svg') ?></div></div>
					<div class="card__title">
						<h4 class="">S Divadlem Ungelt se mohou seznámit i nevidomí</h4>
					</div>
					<div class="card__excerpt">
						<p class="">S velkou radostí jsme se dozvěděli, že kniha Moje čtvrtstoletí s Divadlem Ungelt našeho principála Milana Heina se dostala do Knihovny digitálních dokumentů (KDD).</p>
					</div>
					<div class="btn__group">
						<a href="" class="btn "><span class="btn__label">Více</span></a>
					</div>
				</div>
			</div>
		</div>
		<div class="card" data-aside-left>
			<div class="card__inner">

				<div class="card__head">
					<!-- <h2>P</h2> -->
					<span class="label">Program</span>
				</div>
				<div class="card__body">
					<div class="card__hover c-red"><div class="icon  --arrow-top-right"><?php echo file_get_contents('dist/img/ui_link.svg') ?></div></div>
					<figure class="card__figure --large"><img src="dist/img/play_dovolena.jpg" alt=""></figure>
					<div class="card__title">
						<h4 class="">Dovolená paní Josefy 4. 2. přeloženo na 6. 5.</h4>
					</div>
					<div class="card__excerpt">
						<p class="">Vážení diváci,velice se omlouváme, ale z důvodu nemoci je představení DOVOLENÁ PANÍ JOSEFY 4. února 2023 přeloženo na 6. května 2023. Pokud se vám náhradní termín nehodí, je možné vstupenky vrátit nebo vyměnit za jiný termín či představení v pokladně Divadla Ungelt, nejpozději však do 10. 2. 2023.</p>
					</div>
					<div class="btn__group">
						<a href="" class="btn "><span class="btn__label">Více</span></a>
					</div>
				</div>
			</div>
		</div>
		<div class="card" data-aside-left>
			<div class="card__inner">
				<div class="card__head">
					<!-- <h2>G</h2> -->
					<span class="label">Glosář</span>
				</div>
				<!-- <figure class="card__figure"><img src="dist/img/artist_krajco.jpg" alt=""></figure> -->
				<div class="card__body">
					<div class="card__hover c-red"><div class="icon  --arrow-top-right"><?php echo file_get_contents('dist/img/ui_link.svg') ?></div></div>
					<div class="card__title">
						
						<h4 class="">Rozpravy Milana Heina - Adéla a Dalibor Gondíkovi</h4>
					</div>
					<div class="card__excerpt">
						<p class="">Adéla a Dalibor Gondíkovi jsou skvěle sehraní a tak se poslední Rozpravy Milana Heina nesly ve znamení neustálého vzájemného špičkování. Věděli jste, že Adéla byla kdysi uzavřeným introvertním dítětem? Dalibor se svěřil, jak bylo pro něj těžké přijmout skutečnost, že se za ním na konzervatoř hlásí i jeho mladší sestra. </p>
					</div>
					<div class="btn__group">
						<a href="" class="btn "><span class="btn__label">Více</span></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="news__close"  data-news-close></div>
</div>