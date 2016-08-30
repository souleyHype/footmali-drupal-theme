<?php
$standings = footmali_get_standings('2015-2016');
?>

<?php if($standings && count($standings) > 0): ?>
  <div class="widget-area-11">
      <div class="widget kopa-charts-widget">
          <h3 class="widget-title style16"><span><?php echo t('standings table'); ?></span></h3>
          <div class="widget-content">
              <h3 class="widget-title style17">Poule A</h3>
              <header>
                  <div class="t-col"><?php echo t('Pos'); ?></div>
                  <div class="t-col width1"><?php echo t('Équipe'); ?></div>
                  <div class="t-col"><?php echo t('J.'); ?></div>
                  <div class="t-col"><?php echo t('Pts'); ?></div>
              </header>
              <ul class="clearfix">
                <?php $index = 1;
                    foreach ($standings['pouleA'] as $points => $row): ?>
                        <?php if($index > 5){ break; } ?>
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
              <a class="kopa-view-all" href="/league1">Voir tout<span class="fa fa-chevron-right"></span></a>
          </div>
          <div class="widget-content">
              <h3 class="widget-title style17">Poule B</h3>
              <header>
                  <div class="t-col"><?php echo t('pos'); ?></div>
                  <div class="t-col width1"><?php echo t('team'); ?></div>
                  <div class="t-col"><?php echo t('p'); ?></div>
                  <div class="t-col"><?php echo t('pts'); ?></div>
              </header>
              <ul class="clearfix">
                <?php $index = 1;
                    foreach ($standings['pouleB'] as $points => $row): ?>
                        <?php if($index > 5){ break; } ?>
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
              <a class="kopa-view-all" href="/league1">Voir tout<span class="fa fa-chevron-right"></span></a>
          </div>
      </div>
      <!-- widget -->
  </div>
  <!-- widget-area-13 -->
<?php endif; ?>
