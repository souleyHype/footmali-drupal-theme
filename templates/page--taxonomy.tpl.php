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
                            <h3 class="widget-title style12"><?php echo t($term->name); ?><span class="ttg"></span></h3>
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
                                                <?php echo footmali_trim_paragraph($article->body[LANGUAGE_NONE][0]['value'], 140) . '...'; ?>
                                                <footer>
                                                    <p class="entry-author"><?php echo t('by'); ?> <?php echo $article->name; ?></p>
                                                </footer>
                                            </div>
                                            <?php echo footmali_render_share_small($article->nid, $article->title); ?>
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

                <?php if(!footmali_ismobile()): ?>
                    <?php include_once('includes/sidebar.php'); ?>
                <?php endif; ?>

            </div>
            <!-- row -->

        </div>
        <!-- wrapper -->

    </div>
    <!-- main-content -->

<?php include_once('includes/footer.php'); ?>