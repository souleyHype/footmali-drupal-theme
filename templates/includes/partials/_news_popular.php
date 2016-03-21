<?php $pop_articles = footmali_popular_articles(); ?>
<?php
    $block = block_load('views', 'news-most_read_articles');
    $block_array = _block_render_blocks(array($block));
    $block_render = _block_get_renderable_array($block_array);
?>

<div class="widget kopa-article-list-widget article-list-6">
  <h3 class="widget-title style10"><?php echo t('Most Popular'); ?></h3>
  <div class="widget-content">
    <ul class="kopa-list clearfix">
        <?php if(count($pop_articles) > 0): ?>
            <?php foreach($pop_articles as $article): ?>
                <li>
                    <a href="/<?php echo drupal_get_path_alias("node/{$article->nid}"); ?>">
                      <?php echo $article->title; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
  </div>
</div>
<!-- widget -->
