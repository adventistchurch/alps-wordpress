<header class="c-page-header c-page-header__simple u-theme--background-color--dark">
  <div class="c-page-header__simple--inner u-padding">
    <h1 class="u-font--primary--xxl u-color--white">
      Search
    </h1>
  </div>
</header> <!-- /.c-page-header-->
<section class="l-grid l-grid--7-col u-shift--left--1-col--at-large l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
  <div class="c-article l-grid-item l-grid-item--l--4-col u-padding--zero--sides">
    <article class="c-article__body u-padding--right">
      <div class="c-search-results u-spacing--double text">
        @if (have_posts())
          @while (have_posts()) @php(the_post())
            @php
              $id = get_the_ID();
              $title = get_the_title($id);
              $excerpt = get_the_excerpt($id);
              $excerpt_length = 300;
              $body = get_the_content($id);
              $link = get_permalink($id);
              $cta = "Read More";
              $block_class = "u-theme--border-color--darker u-border--left u-spacing";
            @endphp
            @include('patterns.01-molecules.blocks.content-block')
          @endwhile
          @if (shortcode_exists('ajax_load_more'))
            @php echo do_shortcode('[ajax_load_more container_type="div" css_classes="u-spacing--double" post_type="post, page" scroll="false" transition_container="false" button_label="Load More" posts_per_page="10" offset="10"]'); @endphp
          @endif
        @else
          <p>{{ __('Sorry, no results were found.', 'sage') }}</p>
          {!! get_search_form(false) !!}
        @endif
      </div>
    </article>
  </div>
</section>
