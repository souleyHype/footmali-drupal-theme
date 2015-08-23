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

$args = arg();
$tid = $args[2];
$term = taxonomy_term_load($tid);
$vocabulary = $term->vocabulary_machine_name;

$articles = array();

if( $vocabulary == 'category' ){
    $articles = footmali_get_category_articles($tid);
}else if( $vocabulary == 'tags'){
    $articles = footmali_get_tag_articles($tid);
}

?>

<?php include_once('includes/header.php'); ?>

    <div id="main-content">

        <div class="wrapper">

            <?php print $messages; ?>
            <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
            <?php print render($page['help']); ?>
            <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>

            <div class="row">

                <div class="kopa-main-col">

                    <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>

                    <div class="kopa-breadcrumb">
                        <div class="wrapper clearfix">
                            <?php print $breadcrumb; ?>
                        </div>
                    </div>
                    <!--/end .breadcrumb-->

                    <div class="widget-area-2">

                        <div class="widget kopa-article-list-widget article-list-1">
                            <h3 class="widget-title style12">the Latest news<span class="ttg"></span></h3>
                            <ul class="clearfix">
                                <?php foreach($articles as $article): ?>
                                    <li>
                                        <article class="entry-item">
                                            <div class="entry-thumb">
                                                <a href="<?php echo url("node/{$article->nid}"); ?>">
                                                    <?php echo footmali_output_image('article_teaser', $article->field_image); ?>
                                                </a>
                                            </div>
                                            <div class="entry-content">
                                                <div class="content-top">
                                                    <h4 class="entry-title" itemscope="" itemtype="http://schema.org/Article">
                                                        <a itemprop="name" href="<?php echo url("node/{$article->nid}"); ?>"><?php echo $article->title; ?></a>
                                                    </h4>
                                                </div>
                                                <?php echo drupal_substr($article->body[LANGUAGE_NONE][0]['value'], 0, 140) . '...'; ?>
                                                <footer>
                                                    <p class="entry-author">by <?php echo $article->name; ?></p>
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

                    </div>
                    <!-- widget-area-2 -->

                </div>
                <!-- main-col -->

                <div class="sidebar widget-area-11">
                    <div class="widget widget_search style1">
                        <h3 class="widget-title style3"><span class="fa fa-search"></span>search</h3>
                        <div class="search-box">
                            <form action="/" class="search-form clearfix" method="get">
                                <input type="text" onblur="if (this.value == '') this.value = this.defaultValue;" onfocus="if (this.value == this.defaultValue) this.value = '';" value="Search..." name="s" class="search-text">
                                <button type="submit" class="search-submit">
                                    <span class="fa fa-search"></span>
                                </button>
                            </form>
                            <!-- search-form -->
                        </div>
                    </div>
                    <!-- widget -->

                    <div class="widget kopa-ads-widget">
                        <a href="#"><img src="http://placehold.it/328x274" alt=""></a>
                    </div>
                    <!-- widget -->

                    <div class="widget kopa-tab-1-widget">
                        <div class="kopa-tab style6">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#headlines" data-toggle="tab"><span>headlines</span></a></li>
                                <li><a href="#news" data-toggle="tab"><span>club news</span></a></li>
                            </ul>
                            <!-- nav-tabs -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="headlines">
                                    <ul class="kopa-list clearfix">
                                        <li>
                                            <a href="#">Royals slip by Orioles for 3-0 advantage</a>
                                        </li>
                                        <li>
                                            <a href="#">Error hands Giants victory over Cards, NLCS </a>
                                        </li>
                                        <li>
                                            <a href="#">Lawyer: Hearing won't impact Winston's </a>
                                        </li>
                                        <li>
                                            <span class="bg-red">Live</span>
                                            <a href="#">Analyzing possible outcomes in Winston</a>
                                        </li>
                                        <li>
                                            <a href="#">USMNT draws with Honduras despite</a>
                                        </li>
                                        <li>
                                            <span class="bg-blue">Must read</span>
                                            <a href="#">New concern with concus</a>
                                        </li>
                                        <li>
                                            <a href="#">Pavelski boosts Sharks over Capitals</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- tab-pane -->
                                <div class="tab-pane" id="news">
                                    <ul class="kopa-list clearfix">
                                        <li>
                                            <a href="#">USMNT draws with Honduras despite</a>
                                        </li>
                                        <li>
                                            <span class="bg-blue">Must read</span>
                                            <a href="#">New concern with concus</a>
                                        </li>
                                        <li>
                                            <a href="#">Pavelski boosts Sharks over Capitals</a>
                                        </li>
                                        <li>
                                            <a href="#">Royals slip by Orioles for 3-0 advantage</a>
                                        </li>
                                        <li>
                                            <a href="#">Error hands Giants victory over Cards, NLCS </a>
                                        </li>
                                        <li>
                                            <a href="#">Lawyer: Hearing won't impact Winston's </a>
                                        </li>
                                        <li>
                                            <span class="bg-red">Live</span>
                                            <a href="#">Analyzing possible outcomes in Winston</a>
                                        </li>
                                    </ul>

                                </div>
                                <!-- tab-pane -->
                            </div>
                        </div>
                        <!-- kopa-tab -->

                    </div>
                    <!-- widget -->

                    <div class="widget kopa-article-list-widget article-list-5">
                        <h3 class="widget-title style14">
                            <span>planet futbol</span>
                            <a href="#">more <span class="fa fa-chevron-right"></span></a>
                        </h3>
                        <ul class="clearfix">
                            <li>
                                <article class="entry-item video-post">
                                    <div class="entry-thumb">
                                        <a href="#"><img src="http://placehold.it/360x210" alt=""></a>
                                        <a class="thumb-icon style1" href="#"></a>
                                    </div>
                                    <div class="entry-content">
                                        <div class="content-top">
                                            <h4 class="entry-title"><a href="#">USMNT friendly roster about Dollovan, but also</a></h4>
                                            <p class="entry-comment"><a href="#">52</a></p>
                                        </div>
                                        <footer>
                                            <p class="entry-author">by <a href="#">Michel bellar</a></p>
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
                        </ul>
                    </div>
                    <!-- widget -->

                </div>
                <!-- sidebar -->

            </div>
            <!-- row -->

        </div>
        <!-- wrapper -->

    </div>
    <!-- main-content -->

<?php include_once('includes/footer.php'); ?>