<?php
  $current_language = apply_filters('wpml_current_language', NULL);
  $theme_color      = get_alps_option( 'primary_theme_color' );
  if ($current_language) {
    $logo_desktop_wide  = get_alps_option( 'logo_desktop_wide_' . $current_language[0] );
    $logo_desktop       = get_alps_option( 'logo_desktop_' . $current_language[0] );
    $logo_mobile        = get_alps_option( 'logo_mobile_' . $current_language[0] );
    $logo_text          = get_alps_option( 'logo_text_' . $current_language[0] );
  } else {
    $logo_desktop_wide  = get_alps_option( 'logo_desktop_wide' );
    $logo_desktop       = get_alps_option( 'logo_desktop' );
    $logo_mobile        = get_alps_option( 'logo_mobile' );
    $logo_text          = get_alps_option( 'logo_text' );
  }
?>
<header class="header <?php if ($logo_desktop_wide == 'wide'): echo 'header__wide-logo '; endif; ?>can-be--dark-dark" role="banner" id="header">
  <div class="header__inner">
    <?php get_template_part('patterns/components/navigation-toggle'); ?>
    <div class="header__unify-logo-nav">
      <a href="<?php echo get_home_url(); ?>" class="logo__link logo__link--horiz theme--primary-background-color show-until--large <?php if ($logo_text): echo 'logo--with-text'; endif; ?>">
        <?php
          if (!empty($logo_mobile)) {
            echo '<img class="logo" src="'. wp_get_attachment_url($logo_mobile) . '" alt="'. get_alps_field( '_wp_attachment_image_alt', $logo_mobile ) . '">';
          } else {
            echo '<img class="logo" src="' . get_bloginfo('template_directory') . '/dist/images/sda-logo--horiz.svg" alt="' . get_bloginfo('name') . ' - logo">';
          }
          if ($logo_text) {
            echo '<span class="logo__text"><img class="logo__text" src="' . wp_get_attachment_url($logo_text) . '" alt="' . get_alps_field( '_wp_attachment_image_alt', $logo_text ) . '"></span>';
          }
        ?>
      </a>
      <a href="<?php echo get_home_url(); ?>" class="logo__link logo__link--square theme--primary-background-color show-at--large <?php if ($logo_text): echo 'logo--with-text'; endif; ?>">
        <?php
          if (!empty($logo_desktop)) {
            echo '<img class="logo" src="'. wp_get_attachment_url($logo_desktop) . '" alt="'. get_alps_field( '_wp_attachment_image_alt', $logo_desktop ) . '">';
          } elseif ($logo_desktop_wide == 'wide') {
            echo '<img class="logo" src="' . get_bloginfo('template_directory') . '/dist/images/sda-logo--wide.svg" alt="' . get_bloginfo('name') . ' - logo">';
          } else {
            echo '<img class="logo" src="' . get_bloginfo('template_directory') . '/dist/images/sda-logo--square.svg" alt="' . get_bloginfo('name') . ' - logo">';
          }
          if ($logo_text) {
            echo '<span class="logo__text"><img class="logo__text" src="' . wp_get_attachment_url($logo_text) . '" alt="' . get_alps_field( '_wp_attachment_image_alt', $logo_text ) . '"></span>';
          }
        ?>
      </a>
      <?php get_template_part('patterns/components/primary-navigation'); ?>
    </div> <!-- /.header__unify-logo-nav -->
    <div class="header__utility">
      <div class="header__utility__inner full--until-large">
        <?php get_template_part('patterns/components/secondary-navigation'); ?>
        <?php get_template_part('patterns/components/search-form'); ?>
      </div>
    </div> <!-- /.header__utility -->
  </div> <!-- /.header__inner -->
</header> <!-- .header -->
