<?php
global $theme_path;
$videos = footmali_get_videos(5);
?>
<?php if(count($videos) > 0): ?>
<div class="widget kopa-slide-2-widget">
    <h3 class="widget-title style11"><?php echo t('Videos'); ?><span class="ttg"></span></h3>
    <div class="owl-carousel owl-carousel-7">
        <?php foreach($videos as $video): ?>
            <?php
            $default_image_path = '/' . $theme_path . '/images/default_video_thumb.png';
            $default_image_markup = '<img src="'.$default_image_path.'" width="188" height="147" alt="" data-thmr="thmr_38">';
            $thumbnail_uri = $video->field_video[LANGUAGE_NONE][0]['thumbnail_path'];
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
            <div class="item">
                <article class="entry-item video-post">
                    <div class="entry-thumb">
                        <a href="/video/<?php echo $video->nid; ?>"><?php echo ! empty($image) ? $image : $default_image_markup; ?></a>
                        <a class="thumb-icon" href="/video/<?php echo $video->nid; ?>"></a>
                    </div>
                    <div class="entry-content">
                        <h4 class="entry-title" itemscope="" itemtype="http://schema.org/MediaObject">
                            <a itemprop="name" href="/video/<?php echo $video->nid; ?>"><?php echo $video->title; ?></a>
                        </h4>
                    </div>
                </article>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- owl-carousel-7 -->
</div>
<!-- widget -->
<?php endif; ?>