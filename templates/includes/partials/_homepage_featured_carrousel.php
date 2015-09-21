<?php

$featured_articles = footmali_featured_articles();
//var_dump($featured_articles);

?>
<div class="widget kopa-sync-carousel-widget">
    <div class="owl-carousel sync1">
        <?php if(count($featured_articles) > 0): ?>
            <?php foreach($featured_articles as $featured_article): ?>
                <div class="item">
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <a href="<?php echo drupal_get_path_alias("node/{$featured_article->nid}"); ?>">
                                <?php echo footmali_output_image('homepage_highlight_carousel', $featured_article->field_image); ?>
                            </a>
                            <div class="thumb-hover"></div>
                        </div>
                        <div class="entry-content">
                            <p><span><b><?php echo format_date($featured_article->created, 'medium', 'j F Y') ?></b></span></p>
                            <h4 class="entry-title">
                                <a href="<?php echo drupal_get_path_alias("node/{$featured_article->nid}"); ?>"><?php echo $featured_article->title; ?></a>
                            </h4>
                            <h5><span><b><?php echo $featured_article->body[LANGUAGE_NONE][0]['summary']; ?></b></span></h5>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <!-- sync1 -->
    <div class="loading">
        <i class="fa fa-refresh fa-spin"></i>
    </div>

</div>
<!-- kopa sync carousel widget -->