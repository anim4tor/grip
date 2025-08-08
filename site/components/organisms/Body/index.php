<?php
  $header = isset($header) ? $header : true;
  $footer = isset($footer) ? $footer : true;
?>
<body data-page="<?= $page ?>" theme=dark>
    
    <?= $site->seobodyscripts() ?>

    <!-- The loader --> 
    <?php snippet('organisms/loader'); ?>

    <!-- Scroll container -->
    <app data-scroll-container data-app>
      
        <?php if($header): ?>
          <!-- The header --> 
          <?php snippet('organisms/Header'); ?>
        <?php endif ?>

        <main data-main class="inner-y__7">
          <?php if ($main = $slots->main()): ?>
            <!-- The main --> 
            <?= $main ?>
          <?php endif ?>
        </main>

        <?php if($footer): ?>
          <!-- The footer --> 
          <?php snippet('organisms/Footer'); ?>
        <?php endif ?>
        
    </app>

</body>

