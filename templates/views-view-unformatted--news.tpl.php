<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<div class="widget kopa-article-list-widget article-list-1">
    &nbsp;
    <ul>
        <?php foreach ($rows as $id => $row): ?>
            <li<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
                <?php print $row; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
