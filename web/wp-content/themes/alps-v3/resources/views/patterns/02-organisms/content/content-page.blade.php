@include('patterns.02-organisms.sections.page-header')
<section class="l-grid l-grid--7-col u-shift--left--1-col--at-xxlarge l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
  <article @php(post_class('c-article l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col'))>
    <div class="c-article__body">
      <div class="text u-spacing">
        @include('patterns.01-molecules.navigation.breadcrumbs')
        @php(the_content())
      </div>
    </div>
  </article>
  <div class="c-sidebar l-grid-item l-grid-item--l--2-col l-grid-item--xl--2-col u-spacing u-padding--zero--sides">
    {{ get_sidebar() }}
  </div> <!-- /.c-sidebar -->
</section>
