@include('patterns.02-organisms.sections.page-header-feature')
<section class="l-grid l-grid--7-col u-shift--left--1-col--at-xxlarge l-grid-wrap--6-of-7 u-spacing--double--until-large">
  <div class="c-article l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col">
    <article @php(post_class('ext c-article__body u-spacing--double has-dropcap'))>
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
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada, est ut viverra euismod, dui dolor gravida massa, sed aliquam ex nisl ut metus. Mauris at ante laoreet, gravida odio gravida, fermentum lectus. Fusce ac sollicitudin purus. Morbi et diam nunc. Praesent fringilla magna nisl, et volutpat nisi tincidunt aliquet. In laoreet ligula vel porttitor condimentum. In mattis ultricies placerat. Morbi interdum hendrerit tempus. Donec consequat elit vitae justo ornare, eget elementum quam consequat. Quisque auctor ex et congue finibus. Proin sed nisl ac velit aliquam euismod non tincidunt lectus. In enim ex, commodo feugiat porttitor sed, eleifend vitae ipsum. Suspendisse lorem nisl, suscipit at tellus quis, porttitor convallis sem.</p>
      @if ($highlight)
        @include('patterns.01-molecules.text.highlight')
      @endif
      <p>Vestibulum ipsum orci, egestas eu erat non, posuere maximus quam. Quisque tincidunt turpis id accumsan hendrerit. Cras eleifend, arcu sit amet faucibus blandit, dolor urna euismod sem, non molestie nulla nulla porta nibh. Integer commodo arcu vitae nisl iaculis, non hendrerit arcu sodales. Vivamus sagittis quam ut elit posuere ultrices. In blandit erat orci, vitae posuere enim vehicula quis. Nullam posuere mauris odio, eu facilisis lorem iaculis ut. Aenean tortor turpis, sollicitudin ut est eget, mattis feugiat arcu. Etiam est magna, aliquet ut blandit sit amet, malesuada a lacus. Nam scelerisque arcu non sem auctor molestie. Vestibulum sit amet congue ex.</p>
      @if ($gallery_block)
        @include('patterns.01-molecules.blocks.gallery-block')
      @endif
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada, est ut viverra euismod, dui dolor gravida massa, sed aliquam ex nisl ut metus. Mauris at ante laoreet, gravida odio gravida, fermentum lectus. Fusce ac sollicitudin purus. Morbi et diam nunc. Praesent fringilla magna nisl, et volutpat nisi tincidunt aliquet. In laoreet ligula vel porttitor condimentum. In mattis ultricies placerat. Morbi interdum hendrerit tempus. Donec consequat elit vitae justo ornare, eget elementum quam consequat. Quisque auctor ex et congue finibus. Proin sed nisl ac velit aliquam euismod non tincidunt lectus. In enim ex, commodo feugiat porttitor sed, eleifend vitae ipsum. Suspendisse lorem nisl, suscipit at tellus quis, porttitor convallis sem.</p>
      @if ($story_block)
        @include('patterns.01-molecules.blocks.content-block-expand')
      @endif
      <div>
        @include('patterns.02-organisms.sections.article-footer')
      </div>
    </div>
  </article>
  <div class="c-sidebar l-grid-item l-grid-item--m--2-col l-grid-item--l--2-col">
  </div>
</section>
