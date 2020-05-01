@php
  global $post;
  $post = get_post($mainPostId);
  setup_postdata($post);
@endphp
@include('patterns.02-organisms.content.content-archive')
