<?php
  // Featured image.
  $thumb_id = get_post_thumbnail_id();
  // Image alt
  $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
  $post_id_array = array();
?>

<div class="layout-container full--until-large">
  <div class="flex-container cf">
    <div class="shift-left--fluid column__primary bg--white can-be--dark-light">
      <div class="spacing--one-and-half">
        <?php if (!have_posts()) : ?>
          <div class="pad--primary no-pad--top no-pad--btm spacing--half text">
            <div class="alert alert-warning">
              <?php _e('Sorry, no results were found.', 'sage'); ?>
            </div>
          </div>
        <?php endif; ?>
        <div class="search__results spacing--one-and-half">
          <div class="search__options pad--primary no-pad--btm spacing--half">
            <?php get_template_part('patterns/components/search-form-page'); ?>
            <div class="search__filters spacing--half">
              <h3 class="font--secondary--m upper">Narrow Search</h3>
              <?php
                $terms = get_terms(
                  'category', array(
                  'parent'   => 0,
                  'hide_empty' => true // Optional
                  )
                );
              ?>
              <?php if (count($terms) > 0): ?>
                <ul class="bullet-list spacing--quarter theme--primary-text-color">
                  <?php foreach ($terms as $term): ?>
                    <li class="font--primary--s">
                      <a href="<?php echo home_url( '/' ); ?>?s=search+<?php echo get_search_query(); ?><?php echo esc_html('&cat=' . $term->name); ?>" title="<?php echo esc_attr($term->name); ?>"><?php echo esc_html($term->name); ?></a>&nbsp;
                      (<?php echo count($terms); ?>)
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div> <!-- /.search__filters -->
          </div> <!-- /.search__options -->
          <hr>
          <div class="spacing--one-and-half">
            <?php while (have_posts()) : the_post(); ?>
              <div class="pad--primary no-pad--top no-pad--btm spacing--half text">
                <h3 class="brown font--tertiary--l theme--primary-text-color"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php the_excerpt(); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn font--secondary--s upper theme--secondary-background-color"><strong>Read More</strong></a>
              </div>
              <hr>
            <?php endwhile; ?>
            <?php get_template_part('patterns/components/posts-navigation'); ?>
          </div>
        </div> <!-- /.search__results -->
      </div>
    </div> <!-- /.shift-left--fluid -->
    <div class="shift-right--fluid bg--beige can-be--dark-dark">
      <?php include(locate_template('patterns/components/aside.php')); ?>
    </div> <!-- /.shift-right--fluid -->
  </div> <!-- /.flex-container -->
</div> <!-- /.layout-container -->
