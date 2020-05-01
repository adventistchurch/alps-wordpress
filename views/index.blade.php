@extends('layouts.app')
@section('content')

  @if (is_archive() && get_option( 'page_for_posts' ))
    @php
      $mainPostId = get_option( 'page_for_posts' );
    @endphp
    @include('index_posts')
  @else
    @php
      $hide_sidebar = get_alps_option('index_hide_sidebar');
      if (is_archive()) {
          $hide_sidebar = $hide_sidebar || get_alps_option('archive_hide_sidebar');
      }

      $posts_grid = get_alps_option('posts_grid');
      $post_grid_3up = get_alps_option('posts_grid_3up');
      $posts_image = get_alps_option('posts_image');
      $posts_image_round = get_alps_option('posts_image_round');
      if (is_active_sidebar('sidebar-posts') && $hide_sidebar != 'true') {
        $section_offset = 'u-shift--left--1-col--at-xxlarge';
        $article_offset = 'l-grid-item--xl--3-col';
      }
      else {
        $section_offset = 'u-shift--left--1-col--at-large';
        $article_offset = '';
      }
    @endphp
    @include('patterns.02-organisms.sections.page-header')
    <section id="top" class="l-main__content l-grid l-grid--7-col {{ $section_offset }} l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
      <article @php post_class("c-article l-grid-item l-grid-item--l--4-col $article_offset") @endphp>
        <div class="c-article__body">
          @if (is_active_sidebar('category-top'))
            @php dynamic_sidebar('category-top') @endphp
          @endif
          @if (have_posts())
            <div class="text u-spacing--double u-space--double--top">
              @php
                if ($posts_grid == "true") {
                  if (!is_active_sidebar('sidebar-posts') || $hide_sidebar == 'true') {
                    if ($post_grid_3up == 'true') {
                      $grid_class = "l-grid-item--6-col l-grid-item--l--4-col l-grid-item--xl--6-col u-shift--right--1-col--at-large u-shift--left--1-col--at-xlarge u-shift--left--1-col--standard u-no-gutters ";
                      $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
                    }
                    else {
                      $grid_class = "l-grid-item--6-col l-grid-item--m--4-col u-no-gutters";
                      $grid_item_class = "l-grid-item--xs--3-col l-grid-item--m--2-col";
                    }
                  }
                  else {
                    $grid_class = "l-grid-item--6-col l-grid-item--l--4-col u-shift--left--1-col--standard u-no-gutters";
                    $grid_item_class = "l-grid-item--s--3-col l-grid-item--l--2-col";
                  }
                  echo '<div class="l-grid l-grid--7-col ' . $grid_class . '">';
                }
              @endphp
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
              @if ($posts_grid == "true")</div>@endif
            </div>
            {!! wp_reset_query() !!}
            @if (shortcode_exists('ajax_load_more'))
              {!! do_shortcode('[ajax_load_more container_type="div" css_classes="u-spacing--double" post_type="post" category="'. get_the_category()[0]->slug .'" scroll="false" transition_container="false" button_label="Load More" posts_per_page="10" offset="10"]') !!}
            @else
              @php pagination_nav() @endphp
            @endif
          @else
            <p class="u-padding--left">{{ _e('Sorry, no results were found.', 'alps') }}</p>
          @endif
          @if (is_active_sidebar('category-bottom'))
            @php dynamic_sidebar('category-bottom') @endphp
          @endif
        </div>
      </article>
      @if (is_active_sidebar('sidebar-posts') && $hide_sidebar != 'true')
        <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
          <div class="u-spacing--double u-padding--right">
            @php dynamic_sidebar('sidebar-posts') @endphp
          </div>
        </div> <!-- /.c-sidebar -->
      @endif
    </section>
  @endif
@endsection
