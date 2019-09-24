{{--
  Template Name: Posts Template
--}}
@php
  global $post;
  $post->ID = get_queried_object_id();
  $cf       = get_option( 'alps_cf_converted' );

  if ( $cf )  {

    $post_feed_list                 = carbon_get_post_meta( $post->ID, 'post_feed_list' );
    $post_feed_list_title           = carbon_get_post_meta( $post->ID, 'post_feed_list_title' );
    $post_feed_list_link            = carbon_get_post_meta( $post->ID, 'post_feed_list_link' );
    $post_feed_list_custom          = carbon_get_post_meta( $post->ID, 'post_feed_list_custom_array' );
    $post_feed_list_category        = carbon_get_post_meta( $post->ID, 'post_feed_list_category_array' );
    $post_feed_list_count           = carbon_get_post_meta( $post->ID, 'post_feed_list_count' );
    $post_feed_list_offset          = carbon_get_post_meta( $post->ID, 'post_feed_list_offset' );
    $post_feed_list_round           = carbon_get_post_meta( $post->ID, 'post_feed_list_round_image' );

    // PASS ID
    $post_feed_list_category        = $post_feed_list_category[0]['id'];

    // Full Width
    $post_feed_full                 = carbon_get_post_meta( $post->ID, 'post_feed_full' );
    $post_feed_full_title           = carbon_get_post_meta( $post->ID, 'post_feed_full_title' );
    $post_feed_full_link            = carbon_get_post_meta( $post->ID, 'post_feed_full_link' );
    $post_feed_full_category        = carbon_get_post_meta( $post->ID, 'post_feed_full_category_array' );
    $post_feed_full_featured        = carbon_get_post_meta( $post->ID, 'post_feed_full_featured' );
    $post_feed_full_featured_array  = carbon_get_post_meta( $post->ID, 'post_feed_full_featured_array' );
    $post_feed_full_offset          = carbon_get_post_meta( $post->ID, 'post_feed_full_offset' );

    // PASS ID
    $post_feed_full_featured_array  = $post_feed_full_featured_array[0]['id'];
    $post_feed_full_category        = $post_feed_full_category[0]['id'];

    // Archive
    $post_feed_archive              = carbon_get_post_meta( $post->ID, 'post_feed_archive' );
    $post_feed_archive_title        = carbon_get_post_meta( $post->ID, 'post_feed_archive_title' );
    $post_feed_archive_link         = carbon_get_post_meta( $post->ID, 'post_feed_archive_link' );
    $post_feed_archive_category     = carbon_get_post_meta( $post->ID, 'post_feed_archive_category_array' );
    $post_feed_archive_count        = carbon_get_post_meta( $post->ID, 'post_feed_archive_count' );
    $post_feed_archive_offset       = carbon_get_post_meta( $post->ID, 'post_feed_archive_offset' );

    // PASS ID
    $post_feed_archive_category     = $post_feed_archive_category[0]['id'];


  } else {

    $post_feed_list                 = get_alps_field( 'post_feed_list' );
    $post_feed_list_title           = get_alps_field( 'post_feed_list_title' );
    $post_feed_list_link            = get_alps_field( 'post_feed_list_link' );
    $post_feed_list_custom          = get_post_meta( $post->ID , 'post_feed_list_custom_array' );
    $post_feed_list_category        = get_alps_field( 'post_feed_list_category_array' );
    $post_feed_list_count           = get_alps_field( 'post_feed_list_count' );
    $post_feed_list_offset          = get_alps_field( 'post_feed_list_offset' );
    $post_feed_list_round           = get_alps_field( 'post_feed_list_round_image' );

    // Archive
    $post_feed_archive              = get_alps_field( 'post_feed_archive' );
    $post_feed_archive_title        = get_alps_field( 'post_feed_archive_title' );
    $post_feed_archive_link         = get_alps_field( 'post_feed_archive_link' );
    $post_feed_archive_category     = get_alps_field( 'post_feed_archive_category_array' );
    $post_feed_archive_count        = get_alps_field( 'post_feed_archive_count' );
    $post_feed_archive_offset       = get_alps_field( 'post_feed_archive_offset' );
  }

@endphp
@extends('layouts.app')
@section('content')

  @while(have_posts())
    {!! the_post() !!}
    @php
      if ( is_active_sidebar( 'sidebar-posts' ) && !get_alps_field( 'hide_sidebar' ) ) {
        $section_offset = 'u-shift--left--1-col--at-xxlarge';
        $article_offset = 'l-grid-item--xl--3-col';
      } else {
        $section_offset = 'u-shift--left--1-col--at-large';
        $article_offset = '';
      }
    @endphp
    <div>
      @include('patterns.02-organisms.sections.page-header')
      @if ( get_alps_field( 'show_hero_featured_post' ) )
        @include('patterns.02-organisms.sections.page-header-feature')
      @endif
    </div>
    <section class="c-section l-grid l-grid--7-col l-grid-wrap--6-of-7 u-spacing--double--until-large">
      <article class="c-article l-grid-item l-grid-item--l--4-col u-padding--zero--sides">
        @if (get_the_content())
          <div class="text u-spacing">
            @php the_content() @endphp
          </div>
        @endif
        @if ( $post_feed_list != 'post_feed_list_false' )
          <div class="c-block-wrap u-spacing--double">
            @if ( $post_feed_list_title || $post_feed_list_link )
              <div class="c-block__heading u-theme--border-color--darker">
                @if ( $post_feed_list_title )
                  <h3 class="c-block__heading-title u-theme--color--darker">{{ $post_feed_list_title }}</h3>
                @endif
                @if ($post_feed_list_link)
                  <a href="{{ $post_feed_list_link }}" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">See All</a>
                @endif
              </div>
            @endif
            @if ( $post_feed_list == 'post_feed_list_category' )
              @php
                if ( $post_feed_list_count ) {
                  $post_feed_list_count = $post_feed_list_count;
                } else {
                  $post_feed_list_count = 3;
                }
                $feed_posts = new WP_Query(array(
                  'post_type'       => 'post',
                  'posts_per_page'  => $post_feed_list_count,
                  'post_status'     => 'publish',
                  'category__in'    => $post_feed_list_category,
                  'order_by'        => 'date',
                  'offset'          => $post_feed_list_offset
                ));
              @endphp
              <div class="c-block-wrap__content u-spacing--double">
                @while ($feed_posts->have_posts())
                  @php
                    $feed_posts->the_post();
                    $picture    = NULL;
                    $id         = get_the_ID();
                    $title      = get_the_title($id);
                    $link       = get_permalink($id);
                    $date       = date('F j, Y', strtotime(get_the_date('', $id)));
                    $category   = get_the_category($id);
                    if ($category) {
                      if (class_exists('WPSEO_Primary_Term')) {
                        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                        $term = get_term($wpseo_primary_term);
                        if (is_wp_error($term)) {
                          $category = $category[0]->name;
                        } else {
                          $category = $term->name;
                        }
                      }
                      else {
                        $category = $category[0]->name;
                      }
                    }
                    $header_background_image = get_alps_field( 'header_background_image', $id );
                    if (!empty($header_background_image)) {
                      $thumb_id = $header_background_image;
                    } else if (get_post_thumbnail_id($id)) {
                      $thumb_id = get_post_thumbnail_id($id);
                    } else {
                      $thumb_id = NULL;
                    }
                    if ($thumb_id && $post_feed_list_round == 'true') {
                      $block_img_wrap_class = "u-round u-space--left";
                      $picture              = true;
                      $thumb_size           = 'thumbnail';
                      $image_s              = wp_get_attachment_image_src($thumb_id, $thumb_size)[0];
                      $image_m              = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_break_m        = '500';
                      $alt                  = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    } else if ($thumb_id) {
                      $picture              = true;
                      $thumb_size           = 'horiz__4x3';
                      $image_s              = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_m              = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                      $image_break_m        = '500';
                      $alt                  = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    }
                    $block_group_class    = "u-flex--justify-start";
                    $block_class          = "c-block__stacked--until-small u-spacing--until-small l-grid--7-col l-grid-wrap l-large-break";
                    $block_img_class      = "l-grid-item l-grid-item--s--2-col l-grid-item--l--1-col u-padding--zero--sides";
                    $block_content_class  = "l-grid-item l-grid-item--s--4-col l-grid-item--l--3-col u-flex--justify-start u-padding--left";
                    $block_title_class    = "u-theme--color--dark u-font--primary--l";
                    $block_meta_class     = "u-theme--color--base";
                  @endphp
                  @include('patterns.01-molecules.blocks.media-block')
                @endwhile
                {!! wp_reset_query() !!}
                {!! wp_reset_postdata() !!}
              </div>
            @elseif ( $post_feed_list == 'post_feed_list_custom' )
              @php
                // PASS ONLY VALUES TO POST__IN
                if ( !$cf ) {
                  $custom_post_ids = [];
                  foreach ( $post_feed_list_custom as $index => $id ) {
                    $custom_post_ids[] = $id;
                  }
                  $post_feed_list_custom = $custom_post_ids;
                } else {
                  $assigned = $post_feed_list_custom;
                  $selected = [];
                  foreach ( $assigned as $k => $entry ) {
                    foreach ( $entry as $key => $val ) {
                      if ( !empty($val) ) {
                        if ( $key == 'id' ) array_push( $selected, $val );
                      }
                    }
                  }
                  $post_feed_list_custom = $selected;
                }
                $custom_posts = new WP_Query(array(
                  'post_status'     => 'publish',
                  'post__in'        => $post_feed_list_custom,
                  'posts_per_page'  => count( $post_feed_list_custom ),
                ));

              @endphp
              <div class="c-block-wrap__content u-spacing--double">
                @while ($custom_posts->have_posts())
                  @php
                    $custom_posts->the_post();
                    $picture    = NULL;
                    $id         = $post->ID;
                    $title      = get_the_title($id);
                    $link       = get_permalink($id);
                    $date       = date('F j, Y', strtotime(get_the_date('', $id)));

                    $category   = get_the_category($id);
                    if ($category) {
                      if (class_exists('WPSEO_Primary_Term')) {
                        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                        $term = get_term($wpseo_primary_term);
                        if (is_wp_error($term)) {
                          $category = $category[0]->name;
                        } else {
                          $category = $term->name;
                        }
                      }
                      else {
                        $category = $category[0]->name;
                      }
                    }
                    $header_background_image = get_alps_field( 'header_background_image', $id );
                    if (!empty($header_background_image)) {
                      $thumb_id = $header_background_image;
                    } else if (get_post_thumbnail_id($id)) {
                      $thumb_id = get_post_thumbnail_id($id);
                    } else {
                      $thumb_id = NULL;
                    }
                    if ($thumb_id && $post_feed_list_round == 'true') {
                      $block_img_wrap_class = "u-round u-space--left";
                      $picture              = true;
                      $thumb_size           = 'thumbnail';
                      $image_s              = wp_get_attachment_image_src($thumb_id, $thumb_size)[0];
                      $image_m              = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_break_m        = '500';
                      $alt                  = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    } else if ($thumb_id) {
                      $picture              = true;
                      $thumb_size           = 'horiz__4x3';
                      $image_s              = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_m              = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                      $image_break_m        = '500';
                      $alt                  = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    }
                    $block_class          = "c-block__stacked--until-small u-spacing--until-small l-grid--7-col l-grid-wrap l-large-break";
                    $block_img_class      = "l-grid-item l-grid-item--s--2-col l-grid-item--l--1-col u-padding--zero--sides";
                    $block_content_class  = "l-grid-item l-grid-item--s--4-col l-grid-item--l--3-col u-flex--justify-start u-padding--left";
                    $block_title_class    = "u-theme--color--dark u-font--primary--l";
                    $block_meta_class     = "u-theme--color--base";

                  @endphp
                  @include('patterns.01-molecules.blocks.media-block')
                @endwhile
                {!! wp_reset_query() !!}
                {!! wp_reset_postdata() !!}
              </div>
            @endif
            @if ($post_feed_list_link)
              <a href="{{ $post_feed_list_link }}" class="o-button o-button--outline o-button--with-arrow u-space--left">See All<span class="u-icon u-icon--arrow--long u-theme--path-fill--base u-space--half--right">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span></a>
            @endif
          </div>
        @endif
      </article>
      @if (is_active_sidebar('sidebar-posts') && get_post_meta($post->ID, 'hide_sidebar', true) != 'true')
        <div class="c-sidebar l-grid-item l-grid-item--l--2-col u-padding--zero--sides">
          <div class="u-spacing--double u-padding--right">
            @php dynamic_sidebar('sidebar-posts') @endphp
          </div>
        </div> <!-- /.c-sidebar -->
      @endif
    </section>
    @if ($post_feed_full != 'post_feed_full_false')
      <section class="c-section l-grid l-grid--7-col l-grid-wrap--6-of-7">
        <div class="l-grid-item u-padding--zero--sides u-spacing--double">
          <div class="c-block-wrap u-spacing u-padding--right">
            @if ($post_feed_full_title || $post_feed_full_link)
              <div class="c-block__heading u-theme--border-color--darker">
                @if ($post_feed_full_title)
                  <h3 class="c-block__heading-title u-theme--color--darker">{{ $post_feed_full_title }}</h3>
                @endif
                @if ($post_feed_full_link)
                  <a href="{{ $post_feed_full_link }}" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">See All</a>
                @endif
              </div>
            @endif
            @if ( $post_feed_full_featured == 'post_feed_full_featured_true' )
              <div class="c-block-wrap__content u-spacing">
                @php
                  $picture    = NULL;
                  $id         = $post_feed_full_featured_array;
                  $title      = get_the_title($id);
                  $link       = get_permalink($id);
                  $date       = date('F j, Y', strtotime(get_the_date('', $id)));
                  $category   = get_the_category($id);
                  if ($category) {
                    if (class_exists('WPSEO_Primary_Term')) {
                      $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                      $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                      $term = get_term($wpseo_primary_term);
                      if (is_wp_error($term)) {
                        $category = $category[0]->name;
                      } else {
                        $category = $term->name;
                      }
                    }
                    else {
                      $category = $category[0]->name;
                    }
                  }
                  $header_background_image = get_alps_field( 'header_background_image', $id );
                  if (!empty($header_background_image)) {
                    $thumb_id = $header_background_image;
                  } else if (get_post_thumbnail_id($id)) {
                    $thumb_id = get_post_thumbnail_id($id);
                  } else {
                    $thumb_id = NULL;
                  }
                  if ($thumb_id) {
                    $picture        = true;
                    $thumb_size     = 'horiz__4x3';
                    $image_s        = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                    $image_m        = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                    $image_l        = wp_get_attachment_image_src($thumb_id, $thumb_size . '--l')[0];
                    $image_break_m  = '500';
                    $image_break_l  = '900';
                    $alt            = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                  }
                  $block_class          = "c-block__inline c-media-block__inine c-block--reversed c-media-block--reversed l-grid--7-col l-grid-wrap l-grid-wrap--6-of-7";
                  $block_img_wrap_class = NULL;
                  $block_img_class      = "l-grid-item l-grid-item--s--3-col u-padding--zero--sides";
                  $block_content_class  = "l-grid-item l-grid-item--s--3-col u-border-left--black--at-large u-theme--border-color--darker--left u-color--gray u-background-color--gray--light can-be--dark-dark u-padding--top u-padding--bottom u-flex--justify-between";
                  $block_title_class    = "u-theme--color--dark u-font--primary--l";
                  $block_meta_class     = "u-theme--color--base";
                @endphp
                @include('patterns.01-molecules.blocks.media-block')
                {!! wp_reset_postdata() !!}
              </div>
            @endif
          </div>
        </div>
      </section>
      @php $posts = $post_feed_full_category; @endphp
      @if ($posts)
        <section class="c-section l-section__block-row l-section__block-row--6-col l-grid l-grid--7-col">
          <div class="l-grid-item u-padding--zero--sides u-flex">
            @php
              $posts = new WP_Query(array(
                'post_type'       => 'post',
                'posts_per_page'  => 6,
                'post_status'     => 'publish',
                'category__in'    => $post_feed_full_category,
                'order_by'        => 'date',
                'post__not_in'    => $post_feed_full_featured_array,
                'offset'          => $post_feed_full_offset
              ));
            @endphp
            @while ($posts->have_posts())
              @php
                $posts->the_post();
                $picture    = NULL;
                $id         = get_the_ID();
                $title      = get_the_title($id);
                $link       = get_permalink($id);
                $date       = date('F j, Y', strtotime(get_the_date('', $id)));
                $category   = get_the_category($id);
                if ($category) {
                  if (class_exists('WPSEO_Primary_Term')) {
                    $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                    $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                    $term = get_term($wpseo_primary_term);
                    if (is_wp_error($term)) {
                      $category = $category[0]->name;
                    } else {
                      $category = $term->name;
                    }
                  }
                  else {
                    $category = $category[0]->name;
                  }
                }
                $header_background_image = get_alps_field( 'header_background_image',$id );
                if (!empty($header_background_image)) {
                  $thumb_id = $header_background_image;
                } else if (get_post_thumbnail_id($id)) {
                  $thumb_id = get_post_thumbnail_id($id);
                } else {
                  $thumb_id = NULL;
                }
                if ($thumb_id) {
                  $picture        = true;
                  $thumb_size     = 'horiz__4x3';
                  $image_s        = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                  $image_m        = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                  $image_break_m  = '500';
                  $image_break_l  = NULL;
                  $alt            = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                }
                $block_type           = get_post_format($id);
                $block_class          = "c-block__stacked c-media-block__stacked l-grid-wrap l-grid--7-col l-grid-item--3-col l-grid-item--m--2-col l-grid-item--xl--1-col";
                $block_img_wrap_class = NULL;
                $block_img_class      = "l-grid-item--3-col l-grid-item--m--2-col l-grid-item--xl--1-col u-padding--zero--sides u-space--right";
                $block_content_class  = "l-grid-item--3-col l-grid-item--m--2-col l-grid-item--xl--1-col u-border--left";
                $block_title_class    = "u-theme--color--dark u-font--primary--s";
                $block_meta_class     = "u-theme--color--base u-font--secondary--xs";
              @endphp
              @include('patterns.01-molecules.blocks.media-block')
            @endwhile
            {!! wp_reset_query() !!}
            {!! wp_reset_postdata() !!}
          </div>
        </section>
      @endif
    @endif
    @if ($post_feed_archive != 'post_feed_archive_false')
      <section class="c-section l-grid l-grid--7-col u-shift--left--1-col--at-large l-grid-wrap--6-of-7">
        <div class="c-article l-grid-item l-grid-item--l--4-col u-spacing--triple">
          <div class="c-block-wrap u-spacing--double">
            @if ($post_feed_archive_title || $post_feed_archive_link)
              <div class="c-block__heading u-theme--border-color--darker">
                @if ($post_feed_archive_title)
                  <h3 class="c-block__heading-title u-theme--color--darker">{{ $post_feed_archive_title }}</h3>
                @endif
                @if ($post_feed_archive_link)
                  <a href="{{ $post_feed_archive_link }}" class="c-block__heading-link u-theme--color--base u-theme--link-hover--dark">See All</a>
                @endif
              </div>
            @endif
            @php
              if ($post_feed_archive_count) {
                $post_feed_archive_count = $post_feed_archive_count;
              } else {
                $post_feed_archive_count = 10;
              }


              $archive_posts = new WP_Query(array(
                'post_type'       => 'post',
                'posts_per_page'  => $post_feed_archive_count,
                'post_status'     => 'publish',
                'category__in'    => $post_feed_archive_category,
                'order_by'        => 'date',
                'offset'          => $post_feed_archive_offset
              ));
            @endphp
            @if ($archive_posts->have_posts())
              <div class="c-block-wrap__content u-spacing--double">
                @while ($archive_posts->have_posts())
                  @php
                    $archive_posts->the_post();
                    $picture    = NULL;
                    $id         = get_the_ID();
                    $title      = get_the_title($id);
                    $link       = get_permalink($id);
                    $date       = date('F j, Y', strtotime(get_the_date('', $id)));
                    $category   = get_the_category($id);
                    if ($category) {
                      if (class_exists('WPSEO_Primary_Term')) {
                        $wpseo_primary_term = new WPSEO_Primary_Term('category', get_the_id());
                        $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
                        $term = get_term($wpseo_primary_term);
                        if (is_wp_error($term)) {
                          $category = $category[0]->slug;
                        } else {
                          $category = $term->slug;
                        }
                      }
                      else {
                        $category = $category[0]->slug;
                      }
                    }
                    $header_background_image = get_alps_field( 'header_background_image', $id );
                    if (!empty($header_background_image)) {
                      $thumb_id = $header_background_image;
                    } else if (get_post_thumbnail_id($id)) {
                      $thumb_id = get_post_thumbnail_id($id);
                    } else {
                      $thumb_id = NULL;
                    }
                    if ($thumb_id) {
                      $picture        = true;
                      $thumb_size     = 'horiz__4x3';
                      $image_s        = wp_get_attachment_image_src($thumb_id, $thumb_size . '--s')[0];
                      $image_m        = wp_get_attachment_image_src($thumb_id, $thumb_size . '--m')[0];
                      $image_break_m  = '500';
                      $alt            = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
                    }
                    $block_type           = NULL;
                    $block_class          = "c-block--reversed c-media-block--reversed l-grid-wrap l-grid-wrap--6-of-7  l-grid--7-col";
                    $block_img_class      = "l-grid-item--2-col l-grid-item--m--1-col l-grid-item--l--1-col u-padding--zero--sides";
                    $block_content_class  = "l-grid-item--4-col l-grid-item--m--3-col l-grid-item--l--3-col u-flex--justify-start u-border--left";
                    $block_title_class    = "u-theme--color--dark u-font--primary--l";
                    $block_meta_class     = "u-theme--color--base";
                  @endphp
                  @include('patterns.01-molecules.blocks.media-block')
                @endwhile
                {!! wp_reset_query() !!}
                {!! wp_reset_postdata() !!}
              </div>
            @endif
            @if ($post_feed_archive_link)
              <a href="{{ $post_feed_archive_link }}" class="o-button o-button--outline o-button--with-arrow u-space--left">{{ _e('See All', 'alps') }}<span class="u-icon u-icon--arrow--long u-theme--path-fill--base u-space--half--right">@include('patterns.00-atoms.icons.icon-arrow-long-right')</span></a>
            @endif
          </div>
        </div>
      </section>
    @endif
  @endwhile
@endsection
