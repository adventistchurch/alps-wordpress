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
          <?php elseif (is_single()): ?>
            <?php
              $categories = get_the_category();
              $category= '';
              foreach($categories as $childcat) {
                $parentcat = $childcat->category_parent;
                if ($parentcat>0){
                  $category = get_cat_name($parentcat);
                  continue;
                }
              }
              $category = (strlen($category)>0)? $category :  $categories[0]->cat_name;
            ?>
            <?php echo $category; ?>
          <?php endif; ?>
        </span>
        <h1 class="font--tertiary--xl white">
          <?php if ($display_title && is_page_template('template-single.php')): ?>
            <?php echo $display_title; ?>
          <?php elseif (is_single()): ?>
            <?php $categories = get_the_category($post->ID); ?>
            <?php $parent_cat = get_term_by('id', $categories[0]->cat_ID, 'category'); ?>
            <?php echo $parent_cat->name; ?>
          <?php else: ?>
            <?php echo Titles\title(); ?>
          <?php endif; ?>
        </h1>
      </div>
      <div class="shift-right--fluid"></div> <!-- /.shift-right--fluid -->
    </div>
  </div>
</header> <!-- /.header__swath -->
