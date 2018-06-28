<nav class="bg--tan aside-nav pad--secondary column__secondary can-be--dark-dark" id="aside-nav" role="navigation">
  <div class="spacing">
    <?php
      $menu_args = array(
        'echo' => false,
        'menu_class' => 'aside-nav__list spacing--quarter',
        'container' => false,
        'depth' => 1,
        'theme_location' => 'sidebar_navigation',
      );

      // Native WordPress menu classes to be replaced.
      $replace = array(
        'menu-item ',
        '<a',
      );

      // Custom ALPS classes to replace.
      $replace_with = array(
        'aside-nav__list-item rel ',
        '<a class="aside-nav__link theme--primary-text-color font--primary--xs"',
      );
    ?>
    <?php if (has_nav_menu('sidebar_navigation')): ?>
      <?php echo str_replace($replace, $replace_with, wp_nav_menu($menu_args)); ?>
      <hr class="theme--primary-transparent-background-color--30">
    <?php endif; ?>
    <ul class="aside-nav__list spacing--quarter">
      <li class="aside-nav__list-item rel"><a class="aside-nav__link theme--primary-text-color font--primary--xs" href="https://twitter.com/adventistnews" target="_blank"><span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="-491 493.2 16.6 13.8"><path d="M-474.5,495.2c-0.4,0.7-1,1.2-1.6,1.7v0.4c0,0.9-0.1,1.7-0.4,2.6c-0.2,0.9-0.6,1.7-1.1,2.5 c-0.5,0.8-1.1,1.5-1.8,2.1c-0.7,0.6-1.6,1.1-2.6,1.4c-1,0.4-2.1,0.5-3.2,0.5c-1.9,0-3.6-0.4-4.9-1.3c0.3,0,0.5,0.1,0.8,0.1 c1.4,0,2.7-0.5,4-1.5c-0.7,0-1.3-0.2-1.9-0.6c-0.5-0.4-0.9-0.9-1.1-1.6c0.2,0,0.4,0.1,0.6,0.1c0.3,0,0.6,0,0.9-0.1 c-0.7-0.1-1.3-0.5-1.8-1.1c-0.5-0.6-0.7-1.3-0.7-2v0c0.5,0.3,0.9,0.4,1.4,0.4c-1-0.6-1.4-1.5-1.4-2.7c0-0.5,0.1-1,0.4-1.6 c0.8,1,1.8,1.8,2.9,2.3c1.1,0.6,2.4,0.9,3.7,1c0-0.2-0.1-0.5-0.1-0.7c0-0.9,0.3-1.6,0.9-2.3c0.6-0.6,1.4-0.9,2.3-0.9 c0.9,0,1.7,0.3,2.4,1c0.7-0.1,1.4-0.4,2-0.8c-0.2,0.8-0.7,1.4-1.4,1.8C-475.7,495.7-475.1,495.5-474.5,495.2z"></path></svg></span> Twitter</a></li>
      <li class="aside-nav__list-item rel"><a class="aside-nav__link theme--primary-text-color font--primary--xs" href="https://www.facebook.com/AdventistNews" target="_blank"><span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="-491 493.4 16.6 16.5"><path d="M-475,508.4c0,0.5-0.4,1-1,1h-3.9v-6.1h1.9l0.3-2.2h-2.3v-1.8c0-0.6,0.3-1,1-1h1.5v-2 c0,0-0.7-0.1-1.6-0.1c-2.1,0-3.2,1.2-3.2,3v1.9h-1.9v2.2h1.9v6.1h-7.4c-0.5,0-1-0.4-1-1v-13.6c0-0.5,0.4-1,1-1h13.6c0.5,0,1,0.4,1,1 V508.4z"></path></svg></span> Facebook</a></li>
      <li class="aside-nav__list-item rel"><a class="aside-nav__link theme--primary-text-color font--primary--xs" href="https://www.flickr.com/photos/adventistnewsnetwork/" target="_blank"><span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.63 44.28"><path d="M21.9,72.61a22.14,22.14,0,0,1,0-44.28A22.14,22.14,0,0,1,21.9,72.61Zm56.19,0A22.14,22.14,0,1,1,99.81,50.48,21.93,21.93,0,0,1,78.09,72.61Z" transform="translate(-0.19 -28.33)"></path></svg></span> Flickr</a></li>
      <li class="aside-nav__list-item rel"><a class="aside-nav__link theme--primary-text-color font--primary--xs" href="https://www.youtube.com/user/AdventistNewsNetwork" target="_blank"><span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 97.45 68.54"><path d="M97.75,30.52s-1-6.72-3.87-9.67C90.17,17,86,16.94,84.11,16.72c-13.64-1-34.09-1-34.09-1h0s-20.46,0-34.09,1C14,16.94,9.83,17,6.12,20.84c-2.92,3-3.87,9.67-3.87,9.67a147.37,147.37,0,0,0-1,15.77v7.39a147.37,147.37,0,0,0,1,15.77s1,6.72,3.87,9.67C9.83,83,14.7,82.88,16.87,83.29c7.8,0.75,33.13,1,33.13,1s20.48,0,34.11-1C86,83,90.17,83,93.88,79.13c2.92-3,3.87-9.67,3.87-9.67a147.59,147.59,0,0,0,1-15.77V46.29A147.59,147.59,0,0,0,97.75,30.52ZM39.94,62.64V35.26L66.27,49Z" transform="translate(-1.28 -15.73)"></path></svg></span> YouTube</a></li>
      <li class="aside-nav__list-item rel"><a class="aside-nav__link theme--primary-text-color font--primary--xs" href="https://vimeo.com/adventistnewsnetwork" target="_blank"><span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99 88"><path d="M99,27.12C93.48,58.87,62.57,85.75,53.27,91.89s-17.78-2.46-20.86-9C28.89,75.52,18.34,35.32,15.58,32S4.52,35.32,4.52,35.32l-4-5.37S17.34,9.46,30.15,6.9C43.74,4.18,43.72,28.15,47,41.46c3.16,12.87,5.29,20.24,8,20.24s8-7.18,13.82-18.18S68.6,22.77,57.29,29.68C61.81,2,104.54-4.62,99,27.12Z" transform="translate(-0.5 -6)"></path></svg></span> Vimeo</a></li>
      <li class="aside-nav__list-item rel"><a class="aside-nav__link theme--primary-text-color font--primary--xs" href="mailto:AdventistNews@gc.adventist.org"><span class="icon icon--s va--tbtm"><svg class="theme--primary-fill-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 99.3 79.87"><path d="M96.92,10.25L1.64,43.83c-1.53.54-1.87,1.86-.05,2.59l20.48,8.21h0l12.15,4.87L93.49,16a0.81,0.81,0,0,1,1.14,1.14L52.15,63h0l-2.44,2.72,3.23,1.74h0L79.82,82a2.75,2.75,0,0,0,4.06-1.81L99.56,12.58C100,10.73,98.77,9.6,96.92,10.25ZM34.1,88.65c0,1.33.75,1.7,1.79,0.76C37.24,88.18,51.26,75.6,51.26,75.6L34.1,66.72V88.65Z" transform="translate(-0.35 -10.07)"></path></svg></span> Email</a></li>
    </ul> <!-- /.aside-nav__list -->
  </div>
</nav>
