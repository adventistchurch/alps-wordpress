<div class="c-share-tools js-hover">
  <a href="" class="c-share-tools__toggle can-be--white o-kicker u-theme--color--base"><span class="u-icon u-icon--xs u-theme--path-fill--base u-space--quarter--right">@include('patterns.00-atoms.icons.icon-share')</span>{{ _e("Share", "sage") }}</a>
  <ul class="c-share-tools__list u-background-color--gray--light can-be--dark-dark u-theme--border-color--darker--left u-spacing--half u-padding--half">
    <li class="c-share-tools__list-item">
      <a class="c-share-tools__link u-theme--color--base" href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">{{ _e("Facebook", "sage") }}</a>
    </li>
    <li class="c-share-tools__list-item">
      <a class="c-share-tools__link u-theme--color--base" href="https://twitter.com/intent/tweet/?text=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" target="_blank">{{ _e("Twitter", "sage") }}</a>
    </li>
    <li class="c-share-tools__list-item">
      <a class="c-share-tools__link u-theme--color--base" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">{{ _e("Google", "sage") }}</a>
    </li>
    <li class="c-share-tools__list-item">
      <a class="c-share-tools__link u-theme--color--base" href="mailto:?subject=<?php the_title(); ?>" target="_self">{{ _e("Email", "sage") }}</a>
    </li>
  </ul>
</div> <!-- /.c-share-tools -->
