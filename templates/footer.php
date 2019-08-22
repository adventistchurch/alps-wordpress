<?php
  $footer_copyright             = get_alps_option( 'footer_copyright' );
  $footer_description           = get_alps_option( 'footer_description' );
  $footer_address               = get_alps_option( 'footer_address' );
  // CARBON FIELDS STORES COMPLEX FIELDS WITH A MULTIDIMENSIONAL FORMAT
  if ( is_multidimensional( $footer_address ) ) {
    $footer_address_street      = $footer_address[0]['footer_address_street'];
    $footer_address_city        = $footer_address[0]['footer_address_city'];
    $footer_address_state       = $footer_address[0]['footer_address_state'];
    $footer_address_zip         = $footer_address[0]['footer_address_zip'];
    $footer_address_country     = $footer_address[0]['footer_address_country'];
    $footer_phone               = $footer_address[0]['footer_phone'];
  }
  else { // PIKLIST
    $footer_address_street      = $footer_address['footer_address_street'];
    $footer_address_city        = $footer_address['footer_address_city'];
    $footer_address_state       = $footer_address['footer_address_state'];
    $footer_address_zip         = $footer_address['footer_address_zip'];
    $footer_address_country     = $footer_address['footer_address_country'];
    $footer_phone               = $footer_address['footer_phone'];
  }  
?>
<footer class="footer" role="contentinfo">
  <div class="footer__inner cf bg--medium-brown white can-be--dark-dark">
    <div class="layout-container">
      <div class="footer__unify-nav-desc spacing--until-large" <?php if (!has_nav_menu('footer_secondary_navigation')): echo 'style="flex-direction: row;"'; endif; ?>>
        <?php get_template_part('patterns/components/footer-navigation'); ?>
        <?php if ($footer_description): ?>
          <div class="footer__desc">
            <span class="icon footer__logo"><?php get_template_part('patterns/icons/icon-logo'); ?></span>
            <p class="footer__desc-text brown--light font--secondary"><?php echo $footer_description; ?></p>
          </div> <!-- /.footer_desc -->
        <?php endif; ?>
      </div> <!-- /.footer__unify-nav-desc -->
    </div> <!-- /.layout-container -->

    <div class="footer__legal bg--brown  can-be--dark-light">
      <div class="footer__legal__inner layout-container spacing--quarter--until-large">
        <div class="footer__unify-copyright-address spacing--quarter--until-large">
          <?php if ($footer_copyright): ?>
            <p class="footer__copyright font--secondary--xs brown--light no-space--btm">
              <?php echo $footer_copyright; ?>
            </p>
          <?php endif; ?>
          <?php if ($footer_address): ?>
            <address class="footer__address font--secondary--xs brown--light" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
              <span itemprop="streetAddress"><?php echo $footer_address_street; ?></span>
              <span itemprop="addressLocality"><?php echo ' ' . $footer_address_city; ?></span>,
              <span itemprop="addressRegion"><?php echo ' ' . $footer_address_state; ?></span>
              <?php echo ' ' . $footer_address_zip; ?><?php echo ', ' . $footer_address_country; ?>
              <span itemprop="telephone"><?php echo ' ' . $footer_phone; ?></span>
            </address>
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
<div style="height:80px;color:#fff;background:purple;font-size:60px;text-align:center;">
  CARBON FIELDS
</div>