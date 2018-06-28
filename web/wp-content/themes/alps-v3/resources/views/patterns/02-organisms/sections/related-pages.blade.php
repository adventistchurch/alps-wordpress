@php
  $related = get_post_meta($post->ID, 'related', true);
  if ($related == 'related_all') {
    // Loop of pages for child and grandchild pages
    $pages = get_pages(
      array(
        'child_of' => $post->ID,
        'post_type' => 'page',
        'post_status' => 'publish',
        'sort_column' => 'menu_order'
      )
    );
  } elseif ($related == 'related_custom') {
    // Loop of selected pages
    $pages = get_post_meta($post->ID, 'related_custom_value');
  } else {
    // Loop of pages for top level pages
    $pages = get_pages(
      array(
        'hierarchical' => 0,
        'parent' => $post->ID,
        'post_type' => 'page',
      	'post_status' => 'publish',
        'sort_column' => 'menu_order'
      )
    );
  }
@endphp
@if ($pages)
  <div class="u-spacing--double u-space--double--top">
    @foreach ($pages as $page)
      @php
        if ($related == 'related_all') {
          $id = $page->ID;
        } elseif ($related == 'related_custom') {
          $id = $page;
        } else {
          $id = $page->ID;
        }
        $title = get_the_title($id);
        $excerpt = get_the_excerpt($id);
        $excerpt_length = 300;
        $body = get_the_content($id);
        $link = get_permalink($id);
        $cta = "Read More";
        $block_class = "u-spacing--half";
        $block_title_class = "u-font--primary--m";
      @endphp
      @include('patterns.01-molecules.blocks.content-block')
    @endforeach
  </div>
@endif
@php(wp_reset_query())
