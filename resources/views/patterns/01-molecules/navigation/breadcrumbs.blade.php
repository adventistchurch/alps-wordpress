@if (is_front_page() or is_home())
@elseif (function_exists('yoast_breadcrumb'))
  <nav class="c-breadcrumbs" role="navigation">
    @php yoast_breadcrumb('<ul class="c-breadcrumbs__list">','</ul>') @endphp
  </nav>
@endif
