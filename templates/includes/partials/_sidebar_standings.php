<?php
$standings = footmali_get_standings('2015-2016');
?>

<?php if($standings && count($standings) > 0): ?>
  <div class="widget-area-11">
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
