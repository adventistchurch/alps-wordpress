@php
  $heroType = get_post_meta($postsRootPostId, '_hero_type', true);
  $isHero = $heroType && $heroType !== 'false';
@endphp

@if ($isHero)
  @include('patterns.01-molecules.blocks.header-block-hero')
@else
  @include('patterns.01-molecules.blocks.header-block')
@endif
