<div id="bottom-sidebar">

    <div class="bottom-area-2">

        <div class="wrapper">

            <div class="row">

                <div class="widget-area-18">

                    <div class="widget widget_recent_entries">
                        <h3 class="widget-title">sports</h3>
                        <ul class="clearfix">
                            <li>
                                <a href="#">FIFA</a>
                            </li>
                            <li>
                                <a href="#">Madden NFL</a>
                            </li>
                            <li>
                                <a href="#">PGA TOUR</a>
                            </li>
                            <li>
                                <a href="#">NHL®</a>
                            </li>
                            <li>
                                <a href="#">NBA Live</a>
                            </li>
                            <li>
                                <a href="#">EA SPORTS UFC</a>
                            </li>
                            <li>
                                <a href="#">2014 FIFA World Cup</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- widget-area-18 -->

                <div class="widget-area-19">

                    <div class="widget widget_recent_entries">
                        <h3 class="widget-title">our team</h3>
                        <ul class="clearfix">
                            <li>
                                <a href="#">BC Lions</a>
                            </li>
                            <li>
                                <a href="#">Edmonton Eskimos</a>
                            </li>
                            <li>
                                <a href="#">Calgary Stampeders</a>
                            </li>
                            <li>
                                <a href="#">Hamilton Tiger</a>
                            </li>
                            <li>
                                <a href="#">Winnipeg Blue Bombers</a>
                            </li>
                            <li>
                                <a href="#">Hamilton Tiger-Cats</a>
                            </li>
                            <li>
                                <a href="#">Toronto Argonauts</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- widget-area-19 -->

                <div class="widget-area-20">

                    <div class="widget widget_recent_entries">
                        <h3 class="widget-title">QUICK SHOP</h3>
                        <ul class="clearfix">
                            <li>
                                <a href="#">CrossFit</a>
                            </li>
                            <li>
                                <a href="#">Reebok One Series</a>
                            </li>
                            <li>
                                <a href="#">Workout</a>
                            </li>
                            <li>
                                <a href="#">Spartan Race</a>
                            </li>
                            <li>
                                <a href="#">Les Mills</a>
                            </li>
                            <li>
                                <a href="#">NPC</a>
                            </li>
                            <li>
                                <a href="#">The Pump</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- widget-area-20 -->

                <div class="widget-area-21">

                    <div class="widget widget_recent_entries">
                        <h3 class="widget-title">Our League</h3>
                        <ul class="clearfix">
                            <li>
                                <a href="#">Tickets</a>
                            </li>
                            <li>
                                <a href="#">Contact Us</a>
                            </li>
                            <li>
                                <a href="#">FAQs</a>
                            </li>
                            <li>
                                <a href="#">Employment</a>
                            </li>
                            <li>
                                <a href="#">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="#">Terms of Use</a>
                            </li>
                            <li>
                                <a href="#">Grey Cup Central</a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- widget-area-21 -->

            </div>
            <!-- row -->

        </div>
        <!-- wrapper -->

    </div>
    <!-- bottom-area-2 -->

    <div class="bottom-area-3">

        <div class="wrapper">

            <div class="widget kopa-newsletter-widget">
                <div class="newsletter-intro">
                    <span class="news-icon fa fa-envelope"></span>
                    <p>Subscribe to our email newsletter</p>
                </div>
                <div class="newsletter-content">
                    <span class="input-icon fa fa-envelope"></span>
                    <form class="newsletter-form clearfix" method="post" action="#">
                        <div class="input-area">
                            <input type="text" onBlur="if (this.value == '')
                                this.value = this.defaultValue;" onFocus="if (this.value == this.defaultValue)
                                this.value = '';" value="Enter Your Email Address..." size="40" class="name"  name="name">
                        </div>
                        <button type="submit" class="search-submit">
                            <span>Sign me up</span>
                            <span class="fa fa-chevron-right"></span>
                        </button>
                    </form>
                    <div id="newsletter-response"></div>
                </div>
            </div>
            <!-- widget -->

        </div>
        <!-- wrapper -->

    </div>
    <!-- bottom-area-3 -->

</div>
<!-- bottom-sidebar -->

<footer id="kopa-footer">

    <div class="wrapper clearfix">

        <p id="copyright" class="">Copyright © <?php echo date('Y'); ?> . All Rights Reserved.</p>

    </div>
    <!-- wrapper -->

</footer>
<!-- kopa-footer -->

<?php if(!$user->uid):
    $login_form = drupal_get_form('user_login_block');
    $register_form = drupal_get_form('user_register_form');
?>

<!--Login Modal-->
<div class="modal fade" id="footmali_user_login_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo t('Login'); ?></h4>
            </div>
            <div class="modal-body clearfix">
                <div class="site-login">
                    <form action="<?php echo $login_form['#action']; ?>" method="<?php echo $login_form['#method']; ?>" >
                        <div class="form-group">
                            <?php echo drupal_render($login_form['name']); ?>
                        </div>
                        <div class="form-group">
                            <?php echo drupal_render($login_form['pass']); ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?php echo $login_form['actions']['submit']['#value']; ?></button>
                        </div>
                        <?php
                            // render login button
                            print drupal_render($login_form['form_build_id']);
                            print drupal_render($login_form['form_id']);
                        ?>
                    </form>
                </div>

                <div class="row omb_row-sm-offset-3 omb_loginOr">
                    <div class="col-xs-12 col-sm-6">
                        <hr class="omb_hrOr">
                        <span class="omb_spanOr">or</span>
                    </div>
                </div>

                <?php if(function_exists(fboauth_action_display)): ?>
                    <div class="social-login">
                        <?php print fboauth_action_display('connect'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Registration Modal-->
<div class="modal fade" id="footmali_register_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo t('Register'); ?></h4>
            </div>
            <div class="modal-body clearfix">
                <div class="site-login">
                    <form enctype="multipart/form-data" class="<?php echo $register_form['#attributes']['class'][0]; ?>" action="<?php echo $register_form['#action']; ?>" method="<?php echo $register_form['#method']; ?>" >
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php echo drupal_render($register_form['field_first_name']); ?>
                                </div>
                                <div class="col-md-6">
                                    <?php echo drupal_render($register_form['field_last_name']); ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <?php echo drupal_render($register_form['account']['name']); ?>
                        </div>
                        <div class="form-group">
                            <?php echo drupal_render($register_form['account']['mail']); ?>
                        </div>
                        <div class="form-group">
                            <?php echo drupal_render($register_form['account']['pass']); ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><?php echo $register_form['actions']['submit']['#value']; ?></button>
                        </div>
                        <?php
                        // render login button
                        print drupal_render($register_form['form_build_id']);
                        print drupal_render($register_form['form_id']);
                        ?>
                    </form>
                </div>

                <div class="row omb_row-sm-offset-3 omb_loginOr">
                    <div class="col-xs-12 col-sm-6">
                        <hr class="omb_hrOr">
                        <span class="omb_spanOr">or</span>
                    </div>
                </div>
                <?php if(function_exists(fboauth_action_display)): ?>
                    <div class="social-login">
                        <?php print fboauth_action_display('connect'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php endif; ?>