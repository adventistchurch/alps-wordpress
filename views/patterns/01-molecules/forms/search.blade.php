<form action="<?php echo esc_url(home_url('/')); ?>" role="search" method="get" class="search-form">
  <fieldset>
    <input type="search" value="{{ the_search_query() }}" name="s" placeholder="{{ __('Search...', 'alps') }}" class="search-form__input u-font--secondary--s" required />
    <button class="search-form__submit is-vishidden">
      <span class="is-vishidden">{{ __('Submit', 'alps') }}</span>
    </button> <!-- /.search-form__submit -->
  </fieldset>
</form> <!-- /.search-form -->
