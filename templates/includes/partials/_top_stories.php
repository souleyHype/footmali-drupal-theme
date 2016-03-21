<?php
$top_articles = footmali_top_articles();
?>
<?php if(count($top_articles) > 0): ?>
    <div class="widget kopa-article-list-widget article-list-1">
        <h3 class="widget-title style12"><?php echo t('Top Stories'); ?><span class="ttg"></span></h3>
        <ul class="clearfix">
            <?php foreach($top_articles as $top_article): ?>
                <li>
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>">
                                <?php echo footmali_output_image('article_teaser', $top_article->field_image); ?>
                            </a>
                        </div>
                        <div class="entry-content">
                            <div class="content-top">
                                <h4 class="entry-title"><a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>"><?php echo $top_article->title; ?></a></h4>
                            </div>
                            <?php echo footmali_trim_paragraph($top_article->body[LANGUAGE_NONE][0]['value'],  140) . '...'; ?>
                            <footer>
                                <!-- todo: link arthur's other articles -->
                                <p class="entry-author"><?php echo t('by'); ?> <?php echo footmali_get_article_author($top_article); ?></p>
                            </footer>
                        </div>
                        <?php echo footmali_render_share_small($top_article->nid, $top_article->title); ?>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- widget -->
<?php endif; ?>
