<?php
$top_articles = footmali_mobile_articles();

$pager_previous = theme_pager_previous(array(
  'text' => t('Previous'),
  'element' => 1
));
$pager_next = theme_pager_next(array(
  'text' => t('More'),
  'element' => 1
));

?>
<?php if(count($top_articles) > 0): ?>
    <div class="widget kopa-article-list-widget article-list-1">
        <ul class="clearfix">
            <?php foreach($top_articles as $top_article): ?>
                <li>
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>">
                                <?php echo footmali_output_image('article_page', $top_article->field_image); ?>
                            </a>
                        </div>
                        <div class="entry-content">
                            <div class="content-top">
                                <h4 class="entry-title"><a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>"><?php echo $top_article->title; ?></a></h4>
                            </div>
                            <p><?php echo footmali_trim_paragraph($top_article->body[LANGUAGE_NONE][0]['value'],  140) . '...'; ?></p>
                            <footer>
                                <!-- todo: link arthur's other articles -->
                                <p class="entry-author"><?php echo t('by'); ?> <?php echo $top_article->name; ?></p>
                            </footer>
                        </div>
                        <?php echo footmali_render_share_small($top_article->nid, $top_article->title); ?>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
        <div id="mobile-pager" class="btn-group text-center">
          <?php if($pager_previous): ?>
            <button id="pager_previous" type="button " class="btn btn-default pager-button"><?php print $pager_previous; ?></button>
          <?php endif; ?>

          <?php if($pager_next): ?>
            <button id="pager-next" type="button" class="btn btn-default pager-button"><?php print $pager_next; ?></button>
          <?php endif; ?>
        </div>
    </div>
    <!-- widget -->
<?php endif; ?>
