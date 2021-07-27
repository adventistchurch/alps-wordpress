<div class="c-search-drawer u-theme--dark u-theme--background-color--darker">
  <div class="c-search-drawer__filter c-filter c-filter-is-active">
    <form action="<?php echo esc_url(home_url('/')); ?>" role="search" method="get" class="search-form c-filter__search">
      <fieldset>
        <input type="search" value="{{ the_search_query() }}" name="s" placeholder="{{ __('Search...', 'alps') }}" class="search-form__input u-font--secondary--s u-theme--color--darker can-be--white" required />
        <button class="search-form__submit is-vishidden">
          <span class="is-vishidden">{{ __('Submit', 'alps') }}</span>
        </button> <!-- /.search-form__submit -->
      </fieldset>
    </form> <!-- /.search-form -->
  </div>
</div>
