<?php if (has_nav_menu('primary_navigation')): ?>
  <nav class="primary-nav toggled-element" id="primary-nav" role="navigation" data-active-target="primary-nav">
    <?php wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'primary-nav__list']); ?>
  </nav>
<?php endif; ?>
