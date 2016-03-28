<?php

/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - : The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<?php global $theme_path; ?>

<?php include('includes/header.php'); ?>

    <div id="main-content" class="custom">

    <?php if(!footmali_ismobile()): ?>
        <div class="wrapper mb-30">

            <div class="widget-area-1">
                <?php include('includes/partials/_homepage_featured_carrousel_small.php'); ?>
                <?php include('includes/partials/_homepage_top_stories_small.php'); ?>
            </div>
            <!-- widget-area-1 -->

        </div>
        <!-- wrapper featured-->
    <?php endif; ?>

        <div class="wrapper">
            <div class="spacer" style="margin-bottom: 10px;">&nbsp;</div>
            <?php if(!footmali_ismobile()): ?>
                <?php print $messages; ?>
                <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
                <?php print render($page['help']); ?>
                <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
            <?php endif; ?>
            <div class="content-wrap">
                <div class="row">

                    <div class="kopa-main-col">

                        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
                        <?php if(footmali_ismobile()): ?>
                            <?php include('includes/partials/_mobile_top_stories.php'); ?>
                        <?php elseif(!footmali_ismobile()): ?>
                            <?php include('includes/partials/_homepage_headlines.php'); ?>
                            <?php include('includes/partials/_ad_content_wide.php'); ?>
                            <?php include('includes/partials/_video_carrousel.php'); ?>
                        <?php endif; ?>

                    </div>
                    <!-- main-col -->
                    <?php if(!footmali_ismobile()): ?>
                        <?php include('includes/sidebar.php'); ?>
                    <?php endif; ?>
                </div>
                <!-- row -->
            </div>
            <!-- content-wrap-->
            <?php if(!footmali_ismobile()): ?>
                <?php //include('includes/partials/_homepage_fixtures_standing.php'); ?>
            <?php endif; ?>
        </div>
        <!-- wrapper -->

    </div>
    <!-- main-content -->

<?php include('includes/footer.php'); ?>
<?php if(footmali_ismobile()): ?>
  <div id="mobile-footer-ad">
    <button type="button" class="btn btn-default" aria-label="close"
      style="position: absolute; right: 0; top: 0; z-index: 10;"
      onclick="jQuery('#mobile-footer-ad').hide(); jQuery('#kopa-footer').css('margin-bottom', '0');">
        <span class="fa fa-remove" aria-hidden="true"></span>
    </button>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Mobile Footer Homepage -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7538390076513661"
         data-ad-slot="1011026713"
         data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
  </div>
<?php endif; ?>
