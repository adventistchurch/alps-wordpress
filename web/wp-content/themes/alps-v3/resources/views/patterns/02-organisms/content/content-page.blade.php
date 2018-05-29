@include('patterns.02-organisms.sections.page-header')
@php
  if (is_active_sidebar('sidebar-primary')) {
    $offset = 'u-shift--left--1-col--at-xxlarge';
  } else {
    $offset = 'u-shift--left--1-col--at-large';
  }
@endphp
<section class="l-grid l-grid--7-col {{ $offset }} l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
  <article @php(post_class('c-article l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col'))>
    <div class="c-article__body">
      <div class="text u-spacing">
        @include('patterns.01-molecules.navigation.breadcrumbs')
        @php(the_content())
      </div>
    </div>
  </article>
  @if (is_active_sidebar('sidebar-primary'))
    <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-padding--zero--sides">
      <div class="u-spacing--double u-padding--right">
        {{ dynamic_sidebar('sidebar-primary') }}
      </div>
    </div> <!-- /.c-sidebar -->
  @endif
</section>
