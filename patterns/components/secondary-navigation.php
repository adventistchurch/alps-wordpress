<?php if (has_nav_menu('secondary_navigation')): ?>
  <nav class="secondary-nav toggled-element" id="secondary-nav" role="navigation">
    <?php wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'secondary-nav__list']); ?>
  </nav>
<?php endif; ?>
