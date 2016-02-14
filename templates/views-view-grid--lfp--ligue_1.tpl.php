<?php

/**
 * @file
 * Default simple view template to display a rows in a grid.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<div class="row <?php print $class; ?>">
  <?php foreach ($columns as $column_number => $item): ?>
    <?php
      $extra_class = '';
      if ($column_classes[$row_number][$column_number]){
        $extra_class = $column_classes[$row_number][$column_number];
      }?>
    ?>
    <div class="col-sm-6 col-md-4 <?php print($extra_class); ?>">
      <?php print $item; ?>
  </div>
  <?php endforeach; ?>
</div>
