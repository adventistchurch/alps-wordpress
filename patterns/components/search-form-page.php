<form class="search__results__form" action="<?php echo home_url( '/' ); ?>" role="search" method="get">
  <fieldset>
    <legend class="is-vishidden"><?php _e('Search', 'sage') ?></legend>
    <div class="field-container field-container--inline">
      <input name="q" class="term search__results__input font--secondary--s" type="search" autocomplete="off">
      <button class="search__submit font--secondary--s upper theme--secondary-background-color"><?php _e('Search', 'sage')?></button>
    </div>
  </fieldset>
</form>
