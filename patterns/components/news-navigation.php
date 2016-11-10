<nav class="article-nav theme--secondary-background-color">
  <div class="layout-container">
    <div class="article-nav__inner">
      <div class="dropdown">
        <div class="dropdown__label font--secondary--s upper js-toggle-parent white">News Menu <span class="dropdown__arrow dib arrow--down border-top--white va--middle"></span></div>
        <?php
          $menu_args = array(
            'echo' => false,
            'menu_class' => 'article-nav__list dropdown__options theme--secondary-background-color',
            'container' => false,
            'depth' => 2,
            'theme_location' => 'tertiary_navigation',
          );

          // Native WordPress menu classes to be replaced.
          $replace = array(
            'menu-item ',
            '<a',
          );

          // Custom ALPS classes to replace.
          $replace_with = array(
            'article-nav__list-item dropdown__item ',
            '<a class="article-nav__link dropdown__item-link white"',
          );
        ?>
        <?php if (has_nav_menu('tertiary_navigation')): ?>
          <?php echo str_replace($replace, $replace_with, wp_nav_menu($menu_args)); ?>
        <?php endif; ?>
      </div>
      <div class="article-nav__search cf">
        <?php get_template_part('patterns/components/search-form-header'); ?>
      </div>
    </div>
  </div> <!-- /.layout-container -->
</nav>
