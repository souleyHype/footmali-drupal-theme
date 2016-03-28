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
global $language;

$tags = array();
if($page){

    if( count($field_tags) >= 1){
        foreach($field_tags as $tag){
            $term = $tag['taxonomy_term'];

            array_push($tags, array('id' => $term->tid, 'name' => $term->name, 'type'=>'term'));
        }
    }

    if( count($field_more_tags) >= 1){
        foreach($field_more_tags as $tag){
            $entity = $tag['entity'];

            array_push($tags, array('id' => $entity->nid, 'name' => $entity->title, 'type'=>'node'));
        }
    }

}

?>
<?php if($page): ?>
    <div class="kopa-entry-post">
        <article class="entry-item">
            <p class="entry-categories style-s">
                <a href="/actu"><?php echo t('News'); ?></a>
                <?php if(!empty($new_category_url) && !empty($news_category)): ?>
                    <a href="<?php echo $new_category_url; ?>"><?php echo $news_category; ?></a>
                <?php endif; ?>
            </p>

            <h4 class="entry-title"><?php print $title; ?></h4>
            <div class="entry-meta">
                <span class="entry-author"><?php echo t('by'); ?> <?php echo footmali_get_article_author($node); ?></a></span>
                <span class="entry-date"><?php echo footmali_get_article_published_date($node); ?></span>
            </div>
            <div class="entry-thumb">
                <?php print render($content['field_image']); ?>
            </div>
            <p class="short-des"><i></i></p>

            <?php echo footmali_render_share_normal($nid, $title); ?>
            <!-- kopa-share-post -->
            <?php print render($content['body']); ?>
        </article>

    </div>
    <!-- kopa-entry-post -->
    <?php if (count($tags) > 0): ?>
        <div class="kopa-tag-box">
            <span>Tags : </span>
            <?php foreach($tags as $tag):?>
                <a href="/<?php echo $tag['type'] === 'term' ? drupal_get_path_alias('taxonomy/term/'.$tag['id']) : drupal_get_path_alias('node/'.$tag['id']); ?>">
                    <?php echo $tag['name']; ?>
                </a>
                &nbsp;&#92;&nbsp;
            <?php endforeach; ?>
        </div>
        <!-- kopa-tag-box -->
    <?php endif; ?>
    <!-- kopa-share-post -->

    <?php
    $prev_article = footmali_get_previous_article($nid);
    $next_article = footmali_get_next_article($nid);
    ?>
    <?php if($prev_article || $next_article): ?>
        <div class="single-other-post clearfix">
            <?php if($prev_article): ?>
                <div class="entry-item prev-post">
                    <div class="entry-thumb">
                        <a href="<?php echo drupal_get_path_alias("node/".$nid); ?>">
                            <img src="<?php print image_style_url("article_previous_next", $prev_article->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="">
                        </a>
                    </div>
                    <div class="entry-content">
                        <a href="/<?php echo drupal_get_path_alias("node/".$nid); ?>" class=""><?php echo t('Previous Post'); ?></a>
                        <h4 class="entry-title">
                            <a href="/<?php echo drupal_get_path_alias("node/{$prev_article->nid}"); ?>"><?php echo $prev_article->title; ?></a>
                        </h4>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($next_article): ?>
                <div class="entry-item next-post">
                    <div class="entry-thumb">
                        <a href="/<?php echo drupal_get_path_alias("node/".$nid); ?>">
                            <img src="<?php print image_style_url("article_previous_next", $next_article->field_image[LANGUAGE_NONE][0]['uri']); ?>" alt="">
                        </a>
                    </div>
                    <div class="entry-content">
                        <a href="/<?php echo drupal_get_path_alias("node/".$nid); ?>" class=""><?php echo t('Next Post'); ?></a>
                        <h4 class="entry-title">
                            <a href="/<?php echo drupal_get_path_alias("node/{$next_article->nid}"); ?>"><?php echo $next_article->title; ?></a>
                        </h4>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- single-other-post -->
    <?php endif; ?>

    <div id="comments">
      <h4><?php echo t('Reagissez A Cet Article'); ?></h4>
        <div class="fb-comments" data-href="<?php drupal_get_path_alias("node/{$nid}"); ?>" data-width="100%" data-numposts="10"></div>
    </div>
    <!-- comment -->
<?php endif; ?>

<?php if($teaser): ?>
    <article class="entry-item">
        <div class="entry-thumb">
            <a href="/<?php echo drupal_get_path_alias('node/' . $node->nid); ?>">
                <?php echo footmali_output_image('article_teaser', $node->field_image); ?>
            </a>
        </div>
        <div class="entry-content">
            <div class="content-top">
                <h4 class="entry-title"><a href="/<?php echo drupal_get_path_alias('node/' . $node->nid); ?>"><?php echo $title; ?></a></h4>
            </div>
            <?php echo footmali_trim_paragraph($body[0]['value'], 140) . '...'; ?>
            <footer>
                <!-- todo: link arthur's other articles -->
                <p class="entry-author"><?php echo t('by'); ?> <?php echo footmali_get_article_author($node); ?></p>
            </footer>
        </div>
        <?php echo footmali_render_share_small($nid, $title); ?>
    </article>
<?php endif; ?>
