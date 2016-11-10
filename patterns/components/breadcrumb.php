<?php
function wordpress_breadcrumbs()
{
  $name = 'Home'; //text for the 'Home' link
  $currentBefore = '<li class="breadcrumbs__list-item font--secondary--xs upper dib"><a class="breadcrumbs__link can-be--white">';
  $currentAfter = '</a></li>';
  $li_class = 'breadcrumbs__list-item font--secondary--xs upper dib';
  $link_class = 'breadcrumbs__link can-be--white';
  if (!is_home() && !is_front_page() || is_paged()) {
    echo '<nav class="breadcrumbs" role="navigation"><ul class="breadcrumbs__list">';
    global $post;
    $home = get_bloginfo('url');
    echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . $home . '">' . $name . '</a></li>';
    if (is_category()) {
      global $wp_query;
      $cat_obj   = $wp_query->get_queried_object();
      $thisCat   = $cat_obj->term_id;
      $thisCat   = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0)
        echo (get_category_parents($parentCat, TRUE, ''));
      echo $currentBefore . 'Archive by category &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
    } elseif (is_day()) {
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a></li>';
      echo $currentBefore . get_the_time('d') . $currentAfter;
    } elseif (is_month()) {
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>';
      echo $currentBefore . get_the_time('F') . $currentAfter;
    } elseif (is_year()) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
    } elseif (is_single()) {
      $cat = get_the_category();
      $cat = $cat[0];
      echo '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . home_url( '/' ) . $cat->category_nicename . '">' . $cat->name . '</a></li>';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif (is_page() && !$post->post_parent) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif (is_page() && $post->post_parent) {
      $parent_id   = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page          = get_page($parent_id);
        $breadcrumbs[] = '<li class="' . $li_class . '"><a class="' . $link_class . '" href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id     = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb)
        echo $crumb . '';
      echo $currentBefore;
      the_title();
      echo $currentAfter;
    } elseif (is_search()) {
      echo $currentBefore . 'Search results for &#39;' . get_search_query() . '&#39;' . $currentAfter;
    } elseif (is_tag()) {
      echo $currentBefore . 'Posts tagged &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
    } elseif (is_author()) {
      global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Articles posted by ' . $userdata->display_name . $currentAfter;
    } elseif (is_404()) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
    if (get_query_var('paged')) {
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
        echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
        echo ')';
    }
    echo '</nav>';
  }
}
?>

<?php if (function_exists('wordpress_breadcrumbs')) wordpress_breadcrumbs(); ?>
