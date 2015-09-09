<?php

/**
 *Override or insert variables into the html template.
 */
function footmali_preprocess_html(&$variables) {

    // Add conditional CSS for IE < 9.
    drupal_add_css(
        path_to_theme() . 'css/ie.css',
        array(
            'group' => CSS_THEME,
            'browsers' => array('IE' => 'lt IE 9', '!IE' => FALSE),
            'preprocess' => FALSE
        )
    );

    // Add conditional CSS for IE = 9.
    drupal_add_css(
        path_to_theme() . 'css/ie9.css',
        array(
            'group' => CSS_THEME,
            'browsers' => array('IE' => 'IE 9', '!IE' => FALSE),
            'preprocess' => FALSE
        )
    );
}

function footmali_css_alter(&$css) {
    unset($css[drupal_get_path('module','system').'/system.theme.css']);
}

function footmali_preprocess_page(&$variables) {

    if (isset($variables['main_menu'])) {
        $menu_tree_array = menu_build_tree('main-menu');

        $main_links = '';
        foreach($menu_tree_array as $menu):
            $main_links .= '<li><a href="' . url($menu['link']['link_path']) . '"><span>' . $menu['link']['link_title'] .'</span></a>';

            if(count($menu['below']) > 0):
                $main_links .= '<ul class="sub-menu">';
                foreach($menu['below'] as $sub_menu):
                    $main_links .= '<li><a href="' . drupal_get_path_alias($sub_menu['link']['link_path'])  . '">' . $sub_menu['link']['link_title'] . '</a></li>';
                endforeach;
                $main_links .= '</ul>';
            endif;
            $main_links .= '</li>';
        endforeach;

        $variables['main_links'] = $main_links;
    }

    $search_block = module_invoke('search', 'block_view', 'search');
    $variables['search_block'] = $search_block;
}

function footmali_preprocess_node(&$variables) {
    $variables['node'] = $variables['elements']['#node'];
    $node = $variables ['node'];

    if('article' == $node->type){
        $variables['new_category_url'] = '';
        $variables['news_category'] = '';
        $taxonomy = isset($node->field_category[LANGUAGE_NONE][0]['taxonomy_term']) ?
            $node->field_category[LANGUAGE_NONE][0]['taxonomy_term']
            : false;

        if($taxonomy){
            $variables['new_category_url'] = '/taxonomy/term/' . $taxonomy->tid;
            $variables['news_category'] = $taxonomy->name;
        }
    }
}

/**
 * Output breadcrumb as an unorderd list with unique and first/last classes
 * Ouptuts site breadcrumbs with current page title appended onto trail
 *
 * @param $variables
 * @return string
 */
function footmali_breadcrumb($variables) {
    $nodeid = null;

    if (arg(0) == 'node' && is_numeric(arg(1))) $nodeid = arg(1);

    $node = node_load($nodeid);
    $breadcrumb = $variables['breadcrumb'];
    if (!empty($breadcrumb)) {
        $crumbs = '';
        $array_size = count($breadcrumb);
        $i = 0;
        while ( $i < $array_size) {
            $crumbs .= '<span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="" class="breadcrumb-' . $i;
            if ($i == 0) {
                $crumbs .= ' first';
            }elseif ($i+1 == $array_size) {
                $crumbs .= ' last';
            }
            $crumbs .=  '">' . $breadcrumb[$i] . '</span> &nbsp;|&nbsp; ';
            $i++;
        }

        if($node && $node->type == 'article'){
            if(isset($node->field_category[LANGUAGE_NONE])){
                $url = '/taxonomy/term/' . $node->field_category[LANGUAGE_NONE][0]['tid'];
                $name = $node->field_category[LANGUAGE_NONE][0]['taxonomy_term']->name;

                $crumbs .= '<span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">';
                $crumbs .= ' <a itemprop="url" href="' . $url . '"><span itemprop="title">' . $name . '</span></a>';
                $crumbs .= '</span> &nbsp;|&nbsp; ';
            }
        }
        $crumbs .= '<span itemtype="http://data-vocabulary.org/Breadcrumb" itemscope="">';
        $crumbs .= ' <a itemprop="url" class="current-page"><span itemprop="title">'. drupal_get_title() .'</span></a>';
        $crumbs .= '</span>';

        return $crumbs;
    }
}

function footmali_fboauth_action__connect($variables) {
    $action = $variables['action'];
    $link = $variables['properties'];
    $url = url($link['href'], array('query' => $link['query']));
    $link['attributes']['class'] = isset($link['attributes']['class']) ? $link['attributes']['class'] : 'facebook-action-connect';
    $link['attributes']['rel'] = 'nofollow';
    $attributes = isset($link['attributes']) ? drupal_attributes($link['attributes']) : '';

    $button  = '<a ' . $attributes . ' href="' . $url . '">';
    $button .= '<i class="fa fa-facebook fa-lg"></i> Login in with facebook</a>';

    return $button;
}

function footmali_form_user_login_block_alter(&$form, &$form_state, $form_id){
    $form['name']['#attributes']['placeholder'] = t( 'Username' );
    $form['pass']['#attributes']['placeholder'] = t( 'Password' );

    $form['name']['#attributes']['class'][] = 'form-control';
    $form['pass']['#attributes']['class'][] = 'form-control';
}

function footmali_form_user_register_form_alter(&$form, &$form_state, $form_id){
    $form['account']['name']['#attributes']['placeholder'] = t( 'Username' );
    $form['account']['mail']['#attributes']['placeholder'] = t( 'Email' );
    $form['account']['pass']['pass1']['#attributes']['placeholder'] = t( 'Password' );
    $form['account']['pass']['pass2']['#attributes']['placeholder'] = t( 'Confirm Password' );

    $form['account']['name']['#attributes']['class'][] = 'form-control';
    $form['account']['mail']['#attributes']['class'][] = 'form-control';
    $form['account']['pass']['pass1']['#attributes']['class'][] = 'form-control';
    $form['account']['pass']['pass2']['#attributes']['class'][] = 'form-control';

    //Remove form descriptions
    $form['account']['mail']['#description'] = '';
    $form['account']['name']['#description'] = '';
    $form['account']['pass']['#description'] = '';

    //Custom fields
    //[LANGUAGE_NONE][0]['value']
    $form['field_first_name'][LANGUAGE_NONE][0]['value']['#attributes']['placeholder'] = t( 'First Name' );
    $form['field_last_name'][LANGUAGE_NONE][0]['value']['#attributes']['placeholder'] = t( 'Last Name' );
    $form['field_first_name'][LANGUAGE_NONE][0]['value']['#attributes']['class'][] = 'form-control';
    $form['field_last_name'][LANGUAGE_NONE][0]['value']['#attributes']['class'][] = 'form-control';
}


/*****************************
 *
 * FOOTMALI CUSTOM FUNCTIONS
 *
 *
 *****************************/

/**
 * @param $style
 * @param $imageEntity
 * @return string
 */
function footmali_output_image($style, $imageEntity){

    $variable = array(
        'style_name' => $style,
        'path' => $imageEntity[LANGUAGE_NONE][0]['uri'],
        'width' => $imageEntity[LANGUAGE_NONE][0]['width'],
        'height' => $imageEntity[LANGUAGE_NONE][0]['height'],
    );

    return theme_image_style($variable);
}

function footmali_article_tags(){

}

/**
 * @param $nid
 * @return bool|mixed
 */
function footmali_get_next_article($nid){
    $next_article_query = new EntityFieldQuery();
    $next_article_query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'article')
        ->propertyCondition('status', NODE_PUBLISHED, '=')
        ->propertyCondition('nid', $nid, '>')
        ->range(0, 1)
        ->propertyOrderBy('created', 'ASC');

    $next_article_result = $next_article_query->execute();
    $next_article_id = count($next_article_result) > 0 ? array_keys($next_article_result['node']) : false;

    return $next_article_id ? node_load(current($next_article_id)) : false;
}

/**
 * @param $nid
 * @return bool|mixed
 */
function footmali_get_previous_article($nid){
    $prev_article_query = new EntityFieldQuery();
    $prev_article_query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'article')
        ->propertyCondition('status', NODE_PUBLISHED, '=')
        ->propertyCondition('nid', $nid, '<')
        ->range(0, 1)
        ->propertyOrderBy('created', 'DESC');

    $prev_article_result = $prev_article_query->execute();
    $prev_article_id = count($prev_article_result) ? array_keys($prev_article_result['node']) : false;

    return $prev_article_id ? node_load(current($prev_article_id)) : false;
}

/**
 * @param $tid
 * @return mixed
 */
function footmali_get_category_articles($tid){
    $child_categories = taxonomy_get_children($tid);
    $operator = '=';

    // If child category make an array of all the tids and set operator
    if(count($child_categories) > 0){
        $categories = array($tid);
        $operator = 'IN';

        foreach($child_categories as $category){
            array_push($categories, $category->tid);
        }

        $tid = $categories;
    }

    $articles_query = new EntityFieldQuery();
    $articles_query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'article')
        ->fieldCondition('field_category', 'tid', $tid, $operator)
        ->propertyCondition('status', NODE_PUBLISHED)
        ->range(0, 20)
        ->pager(5)
        ->propertyOrderBy('created', 'DESC');

    $articles_result = $articles_query->execute();
    $articles_ids = count($articles_result) ? array_keys($articles_result['node']) : false;
    return $articles_ids ? node_load_multiple($articles_ids) : false;
}

function footmali_get_tag_articles($tid){
    $child_categories = taxonomy_get_children($tid);
    $operator = '=';

    // If child category make an array of all the tids and set operator
    if(count($child_categories) > 0){
        $categories = array($tid);
        $operator = 'IN';

        foreach($child_categories as $category){
            array_push($categories, $category->tid);
        }

        $tid = $categories;
    }

    $articles_query = new EntityFieldQuery();
    $articles_query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'article')
        ->fieldCondition('field_tags', 'tid', $tid, $operator)
        ->propertyCondition('status', NODE_PUBLISHED)
        ->range(0, 20)
        ->pager(5)
        ->propertyOrderBy('created', 'DESC');

    $articles_result = $articles_query->execute();
    $articles_ids = count($articles_result) ? array_keys($articles_result['node']) : false;
    return $articles_ids ? node_load_multiple($articles_ids) : false;
}

function footmali_get_team_squad($nid){
    $query  = "SELECT nid, node.title name, squad.player_number number, tax.name position, fm.uri image ";
    $query .= "FROM ( ";
    $query .=    "SELECT title, splayer.field_squad_player_nid player_nid, spnumber.field_squad_player_number_value player_number ";
    $query .=    "FROM {node} ";
    $query .=    "JOIN field_data_field_squad_team as steam ON node.nid = steam.entity_id ";
    $query .=    "JOIN field_data_field_squad_players as splayers ON node.nid = splayers.entity_id ";
    $query .=    "JOIN field_data_field_squad_player as splayer ON splayers.field_squad_players_value = splayer.entity_id ";
    $query .=    "JOIN field_data_field_squad_player_number as spnumber ON splayers.field_squad_players_value = spnumber.entity_id ";
    $query .=    "WHERE node.type = 'squad' ";
    $query .=    "AND steam.field_squad_team_nid = :team_id ";
    $query .= ") as squad ";
    $query .= "JOIN node ON node.nid = squad.player_nid ";
    $query .= "JOIN field_data_field_position as pp ON node.nid = pp.entity_id ";
    $query .= "JOIN taxonomy_term_data as tax ON pp.field_position_tid = tax.tid ";
    $query .= "JOIN field_data_field_image as fimg ON node.nid = fimg.entity_id ";
    $query .= "JOIN file_managed as fm ON fimg.field_image_fid = fm.fid ";
    $query .= "WHERE node.type = 'player' ";

    $query_result = db_query($query, array(':team_id' => $nid));

    $squad = array('Gardien' => array(), 'Défenseur' => array(), 'Milieu' => array(), 'Attaquant' => array());

    foreach($query_result as $player){
        switch($player->position){
            case 'Gardien':
                array_push($squad['Gardien'], $player);
                break;
            case 'Défenseur':
                array_push($squad['Défenseur'], $player);
                break;
            case 'Milieu':
                array_push($squad['Milieu'], $player);
                break;
            case 'Attaquant':
                array_push($squad['Attaquant'], $player);
                break;
        }
    }

    return $squad;
}

function footmali_get_entity_articles($nid){
    $query  = "SELECT nid ";
    $query .= "FROM node ";
    $query .= "JOIN field_data_field_more_tags tags ON tags.entity_id = node.nid ";
    $query .= "WHERE node.type = 'article' ";
    $query .= "AND tags.field_more_tags_target_id = :nid ";

    $query_result = db_query($query, array(':nid' => $nid));
    $article_ids = array();

    foreach($query_result as $article_id){

        array_push($article_ids, $article_id->nid);
    }


    $articles = count($article_ids) > 0 ? node_load_multiple($article_ids) : false;

    return $articles;
}

function footmali_get_player_other_squad($nid){
    $query  = "SELECT other_club.field_other_club_nid team, node.nid player ";
    $query .= "FROM node ";
    $query .= "JOIN field_data_field_other_club as other_club ";
    $query .= "ON node.nid = other_club.entity_id ";
    $query .= "WHERE node.type = 'player' ";
    $query .= "AND node.nid = :nid ";

    $query_result = db_query($query, array(':nid' => $nid));
    $squad_id = '';

    foreach($query_result as $result){
        $squad_id = $result->team;
    }

    $squad = !empty($squad_id) ?  node_load($squad_id) : false;

    return $squad;
}

function footmali_get_player_squad($nid){
    $query  = "SELECT YEAR(season.field_season_value) season, steam.field_squad_team_nid team, splayer.field_squad_player_nid player ";
    $query .= "FROM node ";
    $query .= "JOIN field_data_field_squad_team as steam ";
    $query .= "ON node.nid = steam.entity_id ";
    $query .= "JOIN field_data_field_team_type as team_type ";
    $query .= "ON steam.field_squad_team_nid = team_type.entity_id ";
    $query .= "JOIN field_data_field_squad_players as splayers ";
    $query .= "ON node.nid = splayers.entity_id ";
    $query .= "JOIN field_data_field_squad_player as splayer ";
    $query .= "ON splayers.field_squad_players_value = splayer.entity_id ";
    $query .= "JOIN field_data_field_season as season ";
    $query .= "ON node.nid = season.entity_id ";
    $query .= "WHERE node.type = 'squad' ";
    $query .= "AND splayer.field_squad_player_nid = :nid ";
    $query .= "AND team_type.field_team_type_value = 'club' ";
    $query .= "ORDER BY YEAR(season.field_season_value) DESC ";
    $query .= "LIMIT 1";

    $query_result = db_query($query, array(':nid' => $nid));
    $squad_id = '';

    foreach($query_result as $result){
        $squad_id = $result->team;
    }

    $squad = !empty($squad_id) ?  node_load($squad_id) : false;

    if(!$squad){
        $squad = footmali_get_player_other_squad($nid);
    }

    return $squad;
}
