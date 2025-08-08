<!-- Vendor js -->

<!-- The cookie elements --> 
<!-- <script type="module" src="/assets/js/cookieconsent-config.js"></script> -->

<!-- Global js -->
<?= js('assets/js/app.dist.js') ?>

<!-- Local js -->
<?= js('src/components/templates/'.ucwords($page).'/index.js'); ?>