@php
  global $post;
  $cf_ = '_';
  // SIDEBAR CONFIGURATION OPTIONS
  $active_sidebar = is_active_sidebar('sidebar-posts');
  $entry_hide_sidebar = get_post_meta($post->ID, $cf_.'hide_sidebar', true);
  $theme_hide_sidebar = get_alps_option('archive_hide_sidebar');

  // If has sidebar and hide sidebar is not true for entry or theme
  if ($active_sidebar && !$entry_hide_sidebar && !$theme_hide_sidebar) {
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xl--3-col';
  } else {
    $section_offset = 'u-shift--left--1-col--at-large';
    $article_offset = '';
  }
@endphp
@include('patterns.02-organisms.sections.page-header-hero')
<section id="top" class="l-main__content l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
  <article @php post_class("c-article l-grid-item l-grid-item--l--4-col $article_offset") @endphp>
    <div class="c-article__body">
      <div class="text u-spacing">
        @include('patterns.01-molecules.navigation.breadcrumbs')
        @if (is_active_sidebar('section-page-top'))
          @php dynamic_sidebar('section-page-top') @endphp
        @endif
        @php the_content() @endphp
        @include('patterns.02-organisms.sections.related-pages')
        @if (is_active_sidebar('section-page-bottom'))
          @php dynamic_sidebar('section-page-bottom') @endphp
        @endif

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
            $category = NULL;
            $date = NULL;
            $block_class = "u-spacing--half";
            $block_title_class = "u-theme--color--darker u-font--primary--m";
            $block_meta_class = "hide";
            if ($posts_image == "true") {
              $thumb_id = get_post_thumbnail_id($id);
            }
            else {
              $thumb_id = false;
            }
            if ($thumb_id) {
              $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
              if ($posts_grid == "true") {
                $excerpt_length = 25;
                $thumb_size = 'horiz__16x9';
                $block_class = "c-media-block__stacked c-block__stacked u-space--right u-space--double--bottom";
                $block_content_class = "u-border--left u-theme--border-color--darker--left";
                $picture = true;
                $image_s = wp_get_attachment_image_src($thumb_id, $thumb_size)[0];
                $image_m = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                $image_break_m = "500";
              }
              else {
                if ($posts_image_round == "true") {
                  $block_img_wrap_class = "u-round u-space--left";
                }
                else {
                  $block_img_wrap_class = "";
                }
                $excerpt_length = 35;
                $thumb_size = 'thumbnail';
                $thumb_id = get_post_thumbnail_id($id);
                $image = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                $block_group_class = "u-flex--justify-start";
                if (!is_active_sidebar('sidebar-posts') || $hide_sidebar == 'true') {
                  $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap";
                  $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col u-padding--zero--sides";
                  $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col";
                }
                else {
                  $block_class = "c-media-block__row c-block__row l-grid--7-col l-grid-wrap l-standard-break";
                  $block_img_class = "l-grid-item l-grid-item--2-col l-grid-item--m--1-col l-grid-item--xl--1-col u-padding--zero--sides";
                  $block_content_class = "l-grid-item l-grid-item--4-col l-grid-item--m--3-col l-grid-item--xl--2-col";
                }
              }
            }
            else {
              $thumb_id = NULL;
              if ($posts_grid == "true") {
                $block_class = "u-spacing u-padding--right u-space--double--bottom";
              }
            }
          @endphp
          @if ($posts_grid == "true")<div class="l-grid-item {{ $grid_item_class }}">@endif
            @if ($thumb_id)
              @include('patterns.01-molecules.blocks.media-block')
            @else
              @include('patterns.01-molecules.blocks.content-block')
            @endif
            @if ($posts_grid == "true")</div>@endif
        @endwhile
      </div>
    </div>
  </article>
  @if ($active_sidebar && !$theme_hide_sidebar  && !$entry_hide_sidebar)
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      <div class="u-spacing--double u-padding--right">
        @php dynamic_sidebar('sidebar-posts') @endphp
      </div>
    </div> <!-- /.c-sidebar -->
  @endif
</section>
