@php
  /**
   * Header: Featured
   *
   * @var string $headerTitle
   * @var string $headerTitleLink
   * @var string $headerDesc
   * @var string $headerKicker
   * @var string $headerImageCaption
   * @var string $headerDate
   * @var string $headerCategory
   * @var string $headerImages
   */
    $mediaBlockTitle = $headerTitle;
    $mediaBlockTitleLink = '';
    $mediaBlockDesc = $headerDesc;
    $mediaBlockDate = $headerDate;
    $mediaBlockCategory = $headerCategory;
    $mediaBlockImageCaption = $headerImageCaption;
    $mediaBlockImages = $headerImages;
    $mediaBlockKicker = $headerKicker;
@endphp
<header class="c-page-header c-page-header__feature">
  <div class="c-page-header__content">
    @include('patterns.01-molecules.blocks.media-block-v2')
  </div>
</header>
