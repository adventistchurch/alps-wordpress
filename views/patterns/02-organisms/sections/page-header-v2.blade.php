@php
  $isHero = (bool)get_post_meta($postsRootPostId, '_hero_type', true);
@endphp

@if ($isHero)
  @include('patterns.01-molecules.blocks.header-block-hero')
@else
  @include('patterns.01-molecules.blocks.header-block')
@endif

