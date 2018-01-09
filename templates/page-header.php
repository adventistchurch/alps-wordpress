<?php
  use Roots\Sage\Titles;
  global $post;
  $display_title = '';
  $kicker = '';
  $header_block_text = '';
  $header_block_title = '';
  $header_block_subtitle = '';
  $header_block_image = '';
  $header_background_image = '';
  if (is_page() || is_single()) {
    $display_title = get_post_meta($post->ID, 'display_title', true);
    $kicker = get_post_meta($post->ID, 'kicker', true);
    $header_block_text = get_post_meta($post->ID, 'header_block_text', true);
    $header_block_title = get_post_meta($post->ID, 'header_block_title', true);
    $header_block_subtitle = get_post_meta($post->ID, 'header_block_subtitle', true);
    $header_block_image = get_post_meta($post->ID,'header_block_image', true);
    $header_background_image = get_post_meta($post->ID, 'header_background_image', true);
  }

  if (is_single()) {
    // SHOW YOAST PRIMARY CATEGORY, OR FIRST CATEGORY
    $category = get_the_category();
    // If post has a category assigned.
    if ($category) {
      $kicker = '';
      $display_title = '';
      if (class_exists('WPSEO_Primary_Term')) {
        // Show the post's 'Primary' category, if this Yoast feature is available, & one is set
        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
        $term = get_term($wpseo_primary_term);
        if (is_wp_error($term)) {
          // Default to first category (not Yoast) if an error is returned
          $kicker = '';
          $display_title = $category[0]->name;
        } else {
          // Yoast Primary category
          if ($term->parent != 0) {
            $term_parent = get_term($term->parent, 'category')->name;
            $kicker = $term_parent;
            $display_title = $term->name;
          } else {
            $kicker = '';
            $display_title = $term->name;
          }
        }
      }
      else {
        // Default, display the first category in WP's list of assigned categories
        $kicker = '';
        $display_title = $category[0]->name;
      }
    }
  }
?>
<?php
  if (!empty($header_background_image)):
?>
  <style type="text/css">
    .header-swath--with-image {
      background-image: url(<?php echo wp_get_attachment_image_url( $header_background_image, 'featured__hero--m' ); ?>);
    }
    @media (min-width: 800px) {
      .header-swath--with-image {
        background-image: url(<?php echo wp_get_attachment_image_url( $header_background_image, 'featured__hero--l' ); ?>);
      }
    }
    @media (min-width: 1100px) {
      .header-swath--with-image {
        background-image: url(<?php echo wp_get_attachment_image_url( $header_background_image, 'featured__hero--xl' ); ?>);
      }
    }
  </style>
<?php endif; ?>

<header class="header__swath theme--primary-background-color blend-mode--multiply <?php if (!empty($header_background_image)): echo "header-swath--with-image"; endif; ?> <?php if ($header_block_text == 'true'): echo "header-swath--with-text"; endif; ?>">
  <div class="layout-container cf">
    <?php if ($header_block_text == 'true'): ?>
      <div class="header__text">
        <div class="unify show-at--small">
          <h2 class="font--secondary--l upper white"><?php echo $header_block_title; ?></h2>
          <?php if ($header_block_subtitle): ?>
            <h3 class="font--secondary--m white--trans"><?php echo $header_block_subtitle; ?></h3>
          <?php endif; ?>
        </div>
        <?php if ($header_block_image): ?>
          <div class="header__logo">
            <img src="<?php echo wp_get_attachment_image_url( $header_block_image, 'thumbnail' ); ?>" width="80" height="80" alt="<?php get_post_meta($header_block_image, '_wp_attachment_metadata', true); ?>">
          </div>
        <?php endif; ?>
      </div> <!-- /.header__text -->
    <?php endif; ?>
    <div class="flex-container cf">
      <div class="shift-left--fluid">
        <span class="kicker white">
          <?php if ($kicker && !is_category() && !is_home()): ?>
            <?php echo $kicker; ?>
          <?php elseif (is_page() && $post->post_parent != '0'): ?>
            <?php echo get_the_title($post->post_parent); ?>
          <?php endif; ?>
        </span>
        <h1 class="font--tertiary--xl white">
          <?php if ($display_title && is_page_template('template-single.php') || is_single()): ?>
            <?php echo $display_title; ?>
          <?php else: ?>
            <?php echo Titles\title(); ?>
          <?php endif; ?>
        </h1>
      </div>
      <div class="shift-right--fluid"></div> <!-- /.shift-right--fluid -->
    </div>
  </div>
</header> <!-- /.header__swath -->
