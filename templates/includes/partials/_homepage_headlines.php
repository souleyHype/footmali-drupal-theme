<?php
$headlines = footmali_headline_articles();
$index = 1;
?>
<?php if(count($headlines) > 0): ?>
    <div class="widget kopa-article-list-widget article-list-1">
        <h3 class="widget-title style12"><?php echo t('Headlines'); ?><span class="ttg"></span></h3>
        <ul class="clearfix">
            <?php foreach($headlines as $article): ?>
            	<?php if($article->type == 'article'): ?>
                <li>
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <a href="<?php echo drupal_get_path_alias("node/{$article->nid}"); ?>">
                                <?php echo footmali_output_image('article_teaser', $article->field_image); ?>
                            </a>
                        </div>
                        <div class="entry-content">
                            <div class="content-top">
                                <h4 class="entry-title"><a href="<?php echo drupal_get_path_alias("node/{$article->nid}"); ?>"><?php echo $article->title; ?></a></h4>
                            </div>
                            <?php echo footmali_trim_paragraph($article->body[LANGUAGE_NONE][0]['value'],  140) . '...'; ?>
                            <footer>
                                <!-- todo: link arthur's other articles -->
                                <p class="entry-author"><?php echo t('by'); ?> <?php echo footmali_get_article_author($article); ?></p>
                            </footer>
                        </div>
                        <?php echo footmali_render_share_small($article->nid, $article->title); ?>
                    </article>
                </li>
            	<?php endif; ?>
                <?php if($index == 4): ?>
                  <!-- headlines ad -->
                  <li class="headlines responsive-ad">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- Between Headlines -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-7538390076513661"
                         data-ad-slot="6917959512"
                         data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                  </li>
                <?php endif; ?>
            <?php $index++; endforeach; ?>
        </ul>
    </div>
    <!-- widget -->
<?php endif; ?>
