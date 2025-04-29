<div class="text u-spacing">
    @php the_content() @endphp
    @php
        wp_link_pages([
            'before' => '<div class="page-links">',
            'after'  => '</div>',
        ]);
    @endphp
</div>
