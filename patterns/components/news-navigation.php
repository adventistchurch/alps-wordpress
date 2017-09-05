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
            'sub-menu',
            'menu-item-has-children',
            '<ul'
          );

          // Custom ALPS classes to replace.
          $replace_with = array(
            'article-nav__list-item dropdown__item ',
            '<a class="article-nav__link dropdown__item-link white"',
            'article-nav__subnav theme--secondary-background-color',
            'article-nav--with-subnav js-hover',
            '<div class="article-nav__subnav__arrow va--middle js-toggle-parent"><span class="arrow--down"></span></div><ul'
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

<!--
<ul class="article-nav__list dropdown__options theme--secondary-background-color">
  <li class="article-nav__list-item dropdown__item article-nav--with-subnav js-hover is-active" data-prefix="hover">
    <a class="article-nav__link dropdown__item-link white " href="">News</a>
    <div class="article-nav__subnav__arrow va--middle js-toggle-parent is-active"><span class="arrow--down"></span></div>
    <ul class="article-nav__subnav theme--secondary-background-color">
      <li class="article-nav__subnav__list-item"><a class="article-nav__subnav__link " href="">Life Hope Centers</a></li>
      <li class="article-nav__subnav__list-item"><a class="article-nav__subnav__link " href="">Global Mission</a></li>
      <li class="article-nav__subnav__list-item"><a class="article-nav__subnav__link " href="">Mission Spotlight</a></li>
      <li class="article-nav__subnav__list-item"><a class="article-nav__subnav__link " href="">Church Mission Offerings</a></li>
    </ul>
  </li>
  <li class="article-nav__list-item dropdown__item ">
    <a class="article-nav__link dropdown__item-link white " href="">ANN Videos</a>
  </li>
  <li class="article-nav__list-item dropdown__item ">
    <a class="article-nav__link dropdown__item-link white " href="">Photos</a>
  </li>
  <li class="article-nav__list-item dropdown__item ">
    <a class="article-nav__link dropdown__item-link white " href="">Church Business Meetings</a>
  </li>
</ul>
-->
