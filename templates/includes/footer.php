<?php if(!footmali_ismobile()): ?>
<div id="bottom-sidebar">
<!--    <div class="bottom-area-2">-->
<!---->
<!--        <div class="wrapper">-->
            <?php //include_once('partials/_footer_sitemap.php'); ?>
<!--        </div>-->
        <!-- wrapper -->
<!--    </div>-->
    <!-- bottom-area-2 -->

    <div class="bottom-area-3">
        <div class="wrapper">
            <?php include_once('partials/_footer_newsletter.php'); ?>
        </div>
        <!-- wrapper -->
    </div>
    <!-- bottom-area-3 -->
</div>
<!-- bottom-sidebar -->
<?php endif; ?>

<footer id="kopa-footer">

    <div class="wrapper clearfix">

        <p id="copyright" class=""><?php echo t('Copyright'); ?> © Footmali.com <?php echo date('Y'); ?>. <?php echo t('All Rights Reserved'); ?>.</p>

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

                <?php if(function_exists('fboauth_action_display')): ?>
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
                            <?php echo drupal_render($register_form['field_newsletter_subscribe']); ?>
                        </div>

                        <!-- reCaptcha -->
                        <div class="g-recaptcha" data-type="image" data-theme="light" data-sitekey="6LebARMTAAAAAMLo0hs0XrwCxlarDuL-iosAL2UO"></div>
                        <br />
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
                        <span class="omb_spanOr"><?php echo t('or'); ?></span>
                    </div>
                </div>
                <?php if(function_exists('fboauth_action_display')): ?>
                    <div class="social-login">
                        <?php print fboauth_action_display('connect'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php endif; ?>