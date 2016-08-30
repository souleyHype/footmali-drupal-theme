<?php
$standings = footmali_get_standings('2015-2016');
?>

<?php if($standings && count($standings) > 0): ?>
<div class="widget kopa-team-widget kopa-charts-widget">
    <h3 class="widget-title style15"><?php echo t('standings table'); ?></h3>
    <div class="widget-content">
        <h3 class="widget-title style8">Poule A</h3>
        <header>
            <div class="t-col"><?php echo t('pos'); ?></div>
            <div class="t-col width1"><?php echo t('team'); ?></div>
            <div class="t-col"><?php echo t('p'); ?></div>
            <div class="t-col"><?php echo t('pts'); ?></div>
        </header>
        <ul class="clearfix">
          <?php $i1 = 1;
              foreach ($standings['pouleA'] as $points => $row): ?>
                  <?php
                      $team = node_load($row->team);
                      $team_short_name = !empty($team->field_short_name) ? $team->field_short_name[LANGUAGE_NONE][0]['value'] : $team->title;
                      ?>
                  <li>
                      <div class="t-col"><?php echo $i1; ?></div>
                      <div class="t-col width1"><?php echo strlen($team->title) < 15 ? $team->title : $team_short_name; ?></div>
                      <div class="t-col"><?php echo $row->played; ?></div>
                      <div class="t-col"><?php echo $row->points; ?></div>
                  </li>
              <?php $i1++; endforeach; ?>
        </ul>
    </div>
    <div class="widget-content">
        <h3 class="widget-title style8">Poule B</h3>
        <header>
            <div class="t-col"><?php echo t('pos'); ?></div>
            <div class="t-col width1"><?php echo t('team'); ?></div>
            <div class="t-col"><?php echo t('p'); ?></div>
            <div class="t-col"><?php echo t('pts'); ?></div>
        </header>
        <ul class="clearfix">
          <?php $i2 = 1;
              foreach ($standings['pouleB'] as $points => $row): ?>
                  <?php
                      $team = node_load($row->team);
                      $team_short_name = !empty($team->field_short_name) ? $team->field_short_name[LANGUAGE_NONE][0]['value'] : $team->title;
                  ?>
                  <li>
                      <div class="t-col"><?php echo $i2; ?></div>
                      <div class="t-col width1"><?php echo strlen($team->title) < 15 ? $team->title : $team_short_name; ?></div>
                      <div class="t-col"><?php echo $row->played; ?></div>
                      <div class="t-col"><?php echo $row->points; ?></div>
                  </li>
              <?php $i2++; endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>
