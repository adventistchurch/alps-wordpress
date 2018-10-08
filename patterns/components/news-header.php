<header class="article__header article__flow spacing--quarter">
  <?php if (get_field('display_title')): ?>
    <h1 class="font--secondary--xl theme--secondary-text-color"><?php the_field('display_title'); ?></h1>
  <?php endif; ?>
  <div class="spacing--half">
    <?php if (get_field('intro')): ?>
      <h1 class="font--secondary--m"><?php the_field('intro'); ?></h1>
    <?php endif; ?>
    <div class="share-tools">
      <div class="addthis_toolbox addthis_default_style" addthis:url="">
        <a href="http://www.addthis.com/bookmark.php?v=250&amp;pubid=ra-4ed4fc0e60966005" class="addthis_button_compact can-be--white font--secondary--s"><?php _e('Share'); ?></a>
        <span class="addthis_separator">|</span>
        <a class="addthis_button_facebook" g:plusone:count="false"></a>
        <a class="addthis_button_twitter" g:plusone:count="false"></a>
        <a class="addthis_button_google_plusone" g:plusone:count="false"></a>
        <a class="addthis_button_email" g:plusone:count="false"></a>
      </div>
    </div> <!-- /.share-tools -->
  </div>
  <div class="article__meta">
    <span class="pub_date font--secondary--s gray can-be--white"><?php the_date(); ?></span>
    <?php
      $theme_options = get_option('alps_theme_settings');
      $hide_author_global = $theme_options['hide_author_global'];
      $hide_author_post = get_post_meta($post->ID, 'hide_author_post', true);
    ?>
    <?php if ($hide_author_global == true || $hide_author_post == true): ?>
    <?php else: ?>
      <span class="divider">|</span>
      <span class="byline font--secondary--s gray can-be--white"><?php the_author(); ?></span>
    <?php endif; ?>
  </div>
</header>
