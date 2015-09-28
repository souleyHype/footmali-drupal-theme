<?php
global $user;

?>

<header class="kopa-header">

    <div class="kopa-header-top">

        <div class="wrapper">

            <div class="header-top-left">
                <?php if(!$user->uid): ?>
                <div class="kopa-user">
                    <ul class="clearfix">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#footmali_user_login_modal" class="footmali_login_modal_button"><?php echo t('Sign in'); ?></a>
                        </li>
                        <li>&nbsp;|&nbsp;</li>
                        <li>
                            <a href="#"  data-toggle="modal" data-target="#footmali_register_modal" class="footmali_register_modal_button"><?php echo t('Register'); ?></a>
                        </li>
                    </ul>
                </div>
                <!-- kopa-user -->
                <?php endif; ?>

                <div class="social-links style-color">
                    <ul class="clearfix">
                        <li><a href="https://www.facebook.com/footmalicom" target="_blank" class="fa fa-facebook"></a></li>
                        <li><a href="https://twitter.com/footmalicom" target="_blank" class="fa fa-twitter"></a></li>
                        <li><a href="https://plus.google.com/+Footmalicom" target="_blank" class="fa fa-google-plus"></a></li>
                    </ul>
                </div>
                <!-- social-links -->

            </div>
            <!-- header-top-left -->

            <div class="header-top-right">

                <div class="header-top-list">
                    <ul class="clearfix">
                        <!-- <li><a href="#"><span><i class="fa fa-image"></i><span>photos</span></span></a></li> -->
                        <li><a href="/video/index"><span><i class="fa fa-play-circle-o"></i><span><?php echo t('Video'); ?></span></span></a></li>
                    </ul>
                </div>
                <!-- header-top-list -->

                <div class="kopa-search-box">
                    <a href="#"><i class="fa fa-search"></i><span><?php echo t('Search'); ?></span></a>

                    <form action="/" class="search-form clearfix" method="get">
                        <input type="text" onBlur="if (this.value == '')
                                this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
                                this.value = '';" value="<?php echo t('Search'); ?>..." name="s" class="search-text">
                        <button type="submit" class="search-submit">
                            <span>Go</span>
                        </button>
                    </form>
                </div>
                <!--kopa-search-box-->

            </div>
            <!-- header-top-right -->

        </div>
        <!-- wrapper -->

    </div>
    <!-- kopa-header-top -->

    <div class="kopa-header-middle">
        <div class="kopa-logo">
            <a id="logo" href="<?php echo $base_path; ?>"></a>
        </div>
        <!-- logo -->
        <div class="wrapper">

            <?php if (isset($main_menu)): ?>
                <nav class="kopa-main-nav">
                    <ul class="main-menu sf-menu">
                        <?php print $main_links; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <!--/end main-nav-->

            <?php if (isset($main_menu)): ?>
                <nav class="main-nav-mobile clearfix">
                    <a href="#menu-panel" class="pull fa fa-bars"></a>

                    <ul id="menu-panel" class="main-menu-mobile">
                        <?php print $main_links; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <!--/main-menu-mobile-->

        </div>
        <!-- wrapper -->

    </div>
    <!-- kopa-header-middle -->

    <div class="kopa-header-bottom">

        <div class="wrapper">

            <nav class="kopa-main-nav-2">
                <ul class="main-menu-2 sf-menu">
                    <li>&nbsp;</li>
                </ul>
            </nav>
            <!--/end main-nav-2-->

<!--            <nav class="main-nav-mobile style2 clearfix">-->
<!--                <a class="pull">categories<i class="fa fa-angle-down"></i></a>-->
<!--                <ul class="main-menu-mobile">-->
<!--                </ul>-->
<!--            </nav>-->
            <!--/main-menu-mobile-2-->

        </div>
        <!-- wrapper -->

    </div>
    <!-- kopa-header-bottom -->

</header>
<!-- kopa-page-header -->