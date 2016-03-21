<?php

/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>

<?php
global $theme_path;

$squad = footmali_get_team_squad($nid);
$articles = footmali_get_entity_articles($nid);

$default_team_logo = '/' . $theme_path . '/images/default_club_logo.png';
$team_logo = '<img src="' . $default_team_logo .'" width="50px" height="50px">';
if(count($field_image) > 0){
    $team_logo = theme_image_style(array(
                'style_name' => 'team_logo',
                'path' => $field_image[0]['uri'],
                'width' => '',
                'height' => '',
            ));
}

?>
<h1><span style="padding-right: 10px;"><?php echo $team_logo; ?></span><?php print $title; ?></h1>
<div class="team-header mb-30">
    <div class="kopa-tab team-tab style6">
        <ul class="nav nav-tabs">
            <?php if($squad && count($squad) > 0): ?>
            <li class="active">
                <a href="#squad" data-toggle="tab"><span><?php echo t('Effectif') ?></span></a>
            </li>
            <?php endif; ?>
            <?php if($articles && count($articles) > 0): ?>
            <li>
                <a href="#articles" data-toggle="tab"><span>Articles</span></a>
            </li>
        <?php endif; ?>
        </ul>
    </div>
    <!-- fixture-tab -->
</div>

<div class="tab-content ft-tab-content mb-30">
<?php if($squad && count($squad) > 0): ?>
    <div class="tab-pane active" id="squad">
    <?php foreach($squad as $position => $players): ?>
        <div class="widget kopa-team-club-widget">
            <h3 class="widget-title"><?php echo $position; ?></h3>
            <div class="widget-content">
                <ul class="team-masonry row clearfix" style="position: relative; height: 120px;">
                    <?php foreach($players as $player): ?>
                        <li class="t-item col-md-6 col-sm-6 col-xs-6" style="position: absolute; left: 0px; top: 0px;">
                            <article class="entry-item">
                                <div class="entry-thumb">
                                    <a href="/<?php echo drupal_get_path_alias('node/' . $player->nid); ?>">
                                    <?php if(!is_null($player->image)): ?>
                                        <?php
                                        echo theme_image_style(array(
                                            'style_name' => 'squad_player',
                                            'path' => $player->image,
                                            'width' => '',
                                            'height' => '',
                                        ));
                                        ?>
                                    <?php else: ?>
                                        <img src="/<?php echo $theme_path ?>/images/default_player_profile_small.png" width="190px" height="146px">
                                    <?php endif; ?>
                                    </a>
                                    <div class="thumb-icon style3"><?php echo $player->number; ?></div>
                                </div>
                                <div class="entry-content">
                                    <h5 class=""><a href="/<?php echo drupal_get_path_alias('node/' . $player->nid); ?>"><?php echo $player->name; ?></a></h5>
                                </div>
                            </article>
                        </li>
                        <!-- col-md-6 -->
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <!-- widget -->
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if($articles): ?>
    <div class="tab-pane" id="articles">
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
                                        <a itemprop="name" href="/<?php echo drupal_get_path_alias("node/{$article->nid}"); ?>"><?php echo $article->title; ?></a>
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
<?php endif; ?>
</div>
