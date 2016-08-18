<header class="header can-be--dark-dark" role="banner" id="header">
  <div class="header__top-hat show-at--large bg--black pad-half align--right">
    <span class="icon icon__logo"><?php get_template_part('patterns/icons/icon-logo'); ?></span>
    <p class="font--secondary--xs gray--med">This is an official website of the Seventh-day Adventist Church. <a class="link--white" href="http://adventist.org">Learn More about Adventists</a>.</p>
  </div> <!-- /.header__top-hat -->
  <div class="header__inner">
    <?php get_template_part('patterns/components/navigation-toggle'); ?>
    <div class="header__unify-logo-nav">
      <a href="<?= esc_url(home_url('/')); ?>" class="logo__link logo__link--horiz theme--primary-background-color show-until--large"><img src="<?php bloginfo('template_directory'); ?>/dist/images/sda-logo--horiz.svg" alt="<?php bloginfo('name'); ?> - logo"></a>
      <a href="/" class="logo__link logo__link--square theme--primary-background-color show-at--large"><img src="<?php bloginfo('template_directory'); ?>/dist/images/sda-logo--square.svg" alt="<?php bloginfo('name'); ?> - logo"></a>
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
