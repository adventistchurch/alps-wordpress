<?php
  $theme_options = get_option('alps_theme_settings');
  $footer_copyright = $theme_options['footer_copyright'];
  $footer_address = $theme_options['footer_address'];
?>
<footer class="footer" role="contentinfo">
  <div class="footer__inner cf bg--medium-brown white can-be--dark-dark">
    <div class="layout-container">
      <div class="footer__unify-nav-desc spacing--until-large">
        <?php get_template_part('patterns/components/footer-navigation'); ?>
        <div class="footer__desc">
          <span class="icon footer__logo"><?php get_template_part('patterns/icons/icon-logo'); ?></span>
          <p class="footer__desc-text brown--light font--secondary"><a class="link--white" href="http://adventist.org">Adventist.org</a> is the Official website of the Seventh-day Adventist world church &bull; <a href="http://adventist.org/regions" class="link--white">View Regions</a></p>
        </div> <!-- /.footer_desc -->
      </div> <!-- /.footer__unify-nav-desc -->
    </div> <!-- /.layout-container -->

    <div class="footer__legal bg--brown  can-be--dark-light">
      <div class="footer__legal__inner layout-container spacing--quarter--until-large">
        <div class="footer__unify-copyright-address spacing--quarter--until-large">
          <?php if ($footer_copyright): ?>
            <p class="footer__copyright font--secondary--xs brown--light no-space--btm"><?php echo $footer_copyright; ?></p>
          <?php endif; ?>
          <?php if ($footer_address): ?>
            <address class="footer__address font--secondary--xs brown--light"><?php echo $footer_address; ?></address>
          <?php endif; ?>
        </div> <!-- /.footer__unify-copyright-address -->
        <div class="footer__legal-links font--secondary--xs">
          <?php
            $menu_args = array(
              'echo' => false,
              'menu_class' => 'footer-nav__list',
              'container' => false,
              'depth' => 1,
              'theme_location' => 'footer_navigation',
            );

            // Native WordPress menu classes to be replaced.
            $replace = array(
              'menu-item',
              '<a'
            );

            // Custom ALPS classes to replace.
            $replace_with = array(
              'footer__nav-item inline-list__item',
              '<a class="hover link--brown-light space-half--left" '
            );
          ?>
          <?php if (has_nav_menu('footer_navigation')): ?>
            <?php echo str_replace($replace, $replace_with, wp_nav_menu($menu_args)); ?>
          <?php endif; ?>
        </div>
      </div> <!-- /.layout-container -->
    </div> <!-- /.legal -->
  </div> <!-- /.footer__inner -->
</footer> <!-- /.footer -->
