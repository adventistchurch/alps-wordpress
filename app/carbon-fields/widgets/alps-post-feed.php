<?php
  $offset = empty($settings['post_feed_offset']) ? '' : $settings['post_feed_offset'];
  $featured = empty($settings['post_feed_featured']) ? false : $settings['post_feed_featured'];
  $category = empty($settings['post_feed_category']) ? 'news' : $settings['post_feed_category'];
  $title = empty($settings['post_feed_title']) ? get_cat_name($category) : $settings['post_feed_title'];
  $url = empty($settings['post_feed_url']) ? '' : $settings['post_feed_url'];
  $count = empty($settings['post_feed_count']) ? '-1' : $settings['post_feed_count'];
  $layout_grid = empty($settings['post_feed_layout']) ? false : $settings['post_feed_layout'];

  // Post Feed args
  $args = array(
    'cat' => $category,
    'posts_per_page' => $count,
    'offset' => $offset,
  );
  $the_query = new WP_Query($args);
?>

<div class="c-block-wrap u-spacing <?php if ($layout_grid == true): echo 'u-space--right--negative'; endif; ?>">
  <div class="c-block__heading u-theme--border-color--darker">
    <h3 class="c-block__heading-title u-theme--color--darker">
      <?php echo $title; ?>
    </h3>
    <?php if ($url): ?>
      <a href="<?php echo $url; ?>" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">See All</a>
    <?php endif; ?>
  </div>
  <div class="c-block-wrap__content u-spacing">
    <?php if ($the_query->have_posts()): ?>
      <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        <?php
          $id = get_the_ID();
          $title = get_the_title($id);
          $link = get_permalink($id);

          $category = get_the_category();
          if (get_the_category()) {
            if (class_exists('WPSEO_Primary_Term')) {
              $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
              $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
              $term = get_term($wpseo_primary_term);

              if (is_wp_error($term)) {
                $category = $category[0]->name;
              }
              else {
                $category = $term->name;
              }
            }
            else {
              $category = $category[0]->name;
            }
          }

          if ($featured == true) {
            $date = get_the_date('F j, Y');
            $excerpt = get_the_excerpt($id);
            $body = get_the_content($id);
            $thumb_id = get_post_thumbnail_id($id);
            $thumb_size = 'horiz__4x3';
            $image = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
            $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            $block_meta_class = "u-theme--color--dark u-font--secondary--xs";

            if ($layout_grid == true) {
              $excerpt_length = 100;
              $block_class = "c-block--reversed c-media-block--reversed l-grid--7-col";
              $block_img_class = "l-grid-item--2-col l-grid-item--m--1-col l-grid-item--l--1-col u-padding--right";
              $block_content_class = "l-grid-item--4-col l-grid-item--m--3-col l-grid-item--l--1-col u-border--left u-theme--border-color--darker--left u-color--gray u-spacing--half";
              $block_title_class = "u-theme--color--darker u-font--primary--s";
              $block_group_class = "u-flex--justify-start";
            }
            else {
              $excerpt_length = 200;
              $block_class = "c-block__stacked c-media-block__stacked";
              $block_content_class = "l-grid-item u-border--left u-color--gray u-theme--border-color--darker--left u-spacing--half";
              $block_title_class = "u-theme--color--darker u-font--primary--m";
            }
          }
          else {
            $block_class = "c-block__text u-theme--border-color--darker u-border--left u-padding--bottom u-spacing--half";
            $block_title_class = "u-theme--color--darker u-font--primary--s";
          }
        ?>
        <?php if ($featured == true): ?>
          <?php /* Code copied from patterns/01-molecules/blocks/media-block */ ?>
          <div class="c-media-block c-block <?php if (isset($block_class)): ?><?php echo $block_class ?><?php endif; ?>">
          <?php if (isset($image) || isset($picture)): ?>
            <div class="c-media-block__image c-block__image <?php if (isset($block_img_class)): ?><?php echo $block_img_class ?><?php endif; ?> <?php if (isset($block_type)): ?> c-block__icon c-block__icon--<?php echo $block_type ?><?php endif; ?>">
              <div class="c-block__image-wrap <?php if (isset($block_img_wrap_class)): ?><?php echo $block_img_wrap_class ?><?php endif; ?>">
                <?php if (isset($picture)): ?>
                  <picture class="picture">
                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                    <?php if (isset($image_break_xl)): ?>
                      <source srcset="<?php echo $image_xl ?>" media="(min-width: <?php echo $image_break_xl ?>px)">
                    <?php endif; ?>
                    <?php if (isset($image_break_l)): ?>
                      <source srcset="<?php echo $image_l ?>" media="(min-width: <?php echo $image_break_l ?>px)">
                    <?php endif; ?>
                    <source srcset="<?php echo $image_m ?>" media="(min-width: <?php echo $image_break_m ?>px)">
                    <!--[if IE 9]></video><![endif]-->
                    <img itemprop="image" srcset="<?php echo $image_s ?>" alt="<?php echo $alt ?>">
                  </picture>
                <?php elseif (isset($image)): ?>
                  <img src="<?php echo $image ?>" itemprop="image" alt="<?php echo $alt ?>" />
                <?php endif; ?>
              </div>
            </div> <!-- c-media-block__image -->
          <?php endif; ?>
          <div class="c-media-block__content c-block__content u-spacing <?php if (isset($block_content_class)): ?><?php echo $block_content_class ?><?php endif; ?>">
            <div class="u-spacing c-block__group c-media-block__group <?php if (isset($block_group_class)): ?><?php echo $block_group_class ?><?php endif; ?>">
              <div class="u-spacing u-width--100p">
                <?php if (isset($kicker)): ?>
                  <h4 class="c-media-block__kicker c-block__kicker <?php if (isset($block_kicker_class)): ?><?php echo $block_kicker_class ?><?php endif; ?>"><?php echo $kicker ?></h4>
                <?php endif; ?>
                <?php if (isset($title)): ?>
                  <h3 class="c-media-block__title c-block__title <?php if (isset($block_title_class)): ?><?php echo $block_title_class ?><?php endif; ?> <?php if (isset($kicker)): ?><?php echo 'u-space--zero'?><?php endif; ?>">
                    <?php if (isset($link)): ?>
                      <a href="<?php echo $link ?>" class="c-block__title-link u-theme--link-hover--dark">
                    <?php endif; ?>
                    <?php echo $title ?>
                    <?php if (isset($link)): ?>
                      </a>
                    <?php endif; ?>
                  </h3>
                <?php endif; ?>
                <?php if (!empty($excerpt)): ?>
                  <p class="c-media-block__description c-block__description">
                    <?php
                      if (strlen($excerpt) > $excerpt_length) {
                          echo strip_shortcodes(wp_trim_words($body, $excerpt_length));
                      } else {
                          echo strip_shortcodes(strip_tags($excerpt));
                      }
                    ?>
                  </p>
                <?php elseif (!empty($body)): ?>
                  <p class="c-media-block__description c-block__description">
                    <?php
                      if (strlen($body) > $excerpt_length) {
                          echo strip_shortcodes(wp_trim_words($body, $excerpt_length));
                      } else {
                          echo strip_shortcodes(strip_tags($body));
                      }
                    ?>
                  </p>
                <?php endif; ?>
              </div>
              <?php if (isset($category) || isset($date)): ?>
                <div class="c-media-block__meta c-block__meta <?php if (isset($block_meta_class)): ?><?php echo $block_meta_class ?><?php endif; ?>">
                  <?php if (isset($category)): ?>
                    <span class="c-block__category u-text-transform--upper"><?php echo $category ?></span>
                  <?php endif; ?>
                  <?php if (isset($date)): ?>
                    <time class="c-block__date u-text-transform--upper"><?php echo $date ?></time>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <?php if (isset($cta)): ?>
                <a href="<?php echo $link ?>" class="c-block__button o-button o-button--outline"><?php echo $cta ?><span class="u-icon u-icon--m u-path-fill--base u-space--half--left"><?php include(locate_template('patterns/00-atoms/icons/icon-arrow-long-right.blade.php')); ?></span></a>
              <?php endif; ?>
            </div>
          </div> <!-- .c-media-block__content -->
        </div> <!-- .c-media-block -->
        <?php else: ?>
          <?php /* Code copied from patterns/01-molecules/blocks/content-block */ ?>
          <div class="c-block c-block__text <?php if (isset($thumb_id)): ?><?php echo 'has-image'; ?><?php endif; ?> u-theme--border-color--darker u-border--left <?php if (isset($block_class)): ?><?php echo $block_class; ?><?php endif; ?>">
            <?php if (isset($thumb_id)): ?>
              <img class="c-block__image" src="<?php echo wp_get_attachment_image_src($thumb_id, "featured__hero--m")[0]; ?>" />
            <?php endif; ?>
            <h3 class="u-theme--color--darker <?php if (isset($block_title_class)): ?><?php echo $block_title_class; ?><?php endif; ?>">
              <?php if (isset($link)): ?>
                <a href="<?php echo $link; ?>" class="c-block__title-link u-theme--link-hover--dark">
              <?php endif; ?>
              <strong><?php echo $title; ?></strong>
              <?php if (isset($link)): ?>
                </a>
              <?php endif; ?>
            </h3>
            <?php if (!empty($excerpt)): ?>
              <p class="c-block__body text">
                <?php
                  if (str_word_count($excerpt) > $excerpt_length) {
                    echo strip_shortcodes(wp_trim_words($body, $excerpt_length));
                  } else {
                    echo strip_shortcodes(strip_tags($excerpt, '<img>'));
                  }
                ?>
              </p>
            <?php elseif (!empty($body)): ?>
              <p class="c-block__body text">
                <?php
                  if (str_word_count($body) > $excerpt_length) {
                    echo strip_shortcodes(wp_trim_words($body, $excerpt_length));
                  } else {
                    echo strip_shortcodes(strip_tags($body));
                  }
                ?>
              </p>
            <?php endif; ?>
            <?php if (isset($category) || isset($date)): ?>
              <span class="c-block__meta u-theme--color--dark u-font--secondary--xs">
                <?php if (isset($category)): ?>
                  <span class="c-block__category u-text-transform--upper"><?php echo $category ?></span>
                <?php endif; ?>
                <?php if (isset($date)): ?>
                  <time class="c-block__date u-text-transform--upper"><?php echo $date ?></time>
                <?php endif; ?>
              </span>
            <?php endif; ?>
            <?php if (isset($expand_body)): ?>
              <div class="c-block__content">
                <p><?php echo $expand_body; ?></p>
              </div>
            <?php endif; ?>
            <?php if (isset($expand)): ?>
              <a href="" class="o-button o-button--outline o-button--expand js-toggle-parent"></a>
            <?php else: ?>
              <?php if (isset($cta)): ?>
                <a href="<?php echo $link; ?>" class="c-block__button o-button o-button--outline"><?php echo $cta; ?><span class="u-icon u-icon--m u-path-fill--base u-space--half--left"><?php include(locate_template('patterns/00-atoms/icons/icon-arrow-long-right.blade.php')); ?></span></a>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      <?php endwhile; ?>
      <?php wp_reset_query(); ?>
    <?php else: ?>
      <?php _e('There are no posts at this time.', 'alps'); ?>
    <?php endif; ?>
  </div>
</div>
