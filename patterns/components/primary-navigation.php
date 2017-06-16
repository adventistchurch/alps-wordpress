<?php
  global $post;
  $post_id = $post->ID;
  $menu_name = 'primary_navigation';
  $locations = get_nav_menu_locations();
  $menu = wp_get_nav_menu_object($locations[$menu_name]);
  $menuitems = wp_get_nav_menu_items($menu->term_id, array( 'order' => 'DESC' ));
?>
<nav class="primary-nav toggled-element" id="primary-nav" role="navigation" data-active-target="primary-nav">
  <ul class="primary-nav__list">
    <?php
      $count = 0;
      $submenu = false;
      foreach ($menuitems as $item):
        $link = $item->url;
        $title = $item->title;
        if ($post_id == $item->object_id) {
          $classes = ' theme--secondary-text-color active';
        } else {
          $classes = ' theme--primary-text-color';
        }
        // item does not have a parent so menu_item_parent equals 0 (false)
        if (!$item->menu_item_parent):

        // save this id for later comparison with sub-menu items
        $parent_id = $item->ID;
      ?>
        <li class="primary-nav__list-item">
          <a href="<?php echo $link; ?>" class="primary-nav__link<?php echo $classes; ?>">
            <?php echo $title; ?>
          </a>
      <?php endif; ?>
        <?php if ($parent_id == $item->menu_item_parent): ?>
          <?php if (!$submenu): $submenu = true; ?>
            <div class="primary-nav__subnav__arrow va--middle js-toggle-parent"><span class="arrow--down"></span></div>
            <ul class="primary-nav__subnav">
            <?php endif; ?>
              <li class="primary-nav__subnav__list-item">
                <a href="<?php echo $link; ?>" class="primary-nav__subnav__link<?php echo $classes; ?>"><?php echo $title; ?></a>
              </li>
            <?php if (!isset($menuitems[$count + 1]) || $menuitems[$count + 1]->menu_item_parent != $parent_id && $submenu): ?>
            </ul>
          <?php $submenu = false; endif; ?>
        <?php endif; ?>
      <?php if (!isset($menuitems[$count + 1]) || $menuitems[$count + 1]->menu_item_parent != $parent_id): ?>
        </li>
      <?php $submenu = false; endif; ?>
    <?php $count++; endforeach; ?>
  </ul>
</nav>
