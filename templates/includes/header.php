<?php
global $user;

?>

<header class="kopa-header">

    <div class="kopa-header-top">

        <div class="wrapper">

            <div class="header-top-left">

                <div class="kopa-user">
                    <ul class="clearfix">
                    <?php if(!$user->uid): ?>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#footmali_user_login_modal" class="footmali_login_modal_button"><?php echo t('Sign in'); ?></a>
                        </li>
                        <li>&nbsp;|&nbsp;</li>
                        <li>
                            <a href="#"  data-toggle="modal" data-target="#footmali_register_modal" class="footmali_register_modal_button"><?php echo t('Register'); ?></a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="/users/<?php echo $user->name; ?>"><?php echo t('Account'); ?></a>
                        </li>
                        <li>&nbsp;|&nbsp;</li>
                        <li>
                            <a href="/user/logout"><?php echo t('Log out'); ?></a>
                        </li>
                    <?php endif; ?>
                    </ul>
                </div>
                <!-- kopa-user -->

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
                        <li><a href="http://www.footmali.com/contact"><span><i class="fa fa-envelope"></i><span>Contacts</span></span></a></li>
			<li><a href="/video/index"><span><i class="fa fa-play-circle-o"></i><span><?php echo t('Video'); ?></span></span></a></li>
                    </ul>
                </div>
                <!-- header-top-list -->

                <div class="kopa-search-box">
                    <a href="#"><i class="fa fa-search"></i><span><?php echo t('Search'); ?></span></a>

                    <form action="/" class="search-form custom clearfix" method="get">
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

</header>
<!-- kopa-page-header -->
