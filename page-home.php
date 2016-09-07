<?php
  // Get carousel format.
  $carousel_format = get_field('carousel_type');
?>
<?php if ($carousel_format == "large_format_2_col_4x3" || $carousel_format == "large_format_2_col_16x9"): ?>
  <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
<?php elseif ($carousel_format == "large_format_inset"): ?>
  <?php include(locate_template('patterns/components/hero-carousel.php')); ?>
<?php else: ?>
  <?php include(locate_template('patterns/components/hero-carousel__2-column.php')); ?>
<?php endif; ?>

  <div class="layout-container full--until-large">
      <div class="flex-container cf">
        <div class="shift-left--fluid column__primary bg--white can-be--dark-light no-pad--btm">
          <div class="spacing--double">
            <div class="pad--primary spacing text">
              <h2 class="font--tertiary--l theme--primary-text-color">Donec volutpat libero</h2>
              <p class="intro font--primary--m">Fusce interdum purus est, <a href="">vel semper ex tristique</a> ut. Proin dapibus luctus pellentesque. Duis et sapien sit amet enim porttitor gravida at non orci. Proin dictum lobortis luctus. Sed sagittis massa id blandit aliquet.</p>
    <figure class="figure size--large">
      <div class="img-wrap fitvid">
    <div class="fluid-width-video-wrapper" style="padding-top: 56.3333%;"><iframe src="https://player.vimeo.com/video/137487821?color=ffffff&amp;title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" id="fitvid574770"></iframe></div>
      </div> <!-- /.img-wrap -->
  <figcaption class="figcaption"><p class="font--secondary--xs">Proin dictum lobortis luctus.</p></figcaption>
    </figure> <!-- /.figure -->
            </div>

            <hr>
            <div class="pad--primary spacing--half">
    <div class="media-block block spacing--quarter ">


        <span class="kicker font--secondary--m upper theme--secondary-text-color db">Freundschaftsbezeigungen</span>

      <div class="media-block__inner spacing--quarter block__row">
          <a class="media-block__image-wrap block__image-wrap db" href="">
            <div class="round  dib"><img class="media-block__image block__image" src="http://placehold.it/150x150" alt="Media Block Image Alt Left Round"></div>
          </a> <!-- /.media-block__image-wrap -->


        <div class="media-block__content block__content ">

            <h3 class="media-block__title block__title "><a href="" class="block__title-link theme--primary-text-color">Cras at sem at felis rhoncus</a></h3>


          <div class="spacing--half">
              <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs">Sed neque odio, iaculis iaculis rutrum quis, iaculis vitae est. Aenean arcu est, congue ut eleifend a, luctus ultrices odio.</span></p></div>

              <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="">Cras at sem</a></p>
          </div> <!-- /.spacing -->

        </div> <!-- media-block__content -->
      </div> <!-- /.media-block__inner -->

    </div> <!-- /.media-block -->
            </div>
            <hr>
            <div class="pad--primary spacing--half">
    <div class="media-block block spacing--quarter ">



      <div class="media-block__inner spacing--quarter block__row">
          <a class="media-block__image-wrap block__image-wrap db" href="">
            <div class=" dib"><img class="media-block__image block__image" src="http://placehold.it/300x350" alt="Media Block Image Alt Left"></div>
          </a> <!-- /.media-block__image-wrap -->


        <div class="media-block__content block__content ">

            <h3 class="media-block__title block__title "><a href="" class="block__title-link theme--primary-text-color">Fusce interdum purus est</a></h3>


          <div class="spacing--half">
              <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs">Proin dictum lobortis luctus. Sed sagittis massa id blandit aliquet. Pellentesque semper tincidunt ex sit amet tincidunt.</span></p></div>

              <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="">Mauris sit amet</a></p>
          </div> <!-- /.spacing -->

        </div> <!-- media-block__content -->
      </div> <!-- /.media-block__inner -->

    </div> <!-- /.media-block -->
            </div>
            <hr>
            <div class="pad--primary spacing--half">
    <div class="media-block block spacing--quarter ">



      <div class="media-block__inner spacing--quarter block__row">
          <a class="media-block__image-wrap block__image-wrap db" href="">
            <div class=" dib"><img class="media-block__image block__image" src="http://placehold.it/300x200" alt="Media Block Image Alt Left Round"></div>
          </a> <!-- /.media-block__image-wrap -->


        <div class="media-block__content block__content ">

            <h3 class="media-block__title block__title "><a href="" class="block__title-link theme--primary-text-color">Sed neque odio, iaculis iaculis rutrum quis</a></h3>


          <div class="spacing--half">
              <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs">Etiam a dolor tortor. Nulla facilisi. Proin venenatis maximus dui, quis dapibus sem semper ut. Donec convallis ipsum ligula, at dapibus ex finibus in.</span></p></div>

          </div> <!-- /.spacing -->

        </div> <!-- media-block__content -->
      </div> <!-- /.media-block__inner -->

    </div> <!-- /.media-block -->
            </div>
            <hr>
            <div class="pad--primary spacing--half">
    <div class="media-block block spacing--quarter ">


        <span class="kicker font--secondary--m upper theme--secondary-text-color db">Aenean arcu</span>

      <div class="media-block__inner spacing--quarter block__row">
          <a class="media-block__image-wrap block__image-wrap db" href="">
            <div class=" dib"><img class="media-block__image block__image" src="http://placehold.it/300x300" alt="Media Block Image Alt Left Round"></div>
          </a> <!-- /.media-block__image-wrap -->


        <div class="media-block__content block__content ">

            <h3 class="media-block__title block__title "><a href="" class="block__title-link theme--primary-text-color">Pellentesque semper</a></h3>


          <div class="spacing--half">
              <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs">Nulla facilisi. Proin venenatis maximus dui, quis dapibus sem semper ut.</span></p></div>

              <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="">Cras at sem</a></p>
          </div> <!-- /.spacing -->

        </div> <!-- media-block__content -->
      </div> <!-- /.media-block__inner -->

    </div> <!-- /.media-block -->
            </div>
            <hr>

            <div class="pad--primary spacing--half text">
              <h3 class="brown font--tertiary--l">Nam efficitur</h3>
              <p>Fusce interdum purus est, vel semper ex tristique ut. Proin dapibus luctus pellentesque. Duis et sapien sit amet enim porttitor gravida at non orci. Proin dictum lobortis luctus. Sed sagittis massa id blandit aliquet. Pellentesque semper tincidunt ex sit amet tincidunt. Cras at sem at felis rhoncus varius eget vel ipsum.  <a href="" class="font--secondary--s upper"><strong>Vivamus orci magna</strong></a> </p>
            </div>
            <hr>
            <div class="pad--primary spacing--half text">
              <h3 class="brown font--tertiary--l">Donec interdum</h3>
              <p>Sed neque odio, iaculis iaculis rutrum quis, iaculis vitae est. Aenean arcu est, congue ut eleifend a, luctus ultrices odio. Etiam a dolor tortor. Nulla facilisi. Proin venenatis maximus dui, quis dapibus sem semper ut. Donec convallis ipsum ligula, at dapibus ex finibus in. Mauris sit amet augue gravida, dignissim sem maximus, aliquam metus. Maecenas eu consectetur orci, id auctor dui.  <a href="" class="font--secondary--s upper"><strong>Donec volutpat libero</strong></a> </p>
            </div>
            <hr>

  <div class="story-block block spacing--half pad " style="background-image: url(http://unsplash.it/g/1100/1100?blur)">
    <div class="story-block__image-wrap round">
      <img class="story-block__image" src="http://unsplash.it/200/200/?random" alt="Story Block Image Alt">
    </div>
    <div class="story-block__content spacing">
      <div>
        <h2 class="story-block__heading font--secondary--l theme--secondary-text-color">Bestseller</h2>
        <p class="font--secondary--xs white">The Clifford Goldstein Story</p>
      </div>
      <div class="spacing">
        <div class="text story-block__description block__description white">
            <a class="story-block__text-image-wrap space-half--btm" href="">
              <div class="is-video">
              <img class="story-block__text-image" src="http://unsplash.it/350/200/?random" alt="Text Image Alt">
              </div>
            </a> <!-- /.story-block__image-wrap -->
          <p>Clifford Goldstein didn’t believe in much, but one thing he did believe in was Truth. He just didn't know what it was or where to find it. As the fiery writer traveled Europe and Israel in search of his novel's soul, his quest for meaning of life continued, leading him to a different kind of altar.</p><p>Little did he know that one dark night in the summer of 1979, his search would end with a decision that would change his life forever.</p>
        </div>
          <p><a class="story-block__cta block__cta btn theme--secondary-background-color" href="">Find out more</a></p>
      </div> <!-- /.spacing -->
    </div> <!-- story-block__content -->
  </div> <!-- /.story-block -->

          </div>
        </div> <!-- /.shift-left--fluid -->
        <div class="shift-right--fluid bg--beige can-be--dark-dark">
            <div class="media-block block spacing--quarter bg--tan can-be--dark-dark block--breakout pad--secondary--for-breakouts">

                <h2 class="font--tertiary--m theme--primary-text-color pad--btm"><div class="icon icon--s"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 77.22 99.29"><title>List Icon</title><path d="M34.68,54.8H65.57V44.87H34.68V54.8ZM77.58,0.36H22.42a11.06,11.06,0,0,0-11,11V88.61a11.06,11.06,0,0,0,11,11H77.58a11.06,11.06,0,0,0,11-11V11.39A11.06,11.06,0,0,0,77.58.36Zm0,88.26H22.42V11.39H77.58V88.61ZM65.44,23.35H34.56V33H65.44V23.35Zm0,43.3H34.56v9.65H65.44V66.66Z" transform="translate(-11.39 -0.36)" fill="#010101" class="theme--primary-fill-color"></path></svg></div>  Nulla facilisi</h2>


              <div class="media-block__inner spacing--quarter ">


                <div class="media-block__content block__content ">



                  <div class="spacing--half">
                      <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs">Fusce porta sed odio eu dignissim. Vivamus imperdiet libero mattis orci aliquam imperdiet. Vivamus sit amet tortor nec magna tincidunt faucibus sit amet ac sem. Maecenas mattis nibh at urna feugiat posuere. Pellentesque blandit condimentum eros, fermentum ornare diam facilisis eget.</span></p></div>

                      <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="">Vestibulum non lectus</a></p>
                  </div> <!-- /.spacing -->

                </div> <!-- media-block__content -->
              </div> <!-- /.media-block__inner -->

            </div> <!-- /.media-block -->
          <div class="column__secondary can-be--dark-dark">
            <aside class="aside spacing--double">
              <div class="pad--secondary spacing--double">

                  <h3 class="font--tertiary--m theme--secondary-text-color">News</h3>
        <div class="media-block block spacing--quarter ">



          <div class="media-block__inner spacing--quarter block__row--small-to-large">
              <a class="media-block__image-wrap block__image-wrap db" href="">
                <div class=" dib"><img class="media-block__image block__image" src="http://placehold.it/500x400" alt="Media Block Image Alt"></div>
              </a> <!-- /.media-block__image-wrap -->


            <div class="media-block__content block__content ">

                <h3 class="media-block__title block__title font--secondary--m"><a href="" class="block__title-link theme--primary-text-color">Proin venenatis maximus</a></h3>

                <time class="block__date font--secondary--xs brown space-half--btm" datetime="2016-12-12">Mar 28, 2016</time>

              <div class="spacing--half">
                  <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs">Mauris sit amet augue gravida, dignissim sem maximus, aliquam metus. Maecenas eu consectetur orci, id auctor dui.</span></p></div>

                  <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="">Donec volutpat libero</a></p>
              </div> <!-- /.spacing -->

            </div> <!-- media-block__content -->
          </div> <!-- /.media-block__inner -->

        </div> <!-- /.media-block -->
        <div class="media-block block spacing--quarter ">



          <div class="media-block__inner spacing--quarter block__row--small-to-large">
              <a class="media-block__image-wrap block__image-wrap db" href="">
                <div class=" dib"><img class="media-block__image block__image" src="http://placehold.it/500x400" alt="Media Block Image Alt"></div>
              </a> <!-- /.media-block__image-wrap -->


            <div class="media-block__content block__content ">

                <h3 class="media-block__title block__title font--secondary--m"><a href="" class="block__title-link theme--primary-text-color">Proin venenatis maximus</a></h3>

                <time class="block__date font--secondary--xs brown space-half--btm" datetime="2016-12-12">Mar 28, 2016</time>

              <div class="spacing--half">
                  <div class="text text--s pad-half--btm"><p class="media-block__description block__description"><span class="font--primary--xs">Mauris sit amet augue gravida, dignissim sem maximus, aliquam metus. Maecenas eu consectetur orci, id auctor dui.</span></p></div>

                  <p><a class="media-block__cta block__cta btn theme--secondary-background-color" href="">Donec volutpat libero</a></p>
              </div> <!-- /.spacing -->

            </div> <!-- media-block__content -->
          </div> <!-- /.media-block__inner -->

        </div> <!-- /.media-block -->

                <div class="spacing">
                  <h3 class="font--tertiary--m theme--secondary-text-color">More News</h3>
                    <div class="content__block">
                      <h3 class="theme--primary-text-color font--secondary--m">Nam efficitur</h3>
                      <p>Proin dictum lobortis luctus. Sed sagittis massa id blandit aliquet.  <a href="" class="font--secondary--s upper theme--secondary-text-color"><strong>Vivamus orci magna</strong></a> </p>
                    </div>
                    <hr>
                    <div class="content__block">
                      <h3 class="theme--primary-text-color font--secondary--m">Donec interdum</h3>
                      <p>Proin dictum lobortis luctus. Sed sagittis massa id blandit aliquet.  <a href="" class="font--secondary--s upper theme--secondary-text-color"><strong>Donec volutpat libero</strong></a> </p>
                    </div>
                    <hr>
                </div>
              </div>
            </aside>
          </div>
        </div> <!-- /.shift-right--fluid -->
      </div> <!-- /.flex-container -->
    </div>
