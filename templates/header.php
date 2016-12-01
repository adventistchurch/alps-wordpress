<header class="header can-be--dark-dark" role="banner" id="header">
  <div class="header__inner">
    <?php get_template_part('patterns/components/navigation-toggle'); ?>
    <div class="header__unify-logo-nav">
      <?php
        $logo_square = get_field('logo_square', 'options');
        $logo_horizontal = get_field('logo_horizontal', 'options');
        $logo_text = get_field('logo_text', 'options');
      ?>
      <a href="<?php echo get_home_url(); ?>" class="logo__link logo__link--horiz theme--primary-background-color show-until--large <?php if ($logo_text): echo 'logo--with-text'; endif; ?>">
        <?php if ($logo_horizontal): ?>
          <img src="<?php echo $logo_horizontal['url']; ?>" alt="<?php echo $logo_horizontal['url']; ?>">
        <?php else: ?>
          <img src="<?php bloginfo('template_directory'); ?>/dist/images/sda-logo--horiz.svg" alt="<?php bloginfo('name'); ?> - logo">
        <?php endif; ?>
        <?php if ($logo_text): ?>
          <span class="logo__text"><img class="logo__text" src="<?php echo $logo_text['url']; ?>" alt="<?php echo $logo_text['alt']; ?>"></span>
        <?php endif; ?>
      </a>
      <a href="<?php echo get_home_url(); ?>" class="logo__link logo__link--square theme--primary-background-color show-at--large <?php if ($logo_text): echo 'logo--with-text'; endif; ?>">
        <?php if ($logo_square): ?>
          <img src="<?php echo $logo_square['url']; ?>" alt="<?php echo $logo_square['alt']; ?>">
        <?php else: ?>
          <img src="<?php bloginfo('template_directory'); ?>/dist/images/sda-logo--square.svg" alt="<?php bloginfo('name'); ?> - logo">
        <?php endif; ?>
        <?php if ($logo_text): ?>
          <span class="logo__text"><img class="logo__text" src="<?php echo $logo_text['url']; ?>" alt="<?php echo $logo_text['alt']; ?>"></span>
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
