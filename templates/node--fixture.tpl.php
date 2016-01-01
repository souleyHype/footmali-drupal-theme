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

$match_date = $node->field_date_time[LANGUAGE_NONE][0]['value'];

$competition = $node->field_competition[LANGUAGE_NONE][0]['entity'];
$competition_parent = isset($competition->parent[0]) ? taxonomy_term_load($competition->parent[0]) : null;
$competition_round = $node->field_competition_round[LANGUAGE_NONE][0]['entity'];

$default_team_logo = '/' . $theme_path . '/images/default_club_logo.png';
$team_logo = '<img src="' . $default_team_logo .'" width="90px" height="90px">';

$home_team = $node->field_home_team[LANGUAGE_NONE][0]['node'];
$home_team_short_name = !empty($home_team->field_short_name) ? $home_team->field_short_name[LANGUAGE_NONE][0]['value'] : $home_team->title;
$home_team_score = $node->field_home_team_score[LANGUAGE_NONE][0]['value'];

$away_team = $node->field_away_team[LANGUAGE_NONE][0]['node'];
$away_team_short_name = !empty($away_team->field_short_name) ? $away_team->field_short_name[LANGUAGE_NONE][0]['value'] : $away_team->title;
$away_team_score = $node->field_away_team_score[LANGUAGE_NONE][0]['value'];
?>
<div class="kopa-entry-post">
    <article class="entry-item">
        <h4 class="entry-title"><?php echo $home_team->title; ?> vs <?php echo $away_team->title; ?></h4>
        <div class="match-item last-item mb-20">
            <header>
                <p><?php echo date('l, d/m/Y', strtotime($match_date)); ?></p>
                <span>
                    <?php echo !is_null($competition_parent) ? $competition_parent->name . ': ' : ''; ?>
                    <?php echo $competition->name; ?>
                </span>
                <!-- @todo: add competition logo -->
                <!-- <span><img src="images/background/cl.png" alt=""></span>  -->
            </header>
            <div class="r-item">
                <div class="span-bg">
                    <span class="c-tg"></span>
                </div>
                <a class="r-num" href="#">
                    <span class="<?php echo $home_team_score > $away_team_score ? 'r-color': ''; ?>"><?php echo $home_team_score; ?></span>
                    <span>-</span>
                    <span class="<?php echo $home_team_score < $away_team_score ? 'r-color': ''; ?>"><?php echo $away_team_score; ?></span>
                </a>
                <a class="r-side left" href="/<?php echo drupal_get_path_alias('node/' . $home_team->nid); ?>">
                    <div class="r-thumb">
                        <?php 
                            echo count($home_team->field_image) > 0 ? 
                                footmali_output_image('fixture_result_team_logo', $home_team->field_image) : $team_logo; 
                        ?>
                    </div>
                    <div class="r-content">
                        <h5><?php echo strlen($home_team->title) < 15 ? $home_team->title : $home_team_short_name; ?></h5>
                            <!-- @todo: goal scorers -->
                            <!-- <p>Sanchen (27 pen), Sanobo (78)</p>-->
                    </div>
                </a>
                <a class="r-side right" href="/<?php echo drupal_get_path_alias('node/' . $away_team->nid); ?>">
                    <div class="r-thumb">
                        <?php 
                            echo count($away_team->field_image) > 0 ? 
                                footmali_output_image('fixture_result_team_logo', $away_team->field_image) : $team_logo; 
                        ?>
                    </div>
                    <div class="r-content">
                        <h5><?php echo strlen($away_team->title) < 15 ? $away_team->title : $away_team_short_name; ?></h5>
                        <!-- @todo: goal scorers -->
                        <!-- <p>Sanchen (27 pen), Sanobo (78)</p>-->
                    </div>
                </a>
            </div>
            <footer>
                &nbsp;
                <!-- <a href="#" class="more-detail">Match news<i class="fa fa-chevron-right"></i></a> -->
            </footer>
        </div>
    </article>
</div>