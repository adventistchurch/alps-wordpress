<?php
  $menu_args = array(
    'echo' => false,
    'menu_class' => 'footer-nav__list',
    'container' => false,
    'depth' => 1,
    'theme_location' => 'footer_secondary_navigation',
  );

  // Native WordPress menu classes to be replaced.
  $replace = array(
    'menu-item',
    '<a'
  );

  // Custom ALPS classes to replace.
  $replace_with = array(
    'footer__nav-item inline-list__item',
    '<a class="footer__nav-link font--secondary link--white" '
  );
?>
<?php if (has_nav_menu('footer_secondary_navigation')): ?>
  <nav class="footer__nav">
    <?php echo str_replace($replace, $replace_with, wp_nav_menu($menu_args)); ?>
  </nav>
<?php endif; ?>
