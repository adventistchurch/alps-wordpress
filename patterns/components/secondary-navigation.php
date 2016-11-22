<?php
  $menu_args = array(
    'echo' => false,
    'menu_class' => 'secondary-nav__list',
    'container' => false,
    'depth' => 2,
    'theme_location' => 'secondary_navigation',
  );

  // Native WordPress menu classes to be replaced.
  // Native WordPress menu classes to be replaced.
  $replace = array(
    'menu-item ',
    'sub-menu',
    'current-menu-item',
    'menu-item-has-children',
    '<a'
  );

  // Custom ALPS classes to replace.
  $replace_with = array(
    'secondary-nav__list-item rel ',
    'secondary-nav__subnav__list',
    'active',
    'secondary-nav--with-subnav js-hover',
    '<a class="secondary-nav__link theme--secondary-text-color" '
  );
?>
<?php if (has_nav_menu('secondary_navigation')): ?>
  <nav class="secondary-nav toggled-element" id="secondary-nav" role="navigation">
    <?php echo str_replace($replace, $replace_with, wp_nav_menu($menu_args)); ?>
  </nav>
<?php endif; ?>
