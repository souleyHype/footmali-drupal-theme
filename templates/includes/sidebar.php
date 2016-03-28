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

    <?php if(!drupal_is_front_page()): ?>
      <div class="widget kopa-ads-widget style1">
        <!-- Content wide -->
        <?php if (module_exists('adsense')) {
          print adsense_display(array(
            'format' => '300x600',
            'slot' => '6660607519'
          ));
        } ?>
      </div>
    <?php endif ?>

</div>
<!-- sidebar -->
