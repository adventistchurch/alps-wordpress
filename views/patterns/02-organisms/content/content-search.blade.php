<div class="c-page-header__search u-background-color--gray--light can-be--dark-dark u-padding--double--top u-padding--double--bottom">
  <form action="<?php echo esc_url(home_url('/')); ?>" role="search" method="get">
    <div class="l-grid l-grid--7-col u-shift--left--1-col--at-large u-spacing--until-medium">
      <div class="l-grid-item l-grid-item--m--3-col">
        <input type="search" value="{{ the_search_query() }}" name="s" class="u-font--secondary--s u-theme--color--darker o-input__search" value="Search..." />
      </div>
      <div class="l-grid-item l-grid-item--m--3-col">
        <div class="u-flex">
          <button type="submit" class="c-filter__button o-button u-space--right"><span class="u-icon u-icon--xs u-path-fill--white">@include('patterns.00-atoms.icons.icon-search')</span>{{ __('Search', 'alps') }}</button> <!-- /.search-form__submit -->
          @if (shortcode_exists('searchandfilter'))
            <span class="c-filter__toggle js-toggle o-button o-button--simple" data-toggled="c-filter" data-prefix="c-filter"><span class="u-icon u-icon--xs">@include('patterns.00-atoms.icons.icon-settings')</span></span>
          @endif
        </div>
      </div>
    </div>
  </form>
  @if (shortcode_exists('searchandfilter'))
    <div class="c-filter">
      <div class="c-filter__form u-padding--top">
        <div class="l-grid l-grid--7-col u-shift--left--1-col--at-large">
          <div class="c-filter__form-item u-spacing--half l-grid-item">
            <h3 class="u-font--secondary--s u-font-weight--bold u-text-transform--upper u-color--gray can-be--lighter">{{ __('Settings', 'alps') }}</h3>
            {!! do_shortcode('[searchandfilter taxonomies="category" types="radio" class="c-filter__form-group" submit_label="Search Again" hide_empty="0"]') !!}
          </div>
        </div>
      </div>
    </div><!-- ./c-filter -->
  @endif
</div> <!-- /.c-page-header__search -->
<section class="l-main__content l-grid l-grid--7-col u-shift--left--1-col--at-large l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
  <div class="c-article l-grid-item l-grid-item--l--4-col u-padding--zero--sides">
    <article @php post_class("c-article__body u-padding--right")@endphp>
      <div class="c-search-results u-spacing--double text">
        @if (have_posts())
          @while (have_posts())
            @php
              the_post();
              $id = get_the_ID();
              $title = get_the_title($id);
              $excerpt = get_the_excerpt($id);
              $excerpt_length = 55;
              $body = get_the_content($id);
              $link = get_permalink($id);
              $cta = __("Read More", "alps");
              $block_class = "u-theme--border-color--darker u-border--left u-spacing--half";
            @endphp
            @include('patterns.01-molecules.blocks.content-block')
          @endwhile
          @if (shortcode_exists('ajax_load_more'))
            {!! do_shortcode('[ajax_load_more container_type="div" css_classes="u-spacing--double" post_type="post, page" scroll="false" transition_container="false" button_label="Load More" posts_per_page="10" offset="10"]') !!}
          @else
            @php pagination_nav() @endphp
          @endif
        @else
          <p>{{ __('Sorry, no results were found.', 'alps') }}</p>
          {!! get_search_form(false) !!}
        @endif
      </div>
    </article>
  </div>
</section>
