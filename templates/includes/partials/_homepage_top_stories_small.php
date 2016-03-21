<?php
$top_articles = footmali_top_articles();

?>
<div class="col-md-4">
<?php if(count($top_articles) > 0): ?>
    <div class="widget kopa-article-list-widget article-list-8">
        <h3 class="widget-title style10"><?php echo t('Top Stories'); ?></h3>
        <div class="widget-content">
            <ul class="clearfix item-list-entry mb-20">
              <?php foreach($top_articles as $top_article): ?>
                <?php if($top_article->type == 'article'): ?>
                <li>
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>">
                              <?php echo footmali_output_image('content_carrousel_thumb', $top_article->field_image); ?>
                            </a>
                        </div>
                        <div class="entry-content">
                            <h4 class="entry-title">
                              <a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>">
                                <?php echo $top_article->title; ?>
                              </a>
                            </h4>
                        </div>
                    </article>
                </li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            <!-- item-list-entry -->
            <ul class="clearfix item-list-video">
              <?php foreach($top_articles as $top_article): ?>
                <?php if($top_article->type == 'video'): ?>
                  <li>
                      <a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>">
                        <?php echo $top_article->title; ?> <span class="fa fa-play-circle-o"></span>
                      </a>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            <!-- item-list-video -->
        </div>
    </div>
  <!-- widget -->
<?php endif; ?>
<?php include('_ad_feature_sidebar.php'); ?>
</div>
