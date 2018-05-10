<?php
/*
  Title: Text with Link
  Description: Arbitrary text with link.
*/
?>
<div class="with-divider grid--uniform">
  <?php echo $before_widget; ?>
    <div class="widget_text_link can-be--dark-dark">
      <?php echo $before_title; ?>
        <?php if (!empty($settings['title'])): ?>
          <div class="icon icon--s"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.22 99.29"><title>List Icon</title><path d="M34.68,54.8H65.57V44.87H34.68V54.8ZM77.58,0.36H22.42a11.06,11.06,0,0,0-11,11V88.61a11.06,11.06,0,0,0,11,11H77.58a11.06,11.06,0,0,0,11-11V11.39A11.06,11.06,0,0,0,77.58.36Zm0,88.26H22.42V11.39H77.58V88.61ZM65.44,23.35H34.56V33H65.44V23.35Zm0,43.3H34.56v9.65H65.44V66.66Z" transform="translate(-11.39 -0.36)" fill="#010101" class="theme--primary-fill-color"/></svg></div>
          <?php echo $settings['title']; ?>
        <?php endif; ?>
      <?php echo $after_title; ?>
      <div class="media-block__inner spacing--quarter">
        <div class="media-block__content block__content">
          <div class="spacing--half">
            <?php if (!empty($settings['content'])): ?>
              <div class="text text--s pad-half--btm">
                <p class="media-block__description block__description">
                  <span class="font--primary--xs">
                    <?php echo $settings['content']; ?>
                  </span>
                </p>
              </div>
            <?php endif; ?>
            <?php if (!empty($settings['url'])): ?>
              <p>
                <a class="media-block__cta block__cta btn theme--secondary-background-color" href="<?php echo $settings['url']; ?>">
                  <?php echo $settings['url_text']; ?>
                </a>
              </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php echo $after_widget; ?>
</div>
