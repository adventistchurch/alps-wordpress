<header class="c-page-header c-page-header__feature @if (isset($page_header_blocks)){{ 'c-page-header__3-col' }}@endif">
  <div class="c-page-header__content">
    @php
      if (isset($page_header_blocks)) {
        $title = '';
      } else {
        $title = '';
      }
    @endphp
    @include('patterns.01-molecules.blocks.media-block')
  </div>
</header> <!-- /.c-page-header -->
