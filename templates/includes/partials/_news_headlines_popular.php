<?php $headlines = footmali_headline_articles(); ?>

<div class="widget kopa-tab-1-widget">
    <div class="kopa-tab style7">
        <ul class="nav nav-tabs">
            <?php if(count($headlines) > 0): ?>
                <li class="active"><a href="#headlines" data-toggle="tab"><span>headlines</span></a></li>
            <?php endif; ?>
            <li><a href="#news" data-toggle="tab"><span>plus populare</span></a></li>
        </ul>
        <!-- nav-tabs -->
        <div class="tab-content">
            <div class="tab-pane active" id="headlines">
                <ul class="kopa-list clearfix">
                    <?php if(count($headlines) > 0): ?>
                        <?php foreach($headlines as $headline): ?>
                            <li>
                                <a href="<?php echo drupal_get_path_alias("node/{$headline->nid}"); ?>"><?php echo $headline->title; ?></a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <!-- tab-pane -->
            <div class="tab-pane" id="news">
                <?php
                $most_read_block = module_invoke('views', 'block_view', 'news-most_read_articles');
                print render($most_read_block);
                ?>
            </div>
            <!-- tab-pane -->
        </div>
    </div>
    <!-- kopa-tab -->

</div>
<!-- widget -->