<div class="c-block c-block__text has-image u-padding--zero--left u-clear-fix">
  <?php if (function_exists('get_avatar_url')): ?>
    <img class="c-block__image" itemprop="image" src="<?php echo get_avatar_url(get_the_author_meta('email'), array("size"=>400)); ?>">
  <?php endif; ?>
  <h4 class="c-media-block__kicker c-block__kicker u-space--zero--top">
    <?php echo $settings['text_link_title']; ?>
  </h4>
  <h3 class="u-theme--color--darker u-font--primary--m vcard author" itemprop="url" rel="author">
    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="c-block__title-link u-theme--link-hover--dark fn" itemprop="name">
      <span itemprop="author" itemscope itemtype="https://schema.org/Person">
        <strong><?php the_author_meta('display_name'); ?></strong>
      </span>
    </a>
  </h3>
  <?php if (get_the_author_meta('user_description')): ?>
    <div class="c-block__body text">
      <?php the_author_meta('description'); ?>
    </div>
  <?php endif; ?>
  <ul class="o-inline-list">
    <?php if (get_the_author_meta('url') != ''): ?>
      <li>
        <a class="author-link t" title="View Website" href="<?php echo get_the_author_meta('url'); ?>" target="_blank">
          <span class="u-icon u-icon--m u-path-fill--gray">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 49.5 49.5"><title>Globe icon</title><path d="M25,0.25A24.75,24.75,0,1,0,49.75,25,24.78,24.78,0,0,0,25,.25ZM46.11,25a21,21,0,0,1-4.37,12.84,3.37,3.37,0,0,1-.82-3.93c0.78-1.7,1-5.64.81-7.17s-1-5.22-3.13-5.26-3.64-.75-4.93-3.31c-2.66-5.33,5-6.35,2.34-9.31-0.75-.83-4.6,3.41-5.16-2.24A3,3,0,0,1,31.7,5,21.14,21.14,0,0,1,46.11,25ZM22.1,4.1c-0.51,1-1.84,1.38-2.65,2.12C17.69,7.82,16.93,7.6,16,9.13s-4,3.74-4,4.85,1.56,2.41,2.34,2.16a8.33,8.33,0,0,1,4,.18c1.21,0.43,10.09.85,7.26,8.36-0.9,2.39-4.83,2-5.88,5.94A32.31,32.31,0,0,0,19,34.48c-0.06,1.25.89,6-.32,6s-4.48-4.22-4.48-5-0.85-3.45-.85-5.75S9.41,27.46,9.41,24.4c0-2.76,2.12-4.13,1.64-5.45s-4.2-1.36-5.75-1.52A21.16,21.16,0,0,1,22.1,4.1ZM18.36,45c1.27-.67,1.4-1.53,2.55-1.58a23.35,23.35,0,0,0,3.87-.84c1.32-.29,3.67-1.62,5.74-1.79,1.75-.14,5.19.09,6.12,1.78A21,21,0,0,1,18.36,45Z" transform="translate(-0.25 -0.25)" fill="#010101" /></svg></span>
          <?php _e('Website', 'alps'); ?>
        </a>
      </li>
    <?php endif; ?>
    <?php if (get_the_author_meta('facebook') != ''): ?>
      <li>
        <a class="author-link" title="Follow on Facebook" href="<?php echo get_the_author_meta('facebook'); ?>" target="_blank">
          <span class="u-icon u-icon--m u-path-fill--gray">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><title>Facebook icon</title><path d="M87.5,0h-75A12.54,12.54,0,0,0,0,12.5v75A12.54,12.54,0,0,0,12.5,100H50.43V64.14h-12V48.52h12V40.7c0-12.06,8.91-21.51,20.28-21.51h11V36.82H71.87c-2.58,0-3.34,1.48-3.34,3.53v8.16H81.75V64.14H68.53V100h19A12.54,12.54,0,0,0,100,87.5v-75A12.54,12.54,0,0,0,87.5,0Z" transform="translate(0 0)" fill="#010101" /></svg>
          </span>
          <?php _e('Facebook', 'alps'); ?>
        </a>
      </li>
    <?php endif; ?>
    <?php if (get_the_author_meta('twitter') != ''): ?>
      <li>
        <a class="author-link" title="Follow on Twitter" href="https://twitter.com/<?php echo get_the_author_meta('twitter'); ?>" target="_blank">
          <span class="u-icon u-icon--m u-path-fill--gray">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.06 80.51"><title>Twitter icon</title><path d="M99.53,19.28a40.66,40.66,0,0,1-11.67,3.2A20.39,20.39,0,0,0,96.8,11.23a40.75,40.75,0,0,1-12.91,4.93A20.34,20.34,0,0,0,49.26,34.7,57.69,57.69,0,0,1,7.36,13.47,20.34,20.34,0,0,0,13.65,40.6a20.24,20.24,0,0,1-9.21-2.54c0,0.08,0,.17,0,0.25a20.34,20.34,0,0,0,16.3,19.93,20.34,20.34,0,0,1-9.18.35,20.35,20.35,0,0,0,19,14.11,40.77,40.77,0,0,1-25.24,8.7,40.76,40.76,0,0,1-4.85-.29,57.5,57.5,0,0,0,31.16,9.13c37.38,0,57.83-31,57.83-57.83q0-1.32-.06-2.63A41.26,41.26,0,0,0,99.53,19.28Z" transform="translate(-0.47 -9.75)" fill="#010101" /></svg>
          </span>
          <?php _e('Twitter', 'alps'); ?>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</div>
