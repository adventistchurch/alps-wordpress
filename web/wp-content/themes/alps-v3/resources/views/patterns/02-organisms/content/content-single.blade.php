@include('patterns.02-organisms.sections.page-header-feature')
<section class="l-grid l-grid--7-col u-shift--left--1-col--at-xxlarge l-grid-wrap--6-of-7 u-spacing--double--until-large">
  <div class="c-article l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col">
    <article @php(post_class('text c-article__body u-spacing--double has-dropcap'))>
      @php(the_content())
    </article>
  </div>
  <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
    @include('patterns.02-organisms.asides.related-stories')
  </div>
</section>
<section class="l-grid l-grid--7-col u-shift--left--1-col--at-xxlarge l-grid-wrap l-grid-wrap--6-of-7">
  <article class="c-article l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col">
    <div class="text c-article__body u-spacing--double">
      @if ($highlight)
        @include('patterns.01-molecules.text.highlight')
      @endif
      @if ($gallery_block)
        @include('patterns.01-molecules.blocks.gallery-block')
      @endif
      @if ($story_block)
        @include('patterns.01-molecules.blocks.content-block-expand')
      @endif
      @include('patterns.02-organisms.sections.article-footer')
    </div>
  </article>
  <div class="c-sidebar l-grid-item l-grid-item--m--2-col l-grid-item--l--2-col">
  </div>
</section>
