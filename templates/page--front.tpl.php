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

<?php

global $theme_path;

$articles_query = new EntityFieldQuery();
$articles_query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', 'article')
    ->propertyCondition('status', NODE_PUBLISHED)
    ->range(0, 15)
    ->propertyOrderBy('created', 'DESC');

$articles = array();
$featured_articles = array();
$top_articles = array();
$headlines = array();

$articles_result = $articles_query->execute();
if( !empty($articles_result) && is_array($articles_result) ){
	$articles_ids = array_keys($articles_result['node']);
	$articles = node_load_multiple($articles_ids);

    $featured_articles = array_slice($articles, 0, 5, true);
    $top_articles = array_slice($articles, 5, 3, true);
    $headlines = array_slice($articles, 8, 7, true);
}

?>

<?php include_once('includes/header.php'); ?>

    <div id="main-content" class="style1">

        <div class="wrapper mb-30">

            <div class="widget-area-1">
                <div class="widget kopa-sync-carousel-widget">
                    <div class="owl-carousel sync1">
                    <?php if(count($featured_articles) > 0): ?>
                        <?php foreach($featured_articles as $featured_article): ?>
                            <div class="item">
                                <article class="entry-item">
                                    <div class="entry-thumb">
                                        <a href="<?php echo drupal_get_path_alias("node/{$featured_article->nid}"); ?>">
                                            <?php echo footmali_output_image('homepage_highlight_carousel', $featured_article->field_image); ?>
                                        </a>
                                        <div class="thumb-hover"></div>
                                    </div>
                                    <div class="entry-content">
                                        <p><span><b><?php echo format_date($featured_article->created, 'medium', 'j F Y') ?></b></span></p>
                                        <h4 class="entry-title">
                                            <a href="<?php echo drupal_get_path_alias("node/{$featured_article->nid}"); ?>"><?php echo $featured_article->title; ?></a>
                                        </h4>
                                        <h5><span><b>Wanger confirms that Germany international ...</b></span></h5>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </div>
                    <!-- sync1 -->
                    <div class="loading">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>

                </div>
                <!-- kopa sync carousel widget -->

            </div>
            <!-- widget-area-1 -->

        </div>
        <!-- wrapper featured-->

        <div class="wrapper">
            <div class="spacer" style="margin-bottom: 10px;">&nbsp;</div>
            <?php print $messages; ?>
            <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

            <div class="content-wrap">
                <div class="row">

                    <div class="kopa-main-col">

                        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>


                        <?php if(count($top_articles) > 0): ?>
                        <div class="widget kopa-article-list-widget article-list-1">
                            <h3 class="widget-title style12"><?php echo t('Top Stories'); ?><span class="ttg"></span></h3>
                            <ul class="clearfix">
                                <?php foreach($top_articles as $top_article): ?>
                                    <li>
                                        <article class="entry-item">
                                            <div class="entry-thumb">
                                                <a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>">
                                                    <?php echo footmali_output_image('article_teaser', $top_article->field_image); ?>
                                                </a>
                                            </div>
                                            <div class="entry-content">
                                                <div class="content-top">
                                                    <h4 class="entry-title"><a href="<?php echo drupal_get_path_alias("node/{$top_article->nid}"); ?>"><?php echo $top_article->title; ?></a></h4>
                                                </div>
                                                <?php echo drupal_substr($top_article->body[LANGUAGE_NONE][0]['value'], 0, 140) . '...'; ?>
                                                <footer>
                                                    <!-- todo: link arthur's other articles -->
                                                    <p class="entry-author">by <?php echo $top_article->name; ?></p>
                                                </footer>
                                            </div>
                                            <div class="post-share-link style-bg-color">
                                                <span><i class="fa fa-share-alt"></i></span>
                                                <ul>
                                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                                    <li><a href="#" class="fa fa-google-plus"></a></li>
                                                </ul>
                                            </div>
                                        </article>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- widget -->
                        <?php endif; ?>

<!--                        <div class="widget kopa-slide-2-widget">-->
<!--                            <h3 class="widget-title style11">video<span class="ttg"></span></h3>-->
<!--                            <div class="owl-carousel owl-carousel-7">-->
<!--                                <div class="item">-->
<!--                                    <article class="entry-item video-post">-->
<!--                                        <div class="entry-thumb">-->
<!--                                            <a href="#"><img src="http://placehold.it/188x147" alt=""></a>-->
<!--                                            <a class="thumb-icon" href="#"></a>-->
<!--                                        </div>-->
<!--                                        <div class="entry-content">-->
<!--                                            <h4 class="entry-title" itemscope="" itemtype="http://schema.org/Event"><a itemprop="name" href="#">USMNT friendly rostter about Dollovan</a></h4>-->
<!--                                            <footer>-->
<!--                                                <p class="entry-author">by <a href="#">Michel bellar</a></p>-->
<!--                                            </footer>-->
<!--                                        </div>-->
<!--                                    </article>-->
<!--                                </div>-->
<!--                                <div class="item">-->
<!--                                    <article class="entry-item video-post">-->
<!--                                        <div class="entry-thumb">-->
<!--                                            <a href="#"><img src="http://placehold.it/188x147" alt=""></a>-->
<!--                                            <a class="thumb-icon" href="#"></a>-->
<!--                                        </div>-->
<!--                                        <div class="entry-content">-->
<!--                                            <h4 class="entry-title" itemscope="" itemtype="http://schema.org/Event"><a itemprop="name" href="#">USMNT friendly rostter about Dollovan</a></h4>-->
<!--                                            <footer>-->
<!--                                                <p class="entry-author">by <a href="#">Michel bellar</a></p>-->
<!--                                            </footer>-->
<!--                                        </div>-->
<!--                                    </article>-->
<!--                                </div>-->
<!--                                <div class="item">-->
<!--                                    <article class="entry-item video-post">-->
<!--                                        <div class="entry-thumb">-->
<!--                                            <a href="#"><img src="http://placehold.it/188x147" alt=""></a>-->
<!--                                            <a class="thumb-icon" href="#"></a>-->
<!--                                        </div>-->
<!--                                        <div class="entry-content">-->
<!--                                            <h4 class="entry-title" itemscope="" itemtype="http://schema.org/Event"><a itemprop="name" href="#">USMNT friendly rostter about Dollovan</a></h4>-->
<!--                                            <footer>-->
<!--                                                <p class="entry-author">by <a href="#">Michel bellar</a></p>-->
<!--                                            </footer>-->
<!--                                        </div>-->
<!--                                    </article>-->
<!--                                </div>-->
<!--                                <div class="item">-->
<!--                                    <article class="entry-item video-post">-->
<!--                                        <div class="entry-thumb">-->
<!--                                            <a href="#"><img src="http://placehold.it/188x147" alt=""></a>-->
<!--                                            <a class="thumb-icon" href="#"></a>-->
<!--                                        </div>-->
<!--                                        <div class="entry-content">-->
<!--                                            <h4 class="entry-title" itemscope="" itemtype="http://schema.org/Event"><a itemprop="name" href="#">USMNT friendly rostter about Dollovan</a></h4>-->
<!--                                            <footer>-->
<!--                                                <p class="entry-author">by <a href="#">Michel bellar</a></p>-->
<!--                                            </footer>-->
<!--                                        </div>-->
<!--                                    </article>-->
<!--                                </div>-->
<!--                                <div class="item">-->
<!--                                    <article class="entry-item video-post">-->
<!--                                        <div class="entry-thumb">-->
<!--                                            <a href="#"><img src="http://placehold.it/188x147" alt=""></a>-->
<!--                                            <a class="thumb-icon" href="#"></a>-->
<!--                                        </div>-->
<!--                                        <div class="entry-content">-->
<!--                                            <h4 class="entry-title" itemscope="" itemtype="http://schema.org/Event"><a itemprop="name" href="#">USMNT friendly rostter about Dollovan</a></h4>-->
<!--                                            <footer>-->
<!--                                                <p class="entry-author">by <a href="#">Michel bellar</a></p>-->
<!--                                            </footer>-->
<!--                                        </div>-->
<!--                                    </article>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <!-- owl-carousel-7 -->-->
<!--                        </div>-->
<!--                        <!-- widget -->-->
<!--                    </div>-->
                    <!-- main-col -->

                    <?php include_once('includes/sidebar.php'); ?>

                </div>
                <!-- row -->
            </div>
            <!-- content-wrap-->

        </div>
        <!-- wrapper -->

    </div>
    <!-- main-content -->

<?php include_once('includes/footer.php'); ?>