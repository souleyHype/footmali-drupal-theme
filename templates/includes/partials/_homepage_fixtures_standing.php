<?php
global $theme_path;
$default_team_logo = '/' . $theme_path . '/images/default_club_logo.png';
$team_logo = '<img src="' . $default_team_logo .'" width="90px" height="90px">';

$fixtures = footmali_get_matches('2015-2016', 0);
$results = footmali_get_matches('2015-2016', 1);
$standings = footmali_get_standings('2015-2016');

?>

<section class="kopa-area kopa-area-1 mb-30">
    <span class="t1"></span>
    <span class="t2"></span>
     <div class="content-wrap">
        <div class="row">
            <div class="widget-area-12">
				<?php if($results && count($results) > 0): ?>
			    <div class="widget kopa-result-widget">
			        <h3 class="widget-title style6"><?php echo t('Latest Results'); ?> </h3>
			        <div class="widget-content">
			            <div class="span-bg">
			                <span class="c-tg"></span>
			            </div>
			            <div class="owl-carousel owl-carousel-2">
			            	<?php foreach ($results as $result): ?>
			            		<?php

			            			$home_team = node_load($result->hometeam);
			            			$away_team = node_load($result->awayteam);

									$home_team_short_name = !empty($home_team->field_short_name) ? $home_team->field_short_name[LANGUAGE_NONE][0]['value'] : $home_team->title;
									$away_team_short_name = !empty($away_team->field_short_name) ? $away_team->field_short_name[LANGUAGE_NONE][0]['value'] : $away_team->title;

			            			$home_team_score = $result->goalsfor;
			            			$away_team_score = $result->goalsagainst;

			            			$match_date = $result->date;
			            			$round = $result->round;

			            		?>
				                <div class="item">
				                    <div class="r-item">
				                        <a class="r-num" href="/<?php echo drupal_get_path_alias('node/' . $result->nid); ?>">
				                            <span class="<?php echo $home_team_score > $away_team_score ? 'r-color' : ''; ?>">
				                            	<?php echo $home_team_score; ?>
				                            </span>
				                            <span>-</span>
				                            <span class="<?php echo $away_team_score > $home_team_score ? 'r-color' : ''; ?>">
				                            	<?php echo $away_team_score; ?>
				                            </span>
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
				                                <!-- <p>Sanchen (27 pen), Sanobo (78)</p> -->
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
				                                <h5><?php echo strlen($away_team->title) < 15 ? $away_team->title : $home_team_short_name; ?></h5>
				                                <!-- <p>K. Benny (78)</p> -->
				                            </div>
				                        </a>
				                        <p><b><?php echo $round; ?>: </b><?php echo $match_date; ?></p>
				                    </div>
				                </div>
				                <!-- item -->
			            	<?php endforeach; ?>
			            </div>
			            <!-- owl-carousel-2 -->
			        </div>
			    </div>
			    <!-- widget -->
				<?php endif; ?>

				<?php if($fixtures  && count($fixtures) > 0): ?>
			    <div class="widget kopa-fixture-widget">
			        <h3 class="widget-title style6"><?php echo t('Upcoming Games'); ?></h3>
			        <div class="widget-content">
			            <div class="owl-carousel owl-carousel-2">
			            	<?php foreach ($fixtures as $fixture): ?>
			            		<?php
			            			$home_team = node_load($fixture->hometeam);
			            			$away_team = node_load($fixture->awayteam);

									$home_team_short_name = !empty($home_team->field_short_name) ? $home_team->field_short_name[LANGUAGE_NONE][0]['value'] : $home_team->title;
									$away_team_short_name = !empty($away_team->field_short_name) ? $away_team->field_short_name[LANGUAGE_NONE][0]['value'] : $away_team->title;

			            			$home_team_score = $fixture->goalsfor;
			            			$away_team_score = $fixture->goalsagainst;

			            			$match_date = $fixture->date;
			            			$round = $fixture->round;
			            		?>
				                <div class="item">
				                    <div class="r-item">
				                        <a class="r-num" href="/<?php echo drupal_get_path_alias('node/' . $fixture->nid); ?>">
				                            <span>-</span>
				                            <span>vs</span>
				                            <span>-</span>
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
				                            </div>
				                        </a>
				                        <p><b><?php echo $round; ?>: </b><?php echo $match_date; ?></p>
				                    </div>
				                </div>
				                <!-- item -->
				            <?php endforeach; ?>
			            </div>
			            <!-- owl-carousel-3 -->
			        </div>
			    </div>
			    <!-- widget -->
				<?php endif; ?>
			</div>
			<!-- widget-area-12 -->

			<?php if($standings && count($standings) > 0): ?>
				<div class="widget-area-13">
				    <div class="widget kopa-charts-widget">
				        <h3 class="widget-title style7"><span><?php echo t('standings table'); ?></span></h3>
				        <div class="widget-content">
				            <header>
				                <div class="t-col"><?php echo t('pos'); ?></div>
				                <div class="t-col width1"><?php echo t('team'); ?></div>
				                <div class="t-col"><?php echo t('p'); ?></div>
				                <div class="t-col"><?php echo t('pts'); ?></div>
				            </header>
				            <ul class="clearfix">
				            	<?php $index = 1; 
                        foreach ($standings as $points => $row): ?>
				            		<?php
				            			$team = node_load($row->team);
				            			$team_short_name = !empty($team->field_short_name) ? $team->field_short_name[LANGUAGE_NONE][0]['value'] : $team->title;
				            		?>
				                <li>
				                    <div class="t-col"><?php echo $index; ?></div>
				                    <div class="t-col width1"><?php echo strlen($team->title) < 15 ? $team->title : $team_short_name; ?></div>
				                    <div class="t-col"><?php echo $row->played; ?></div>
				                    <div class="t-col"><?php echo $row->points; ?></div>
				                </li>
				            	<?php $index++; endforeach; ?>
				            </ul>
				            <!-- <a class="kopa-view-all" href="">View all<span class="fa fa-chevron-right"></span></a> -->
				        </div>
				    </div>
				    <!-- widget -->
				</div>
				<!-- widget-area-13 -->
			<?php endif; ?>
        </div>
     </div>
</section>
<!-- kopa-area-1 -->
