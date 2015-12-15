<div class="widget widget_search style1">
    <h3 class="widget-title style3"><span class="fa fa-search"></span><?php echo t('search'); ?></h3>
    <div class="search-box">
        <form action="/" class="search-form custom clearfix" method="get">
            <input type="text" onblur="if (this.value == '') this.value = this.defaultValue;" onfocus="if (this.value == this.defaultValue) this.value = '';" value="<?php echo t('search'); ?>..." name="s" class="search-text">
            <button type="submit" class="search-submit">
                <span class="fa fa-search"></span>
            </button>
        </form>
        <!-- search-form -->
    </div>
</div>
<!-- widget -->