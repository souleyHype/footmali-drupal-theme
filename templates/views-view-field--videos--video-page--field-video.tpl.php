<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */

global $theme_path;

$default_image_path = '/' . $theme_path . '/images/default_video_thumb.png';
$default_image_markup = '<img src="'.$default_image_path.'" width="247" height="210" alt="" data-thmr="thmr_38">';
$thumbnail_uri = $row->field_field_video[0]['rendered']['#item']['uri'];
$image = '';


if($thumbnail_uri){
    $variable = array(
        'style_name' => 'video_grid_thumbnail',
        'path' => $thumbnail_uri,
        'width' => '',
        'height' => '',
    );
    $image = theme_image_style($variable);
}



?>

<article class="entry-item video-post">
    <div class="entry-thumb">
        <a href="/video/<?php echo $row->nid; ?>" class="video-thumb">
            <?php echo ! empty($image) ? $image : $default_image_markup; ?>
        </a>
        <a href="/video/<?php echo $row->nid; ?>" class="thumb-icon style1"></a>
    </div>
    <div class="entry-content">
        <div class="content-top">
            <h4 class="entry-title" itemscope="" itemtype="http://schema.org/Event">
                <a itemprop="name" href="/video/<?php echo $row->nid; ?>" class="video-title">
                    <?php echo $row->node_title;?>
                </a>
            </h4>
        </div>
<!--        <footer>-->
<!--            <p class="entry-author">by <a href="#">Michel bellar</a></p>-->
<!--        </footer>-->
    </div>
    <?php echo footmali_render_share_small($row->nid, $row->node_title); ?>
</article>