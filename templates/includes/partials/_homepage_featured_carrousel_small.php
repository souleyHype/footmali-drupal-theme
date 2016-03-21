<?php

$featured_articles = footmali_featured_articles();

?>

<?php if(count($featured_articles) > 0): ?>
<div class="col-md-8 widget kopa-tab-sync-carousel-widget">
  <h3 class="widget-title style1"><?php echo t('Features'); ?></h3>
    <div class="widget kopa-sync-carousel-2-widget">
        <div class="owl-carousel sync3">
            <?php foreach($featured_articles as $featured_article): ?>
                <div class="item">
                    <article class="entry-item video-post">
                        <div class="entry-thumb">
                            <a href="<?php echo drupal_get_path_alias("node/{$featured_article->nid}"); ?>">
                              <?php echo footmali_output_image('content_carrousel_large', $featured_article->field_image); ?>
                            </a>
                        </div>
                        <div class="entry-content">
                            <h3 class="">
                              <a href="<?php echo drupal_get_path_alias("node/{$featured_article->nid}"); ?>">
                                <?php echo $featured_article->title; ?>
                              </a>
                            </h3>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- sync3 -->
        <div class="owl-carousel sync4">
            <?php foreach($featured_articles as $featured_article): ?>
                <div class="item">
                    <article class="entry-item video-post">
                        <div class="entry-thumb">
                            <a href="#">
                              <?php echo footmali_output_image('content_carrousel_thumb', $featured_article->field_image); ?>
                            </a>
                        </div>
                        <div class="entry-content">
                            <h4 class="entry-title">
                              <a href="<?php echo drupal_get_path_alias("node/{$featured_article->nid}"); ?>">
                                <?php echo $featured_article->title; ?>
                              </a>
                            </h4>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- sync4 -->
    </div>
    <!-- kopa sync carousel widget -->
</div>
<!-- widget -->
<?php endif; ?>
