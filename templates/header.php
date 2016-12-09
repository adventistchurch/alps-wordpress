<header class="header can-be--dark-dark" role="banner" id="header">
  <div class="header__inner">
    <?php get_template_part('patterns/components/navigation-toggle'); ?>
    <div class="header__unify-logo-nav">
      <?php
        $theme_options = get_option('alps_theme_settings');
        $logo_square = $theme_options['logo_square'][0];
        $logo_horizontal = $theme_options['logo_horizontal'][0];
        $logo_text = $theme_options['logo_text'][0];
      ?>
      <a href="<?php echo get_home_url(); ?>" class="logo__link logo__link--horiz theme--primary-background-color show-until--large <?php if ($logo_text): echo 'logo--with-text'; endif; ?>">
        <?php if ($logo_horizontal): ?>
          <img src="<?php echo wp_get_attachment_url($logo_horizontal); ?>" alt="<?php echo get_post_meta($logo_horizontal, '_wp_attachment_image_alt', true); ?>">
        <?php else: ?>
          <img src="<?php bloginfo('template_directory'); ?>/dist/images/sda-logo--horiz.svg" alt="<?php bloginfo('name'); ?> - logo">
        <?php endif; ?>
        <?php if ($logo_text): ?>
          <span class="logo__text"><img class="logo__text" src="<?php echo wp_get_attachment_url($logo_text); ?>" alt="<?php echo get_post_meta($logo_text, '_wp_attachment_image_alt', true); ?>"></span>
        <?php endif; ?>
      </a>
      <a href="<?php echo get_home_url(); ?>" class="logo__link logo__link--square theme--primary-background-color show-at--large <?php if ($logo_text): echo 'logo--with-text'; endif; ?>">
        <?php if ($logo_square): ?>
          <img src="<?php echo wp_get_attachment_url($logo_square); ?>" alt="<?php echo get_post_meta($logo_square, '_wp_attachment_image_alt', true); ?>">
        <?php else: ?>
          <img src="<?php bloginfo('template_directory'); ?>/dist/images/sda-logo--square.svg" alt="<?php bloginfo('name'); ?> - logo">
        <?php endif; ?>
        <?php if ($logo_text): ?>
          <span class="logo__text"><img class="logo__text" src="<?php echo wp_get_attachment_url($logo_text); ?>" alt="<?php echo get_post_meta($logo_text, '_wp_attachment_image_alt', true); ?>"></span>
        <?php endif; ?>
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
