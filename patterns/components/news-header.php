<header class="article__header article__flow spacing--quarter">
  <?php if ( get_alps_field( 'display_title' ) ): ?>
    <h1 class="font--secondary--xl theme--secondary-text-color"><?php echo carbon_get_the_post_meta( 'display_title' ) ?></h1>
  <?php endif; ?>
  <div class="spacing--half">
    <?php if ( get_alps_field( 'intro' ) ): ?>
      <h1 class="font--secondary--m"><?php echo carbon_get_the_post_meta( 'intro' ) ?></h1>
    <?php endif; ?>
  </div>
  <div class="article__meta">
    <span class="pub_date font--secondary--s gray can-be--white"><?php the_date(); ?></span>
    <?php
      //$theme_options = get_option('alps_theme_settings');
      $hide_author_global = get_alps_option( 'hide_author_global' );
      $hide_author_post   = get_alps_field( 'hide_author_post' );
    ?>
    <?php if ($hide_author_global == true || $hide_author_post == true): ?>
    <?php else: ?>
      <span class="divider">|</span>
      <span class="byline font--secondary--s gray can-be--white"><?php the_author(); ?></span>
    <?php endif; ?>
  </div>
</header>
