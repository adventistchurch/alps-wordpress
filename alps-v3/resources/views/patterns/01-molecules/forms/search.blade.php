<form action="/" role="search" method="get" class="search-form">
  <fieldset>
    <input type="search" value="{{ the_search_query() }}" name="s" placeholder="Search..." class="search-form__input u-font--secondary--s" required />
    <button class="search-form__submit is-vishidden">
      <span class="is-vishidden">Submit</span>
    </button> <!-- /.search-form__submit -->
  </fieldset>
</form> <!-- /.search-form -->
