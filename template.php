<?php

require_once 'lib/Mobile-Detect/Mobile_Detect.php';

/**
 *Override or insert variables into the html template.
 */
function footmali_preprocess_html(&$variables) {

	// Add more info to page title
	if(!drupal_is_front_page()){
		$variables['head_title']  = $variables['head_title'];
		$variables['head_title'] .=' - Les actualités du football malien, les aigles du mali, et la femafoot - Footmali.com';
	}else{
		$variables['head_title'] = "Footmali.com - Toute l'actualité du football malien en direct : les aigles du Mali et le championnat malien - Femafoot";
	}

	// Add additional class to identify mobile view
    if(footmali_ismobile()){
        array_push($variables['classes_array'], 'mobile-view');
    }

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

function footmali_js_alter(&$javascript){
    // if(footmali_ismobile()){
    //     unset($javascript['sites/all/themes/footmali-drupal-theme/js/custom.js']);
    // }else{
    //     unset($javascript['sites/all/themes/footmali-drupal-theme/js/custom-mobile.js']);
    // }
}

function footmali_css_alter(&$css) {
    global $user;
    unset($css[drupal_get_path('module','system').'/system.theme.css']);

    // Remove unesscessary css.
    //if(footmali_ismobile()){
        unset($css[drupal_get_path('module','views').'/css/views.css']);

        unset($css[drupal_get_path('module','node').'/node.css']);
        unset($css[drupal_get_path('module','field').'/theme/field.css ']);
    //}

    if(!$user->uid){
        unset($css[drupal_get_path('module','system').'/system.base.css']);
        unset($css[drupal_get_path('module','system').'/system.menus.css']);
        unset($css[drupal_get_path('module','system').'/system.messages.css']);
        unset($css[drupal_get_path('module','date').'/date_popup/themes/datepicker.1.7.css']);
        unset($css[drupal_get_path('module','node_embed').'/plugins/node_embed/node_embed.css']);
        unset($css[drupal_get_path('module','ctools').'/css/ctools.css']);
        unset($css[drupal_get_path('module','date').'/date_api/date.css']);
    }
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
                    $main_links .= '<li><a href="/' . drupal_get_path_alias($sub_menu['link']['link_path'])  . '">' . $sub_menu['link']['link_title'] . '</a></li>';
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
    $form['name']['#attributes']['placeholder'] = t('Username or e-mail address');
    $form['pass']['#attributes']['placeholder'] = t( 'Password' );

    $form['name']['#title'] = t('Username or e-mail address');
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
    $form['field_first_name'][LANGUAGE_NONE][0]['value']['#title'] = t( 'First Name' );
    $form['field_last_name'][LANGUAGE_NONE][0]['value']['#title'] = t( 'Last Name' );
    $form['field_first_name'][LANGUAGE_NONE][0]['value']['#attributes']['placeholder'] = t( 'First Name' );
    $form['field_last_name'][LANGUAGE_NONE][0]['value']['#attributes']['placeholder'] = t( 'Last Name' );
    $form['field_first_name'][LANGUAGE_NONE][0]['value']['#attributes']['class'][] = 'form-control';
    $form['field_last_name'][LANGUAGE_NONE][0]['value']['#attributes']['class'][] = 'form-control';

    $form['field_newsletter_subscribe'][LANGUAGE_NONE][0]['#type'] = '';
    $form['field_newsletter_subscribe'][LANGUAGE_NONE][0]['#title'] = t( 'Abonnez' );
    $form['field_newsletter_subscribe'][LANGUAGE_NONE][0]['subscribe']['#title'] = t( 'Subscribe to our newsletter' );
}

function footmali_form_contact_site_form_alter(&$form, &$form_state, &$form_id){
    $form['name']['#attributes']['class'][] = 'form-control';
    $form['mail']['#attributes']['class'][] = 'form-control';
    $form['subject']['#attributes']['class'][] = 'form-control';
    $form['cid']['#attributes']['class'][] = 'form-control';
    $form['message']['#attributes']['class'][] = 'form-control';
}

function footmali_preprocess_views_view(&$vars){
    $view = $vars['view'];
    $vars['results'] = $view->result;
}


/*****************************
 *
 * FOOTMALI CUSTOM FUNCTIONS
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

function footmali_featured_articles(){
    $articles_query = new EntityFieldQuery();
    $articles_query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'article')
        ->propertyCondition('status', NODE_PUBLISHED)
        ->fieldCondition('field_featured', 'value', '1', '=')
        ->range(0, 5)
        ->propertyOrderBy('created', 'DESC');

    $articles = array();

    $articles_result = $articles_query->execute();
    if( !empty($articles_result) && is_array($articles_result) ){
        $articles_ids = array_keys($articles_result['node']);
        $articles = node_load_multiple($articles_ids);
    }

    return $articles;
}

function footmali_top_articles(){
  $cid = 'footmali_top_articles';
  $bin = 'cache';

  if ($cached = cache_get($cid, $bin)) {
      $query_result = $cached->data;

      return $query_result;
  }else {
    $articles_query  = "SELECT DISTINCT n.nid, n.title, c.totalcount ";
    $articles_query .= "FROM node n left join node_counter c on n.nid = c.nid ";
    $articles_query .= "WHERE n.status = 1 ";
    $articles_query .= "AND DATE_SUB(CURDATE(),INTERVAL 15 DAY) <= DATE_FORMAT(FROM_UNIXTIME(n.created), '%Y-%c-%d') ";
    $articles_query .= "AND c.totalcount >= 1 and title not like '%page not found%' ";
    $articles_query .= "ORDER BY c.totalcount desc, n.created desc ";
    $articles_query .= "LIMIT 3 ";

    $articles = array();
    $articles_result = db_query($articles_query)->fetchAllAssoc('nid');
    if( !empty($articles_result) && is_array($articles_result) ){
        $articles_ids = array_keys($articles_result);
        $articles = node_load_multiple($articles_ids);
    }

    cache_set($cid, $articles, $bin, CACHE_TEMPORARY);
    return $articles;
  }
}

function footmali_headline_articles(){
  $cid = 'footmali_headline_articles';
  $bin = 'cache';

  if ($cached = cache_get($cid, $bin)) {
      $query_result = $cached->data;

      return $query_result;
  }else {
    $articles_query  = "SELECT DISTINCT n.nid, n.title ";
    $articles_query .= "FROM node n left join field_data_field_featured f on n.nid = f.entity_id ";
    $articles_query .= "WHERE n.status = 1 ";
    $articles_query .= "AND n.type = 'article' ";
    $articles_query .= "AND f.field_featured_value IS NULL OR f.field_featured_value = 0 ";
    $articles_query .= "ORDER BY n.created DESC ";
    $articles_query .= "LIMIT 10 ";

    $articles = array();
    $articles_result = db_query($articles_query)->fetchAllAssoc('nid');
    if( !empty($articles_result) && is_array($articles_result) ){
        $articles_ids = array_keys($articles_result);
        $articles = node_load_multiple($articles_ids);
    }

    cache_set($cid, $articles, $bin, CACHE_TEMPORARY);
    return $articles;
  }
}

function footmali_popular_articles(){
  $cid = 'footmali_popular_articles';
  $bin = 'cache';

  if ($cached = cache_get($cid, $bin)) {
      $query_result = $cached->data;

      return $query_result;
  }else {
    $articles_query  = "SELECT DISTINCT n.nid, n.title, c.totalcount ";
    $articles_query .= "FROM node n left join node_counter c on n.nid = c.nid ";
    $articles_query .= "WHERE n.status = 1 ";
    $articles_query .= "AND n.type = 'article' ";
    $articles_query .= "AND c.totalcount >= 1 ";
    $articles_query .= "ORDER BY c.totalcount desc, n.created desc ";
    $articles_query .= "LIMIT 10 ";

    $articles = array();
    $articles_result = db_query($articles_query)->fetchAllAssoc('nid');
    if( !empty($articles_result) && is_array($articles_result) ){
        $articles_ids = array_keys($articles_result);
        $articles = node_load_multiple($articles_ids);
    }

    cache_set($cid, $articles, $bin);
    return $articles;
  }
}

function footmali_mobile_articles(){
    $articles_query = new EntityFieldQuery();
    $articles_query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'article')
        ->propertyCondition('status', NODE_PUBLISHED)
        ->propertyOrderBy('created', 'DESC')
        ->pager(15);

    $articles = array();

    $articles_result = $articles_query->execute();
    if( !empty($articles_result) && is_array($articles_result) ){
        $articles_ids = array_keys($articles_result['node']);
        $articles = node_load_multiple($articles_ids);
    }

    return $articles;
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

function footmali_get_videos($limit=5){
    $articles_query = new EntityFieldQuery();
    $articles_query->entityCondition('entity_type', 'node')
        ->entityCondition('bundle', 'video')
        ->propertyCondition('status', NODE_PUBLISHED)
        ->range(0, $limit)
        ->propertyOrderBy('created', 'DESC');

    $articles = array();

    $articles_result = $articles_query->execute();
    if( !empty($articles_result) && is_array($articles_result) ){
        $articles_ids = array_keys($articles_result['node']);
        $articles = node_load_multiple($articles_ids);
    }

    return $articles;
}

function footmali_get_team_squad($nid){
  $cid = 'footmali_get_team_squad:'.$nid;
  $bin = 'cache';

  if ($cached = cache_get($cid, $bin)) {
      $squad = $cached->data;

      return $squad;
  }else {
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
    $query .= "LEFT JOIN field_data_field_image as fimg ON node.nid = fimg.entity_id ";
    $query .= "LEFT JOIN file_managed as fm ON fimg.field_image_fid = fm.fid ";
    $query .= "WHERE node.type = 'player' ";

    $query_result = db_query($query, array(':team_id' => $nid))->fetchAll();
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
    cache_set($cid, $squad, $bin);
    return $squad;
  }
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
    $query  = "SELECT season.field_season_value season, steam.field_squad_team_nid team, splayer.field_squad_player_nid player ";
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
    $query .= "ORDER BY season.field_season_value DESC ";
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

function footmali_get_matches($season, $type){
    $cid = 'footmali_get_matches:'.$type;
    $bin = 'cache';

    if ($cached = cache_get($cid, $bin)) {
        $query_result = $cached->data;

        return $query_result;
    }else {
        $query  = "SELECT n.nid, s.field_season_value as season, mstatus.field_match_played_value as matchstatus, ";
        $query .= "DATE_FORMAT(mdate.field_date_time_value, '%d/%m/%y %Hh%i') as date, hteam.field_home_team_nid as hometeam, ";
        $query .= "hscore.field_home_team_score_value as goalsfor, ascore.field_away_team_score_value as goalsagainst, ";
        $query .= "ateam.field_away_team_nid as awayteam, tcompetition.name as competition, tround.name as round ";
        $query .= "FROM node as n ";
        $query .= "JOIN field_data_field_season as s ON n.nid = s.entity_id ";
        $query .= "JOIN field_data_field_home_team as hteam ON n.nid = hteam.entity_id ";
        $query .= "JOIN field_data_field_home_team_score as hscore ON n.nid = hscore.entity_id ";
        $query .= "JOIN field_data_field_away_team as ateam ON n.nid = ateam.entity_id ";
        $query .= "JOIN field_data_field_away_team_score as ascore ON n.nid = ascore.entity_id ";
        $query .= "JOIN field_data_field_date_time as mdate On n.nid = mdate.entity_id ";
        $query .= "JOIN field_data_field_match_played as mstatus ON n.nid = mstatus.entity_id ";

        $query .= "JOIN field_data_field_competition as mcompetition ON n.nid = mcompetition.entity_id ";
        $query .= "JOIN taxonomy_term_data as tcompetition ON mcompetition.field_competition_target_id = tcompetition.tid ";
        $query .= "JOIN field_data_field_country as country ON tcompetition.tid = country.entity_id ";

        $query .= "JOIN field_data_field_competition_round as mround ON n.nid = mround.entity_id ";
        $query .= "JOIN taxonomy_term_data as tround ON mround.field_competition_round_target_id = tround.tid ";
        $query .= "WHERE n.type = 'fixture' ";
        $query .= "AND country.field_country_value = 'Mali' ";
        $query .= "AND tcompetition.name = 'League 1' ";
        $query .= "AND s.field_season_value = :season ";
        $query .= "AND mstatus.field_match_played_value = :type ";
        if($type === 1){ //result
          $query .= "ORDER BY tround.name DESC, mdate.field_date_time_value DESC ";
        }else { //fixture
          $query .= "ORDER BY tround.name ASC, mdate.field_date_time_value DESC ";
        }
        $query .= "LIMIT 10";
        $query_result = db_query($query, array(':season' => $season, ':type' => $type))->fetchAllAssoc('nid');

        $expire = strtotime("+4 days", time());
        cache_set($cid, $query_result, $bin, $expire);
        return $query_result;
    }
}

function footmali_get_standings($season, $limit=false){
  $cid = 'footmali_get_standings';
  $bin = 'cache';

  if ($cached = cache_get($cid, $bin)) {
      $query_result = $cached->data;

      return $query_result;
  }else {
    $fixture_query  = "SELECT n.nid, s.field_season_value as season, ";
    $fixture_query .= "hteam.field_home_team_nid as hometeam, ";
    $fixture_query .= "hscore.field_home_team_score_value as goalsfor, ";
    $fixture_query .= "ascore.field_away_team_score_value as goalsagainst, ";
    $fixture_query .= "ateam.field_away_team_nid as awayteam, ";
	$fixture_query .= "tgroup.name as pool ";
    $fixture_query .= "FROM node as n ";
    $fixture_query .= "JOIN field_data_field_season as s ON n.nid = s.entity_id ";
    $fixture_query .= "JOIN field_data_field_home_team as hteam ON n.nid = hteam.entity_id ";
    $fixture_query .= "JOIN field_data_field_home_team_score as hscore ON n.nid = hscore.entity_id ";
    $fixture_query .= "JOIN field_data_field_away_team as ateam ON n.nid = ateam.entity_id ";
    $fixture_query .= "JOIN field_data_field_away_team_score as ascore ON n.nid = ascore.entity_id ";
    $fixture_query .= "JOIN field_data_field_match_played as mstatus ON n.nid = mstatus.entity_id ";

    $fixture_query .= "JOIN field_data_field_competition as mcompetition ON n.nid = mcompetition.entity_id ";
    $fixture_query .= "JOIN taxonomy_term_data as tcompetition ON mcompetition.field_competition_target_id = tcompetition.tid ";
    $fixture_query .= "JOIN field_data_field_country as country ON tcompetition.tid = country.entity_id ";
	$fixture_query .= "JOIN field_data_field_competition_group as mgroup ON n.nid = mgroup.entity_id ";
	$fixture_query .= "JOIN taxonomy_term_data as tgroup ON mgroup.field_competition_group_target_id = tgroup.tid ";
    $fixture_query .= "WHERE n.type = 'fixture' ";
    $fixture_query .= "AND country.field_country_value = 'Mali' ";
    $fixture_query .= "AND tcompetition.name = 'League 1' ";
    $fixture_query .= "AND mstatus.field_match_played_value = 1 ";
    $fixture_query .= "AND s.field_season_value = :season ";

    $query  = "SELECT pool, team, count(*) played, ";
    $query .= "count(case when goalsfor > goalsagainst then 1 end) wins, ";
    $query .= "count(case when goalsagainst > goalsfor then 1 end) lost, ";
    $query .= "count(case when goalsfor = goalsagainst then 1 end) draws, ";
    $query .= "sum(goalsfor) goalsfor, ";
    $query .= "sum(goalsagainst) goalsagainst, ";
    $query .= "sum(goalsfor) - sum(goalsagainst) goal_diff, ";
    $query .= "sum( ";
    $query .= "case when goalsfor > goalsagainst then 3 else 0 end ";
    $query .= "+ case when goalsfor = goalsagainst then 1 else 0 end ";
    $query .= ") points ";
    $query .= "FROM ( ";
    $query .=   "SELECT a.hometeam team, a.goalsfor, a.goalsagainst, a.pool FROM ( ";
    $query .=       "($fixture_query) a ";
    $query .=   ")  ";
    $query .=   "UNION ALL ";
    $query .=   "SELECT b.awayteam, b.goalsagainst, b.goalsfor, b.pool FROM ( ";
    $query .=       "($fixture_query) b ";
    $query .=   ") ";
    $query .= ") AS results ";

    $query .= "GROUP BY team ";
    $query .= "ORDER BY pool ASC, points DESC, goal_diff DESC ";
    if($limit){
		$query .= "LIMIT {$limit}";
	}

    $query_result = db_query($query, array(':season' => $season))->fetchAll();
	$returnArray = array();

	foreach ($query_result as $standing){
		if($standing->pool === "Poule A"){
			$returnArray['pouleA'][] = $standing;
		}else {
			$returnArray['pouleB'][] = $standing;
		}
	}

    $expire = strtotime("+4 days", time());
    cache_set($cid, $returnArray, $bin, $expire);
    return $returnArray;
  }
}

function footmali_node_share($nid, $title){
    global $language;
    $lang = $language->language === 'en' ? 'en-US' : $language->language;

    $url = url(drupal_get_path_alias("node/".$nid), array('absolute'=>true));
    $twitter_url  = 'https://twitter.com/intent/tweet?';
    $twitter_url .= 'text=' . urlencode($title);
    $twitter_url .= '&url=' . urlencode($url);
    $twitter_url .= '&hashtags=footballMalien,footMali,maliFootball';
    $twitter_url .= '&via=FOOTMALICOM';
    $google_url = "https://plus.google.com/share?url=" . urlencode($url) ."&hl=" . $lang;
    $google_onlick = "javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;";

    return (object) array(
        'lang' => $lang,
        'url' => $url,
        'facebook_url' => $url,
        'twitter_url' => $twitter_url,
        'google_url' => $google_url,
        'google_onclick' => $google_onlick,
    );
}

function footmali_render_share_normal($nid, $title){
    $share = footmali_node_share($nid, $title);

    $output   = '<div class="kopa-share-post social-links style-bg-color">';
    $output  .= '    <ul class="clearfix">';
    $output  .= '        <li><a href="javascript:void" data-url="'. $share->url .'" class="fa fa-facebook facebook-share"></a></li>';
    $output  .= '        <li><a href="'. $share->twitter_url .'" class="fa fa-twitter"></a></li>';
    $output  .= '        <li><a href="'. $share->google_url .'" class="fa fa-google-plus" onclick="'. $share->google_onclick .'" alt="Share on Google+"></a></li>';
    $output  .= '    </ul>';
    $output  .= '</div>';

    return $output;
}

function footmali_render_share_small($nid, $title){
    $share = footmali_node_share($nid, $title);

    $output  = '<div class="post-share-link closed style-bg-color">';
    $output .= '<span><i class="fa fa-share-alt"></i></span>';
    $output .= '<ul>';
    $output .= '<li><a href="javascript:void" data-url="'. $share->url .'" class="fa fa-facebook facebook-share"></a></li>';
    $output .= '<li><a href="'. $share->twitter_url .'" class="fa fa-twitter"></a></li>';
    $output .= '<li><a href="'. $share->google_url .'" class="fa fa-google-plus" onclick="'. $share->google_onclick .'" alt="Share on Google+"></a></li>';
    $output .= '</ul>';
    $output .= '</div>';

    return $output;
}

function footmali_get_article_published_date($node){
  $published_on  = 'Le ' . date('d/m/Y', $node->created);
  $published_on .= $node->created != $node->changed ? ' | Mis à jour le ' . date('d/m/Y', $node->changed) : '';

  return $published_on;
}

function footmali_get_article_author($node){
  $author_data = user_load($node->uid);
  $author = $node->name;
  if(isset($author_data->field_first_name) && isset($author_data->field_last_name)){
      $author = field_get_items('user', $author_data, 'field_first_name')[0]['value'] . ' ';
      $author .= field_get_items('user', $author_data, 'field_last_name')[0]['value'];
  }

  return $author;
}

/*****************************
 *
 * FOOTMALI Helper FUNCTIONS
 *
 *****************************/
function footmali_trim_paragraph($string, $your_desired_width) {
    $string = strip_tags($string);
    $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
    $parts_count = count($parts);

    $length = 0;
    $last_part = 0;
    for (; $last_part < $parts_count; ++$last_part) {
        $length += strlen($parts[$last_part]);
        if ($length > $your_desired_width) { break; }
    }

    return implode(array_slice($parts, 0, $last_part));
}

function footmali_ismobile(){
    $detect = new Mobile_Detect;
    return ($detect->isMobile() && !$detect->isTablet());
}

function footmali_squad_position_sort($a, $b){
    $positions = array(
      'gardien' => 0,
      'défenseur' => 1,
      'milieu' => 2,
      'attaquant' => 3
    );
    return $positions[strtolower($a->position)] - $positions[strtolower($b->position)];
}
