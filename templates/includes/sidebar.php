<div class="sidebar widget-area-11">
    <?php include_once('partials/_search.php'); ?>

    <?php include_once('partials/_ad_sidebar.php'); ?>

    <?php if(drupal_is_front_page()): ?>
      <?php include_once('partials/_news_popular.php'); ?>
      <?php include_once('partials/_sidebar_standings.php'); ?>
    <?php elseif(!drupal_is_front_page()): ?>
      <?php include_once('partials/_news_headlines_popular.php'); ?>
    <?php endif; ?>

    <?php include_once('partials/_facebook_banner.php'); ?>

</div>
<!-- sidebar -->
