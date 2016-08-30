<?php

/**
 * @file
 * Main view template.
 *
 * Variables available:
 * - $classes_array: An array of classes determined in
 *   template_preprocess_views_view(). Default classes are:
 *     .view
 *     .view-[css_name]
 *     .view-id-[view_name]
 *     .view-display-id-[display_name]
 *     .view-dom-id-[dom_id]
 * - $classes: A string version of $classes_array for use in the class attribute
 * - $css_name: A css-safe version of the view name.
 * - $css_class: The user-specified classes names, if any
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 *
 * @ingroup views_templates
 */
?>
<div class="<?php print $classes; ?>">
<?php print render($title_prefix); ?>
<?php if ($title): ?>
    <?php print $title; ?>
<?php endif; ?>
<?php print render($title_suffix); ?>
<?php if ($header): ?>
    <div class="view-header">
        <?php print $header; ?>
    </div>
<?php endif; ?>

<?php if ($rows): ?>
    <div class="view-content">


        <div class="widget kopa-article-list-widget article-list-9">
            <ul class="clearfix">
                <?php foreach($results as $article): ?>
                    <?php
                    $thumbnail_uri = $article->field_field_image[0]['rendered']['#item']['uri'];
                    $image = '';


                    if($thumbnail_uri){
                        $variable = array(
                            'style_name' => 'content_carrousel_thumb',
                            'path' => $thumbnail_uri,
                            'width' => '',
                            'height' => '',
                        );

                        $image = theme_image_style($variable);
                    }
                    ?>
                <li>
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <a href="<?php echo drupal_get_path_alias("node/".$article->nid); ?>"><?php echo ! empty($image) ? $image : ''; ?></a>
                        </div>
                        <h4 class="entry-title">
                            <a itemprop="name" href="<?php echo drupal_get_path_alias("node/".$article->nid); ?>"><?php echo $article->node_title; ?></a>
                        </h4>
                    </article>
                </li>
            <?php endforeach ?>
            </ul>
        </div>
        <!-- widget -->
    </div>
<?php endif; ?>
</div>
