<!DOCTYPE html>
<html lang="cs" class="no-js " data-loading>

<!-- The head -->
<?php snippet('organisms/Head') ?>

<!-- The body -->
<?php snippet('organisms/Body', slots: true) ?>

  <?php slot('main') ?>
    <?php snippet('templates/'.ucfirst($page)) ?>
  <?php endslot() ?>

<?php endsnippet() ?>

<!-- The end --> 
<?php snippet('organisms/Aside'); ?>

<!-- The end --> 
<?php snippet('organisms/End'); ?>

</html>

