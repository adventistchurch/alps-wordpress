@if ($headerType === \App\TemplateHelpers::POST_HEADER_TYPE_HERO)
  @include('patterns.01-molecules.blocks.header-block-hero')
@elseif ($headerType === \App\TemplateHelpers::POST_HEADER_TYPE_FEATURED)
  @include('patterns.01-molecules.blocks.header-block-featured')
@else
  @include('patterns.01-molecules.blocks.header-block')
@endif
