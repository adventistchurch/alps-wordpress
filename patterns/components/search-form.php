<form action="<?php echo home_url( '/' ); ?>" role="search" method="get" class="search-form toggled-element">
  <fieldset>
    <legend class="is-vishidden"><?php _e('Search', 'sage'); ?></legend>
    <input type="search" name="s" placeholder="<?php esc_attr_e('Search&hellip;', 'sage'); ?>" class="search-form__input font--secondary--s" required />
    <button class="search-form__submit is-vishidden">
    <span class="is-vishidden"><?php _e('Submit', 'sage'); ?></span>
    </button> <!-- /.search-form__submit -->
  </fieldset>
</form> <!-- /.search-form -->
