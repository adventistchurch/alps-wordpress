@php
  global $post;
  $cf = get_option('alps_cf_converted');
  $cf_ = '';
  if ($cf) {
    $cf_ = '_';
  }
  // SIDEBAR CONFIGURATION OPTIONS
  $active_sidebar = is_active_sidebar('sidebar-page');
  $entry_hide_sidebar = get_post_meta($post->ID, $cf_.'hide_sidebar', true);
  $theme_hide_sidebar = get_alps_option('index_hide_sidebar');

  // If has sidebar and hide sidebar is not true for entry or theme
  if ($active_sidebar && !$entry_hide_sidebar && !$theme_hide_sidebar) {
    $section_offset = 'u-shift--left--1-col--at-xxlarge';
    $article_offset = 'l-grid-item--xl--3-col';
  } else {
    $section_offset = 'u-shift--left--1-col--at-large';
    $article_offset = '';
  }
@endphp
@include('patterns.02-organisms.sections.page-header-hero')


        <section class="c-section c-section__highlight-blocks c-highlight-blocks u-theme--background-color--base u-color--white u-spacing">
          <div class="c-highlight-blocks__content">
                  <div class="c-highlight-blocks__content-item">
            <div class="o-number u-font--secondary--xxl">1</div>
            <p class="u-font--secondary--m">View our Bible study catalog</p>
          </div>
                  <div class="c-highlight-blocks__content-item">
            <div class="o-number u-font--secondary--xxl">2</div>
            <p class="u-font--secondary--m">Sign up for free with only your name and email</p>
          </div>
                  <div class="c-highlight-blocks__content-item">
            <div class="o-number u-font--secondary--xxl">3</div>
            <p class="u-font--secondary--m">Find answers and peace as you begin to understand God’s plan for your life</p>
          </div>
              </div>
              <button href="" class="o-button o-button--white">
        <span class="u-icon u-icon--xs u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>o-arrow__short--right</title><path d="M5,.09,3.62,1.5,6.12,4H.05V6H6.12L3.62,8.5,5,9.91,10,5Z" fill="#9b9b9b"></path></svg>
</span>
        Start a Bible Study
      </button>
      </section>

      <section id="top" class="l-main__content l-grid l-grid--7-col u-shift--left--1-col--at-xxlarge l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
        <article class="c-article l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col">
          <div class="c-article__body u-spacing--double">
              <div class="c-content-read-more u-spacing u-theme--border-color--base text">
    <h2>Yes, these steps look easy. Easy enough to set aside for "later." Easy enough to think that maybe they're not so important, or not so special. But that would be a mistake.</h2><p>The Bible tells the story of Naaman, the commander of the Syrian army. He contracted leprosy which was incurable and terminal. One of his slaves, an Israelite, suggested that he go to Samaria, where the prophet Elisha would be able to heal him.</p><p>Elisha told Naaman to go wash himself in the river Jordan, and to immerse himself seven times if he wanted to be healed. Naaman was insulted. That river was muddy and it was unacceptable for a high official to bath in it.</p>
    <button class="o-button o-button--outline js-toggle-parent">
      <span class="u-icon u-icon--xs u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10.01 10"><title>o-cion</title><path d="M10,2.31H0V0H10ZM6.36,3.85H0v2.3H6.36ZM8.22,7.7H0V10H8.22Z" fill="#231f20"></path></svg></span>
      <font>Read</font>
    </button>
  </div>
              <div class="c-split-highlight-content">
          <div class="c-split-highlight-content--left u-theme--background-color--base u-color--white u-padding">
        <span class="u-font--primary--l">If you are looking for something better, if you're looking for a way out of your troubles, we can help.</span>
      </div>
              <div class="c-split-highlight-content--right u-background-color--gray--light u-padding text">
        <p>The simple path we're offering will help you</p><ul><li>Find trustworthy answers</li><li>Experience total peace of mind</li><li>Live with purpose</li><li>Find forgiveness</li><li>See the world differently—understand why our lives are so full of trouble and at the same time, learn why there is hope.</li><li>Learn the end of the story, and find freedom, healing and hope in Jesus</li></ul>
                  <button href="" class="o-button o-button--primary">
            <span class="u-icon u-icon--xs u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 15 12.39"><title>icon-download</title><path d="M12.73,7.16H15v5.23H0V7.16H2.27v3H12.73ZM14.66,1.6,13.06,0,7.5,5.56,1.94,0,.34,1.6,7.5,8.76Z" fill="#231f20"></path></svg></span>
            Download Now
          </button>
              </div>
      </div>
          </div>
        </article>
      </section>
        <section class="c-testimonies-media u-spacing u-posititon--relative u-theme--background-color--darker u-color--white">
    <div class="c-testimonies-media--inner u-spacing--double">
      <div class="c-testimonies-media__heading">
        <div class="c-block__heading u-theme--border-color--base">
          <h3 class="c-block__heading-title">Testimonies</h3>
          <a href="#" class="c-block__heading-link u-theme--color--light u-theme--link-hover--lighter">See All</a>
        </div>
        <div class="o-dots" role="toolbar"><ul class="slick-dots" role="tablist" style="display: block;"><li class="slick-active" aria-hidden="false" role="presentation" aria-selected="true" aria-controls="navigation00" id="slick-slide00"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">1</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation01" id="slick-slide01"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">2</button></li><li aria-hidden="true" role="presentation" aria-selected="false" aria-controls="navigation02" id="slick-slide02"><button type="button" data-role="none" role="button" aria-required="false" tabindex="0">3</button></li></ul></div>
      </div>
      <div class="c-testimonies-media__blocks js-carousel__testimonies-media u-theme--gradient--right u-theme--gradient--left slick-initialized slick-slider">
                  <div aria-live="polite" class="slick-list draggable"><div class="slick-track" role="listbox" style="opacity: 1; width: 15000px; left: 0px;"><div class="c-testimonies-media__block slick-slide slick-current slick-active" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00">
              <div class="c-media-block c-block c-block c-media-block u-color--white">
          <div class="c-media-block__image c-block__image ">
        <div class="c-block__image-wrap ">
                      <picture class="picture">
              <!--[if IE 9]><video style="display: none;"><![endif]-->
                                          <source srcset="//picsum.photos/800/450" media="(min-width: 500px)">
              <!--[if IE 9]></video><![endif]-->
              <img itemprop="image" srcset="//picsum.photos/600/330" alt="Alt Text">
            </picture>
                  </div>
      </div>
      <!-- c-media-block__image -->
        <div class="c-media-block__content c-block__content u-spacing u-border--left u-theme--border-color--base">
      <div class="u-spacing c-block__group c-media-block__group u-flex--justify-start">
        <div class="u-width--100p u-spacing">
                                          <p class="c-media-block__description c-block__description">"Aenean quis velit vel purus est, vel semper ex tristique ut. Proin dapibus luctus pellentesque."</p>
                  </div>
        <div class="c-media-block__meta c-block__meta ">
                            </div>
                  <a href="" class="c-block__button o-button o-button--outline--white" tabindex="0">
                          <span class="u-icon u-icon--xs u-path-fill--base u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10.01 10"><title>o-cion</title><path d="M10,2.31H0V0H10ZM6.36,3.85H0v2.3H6.36ZM8.22,7.7H0V10H8.22Z" fill="#231f20"></path></svg></span>
                        Read more
                      </a>
              </div>
    </div>
    <!-- c-media-block__content -->
  </div>
  <!-- c-media-block -->
          </div><div class="c-testimonies-media__block slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide01">
              <div class="c-media-block c-block c-block c-media-block u-color--white">
          <div class="c-media-block__image c-block__image ">
        <div class="c-block__image-wrap ">
                      <picture class="picture">
              <!--[if IE 9]><video style="display: none;"><![endif]-->
                                          <source srcset="//picsum.photos/800/450" media="(min-width: 500px)">
              <!--[if IE 9]></video><![endif]-->
              <img itemprop="image" srcset="//picsum.photos/600/330" alt="Alt Text">
            </picture>
                  </div>
      </div>
      <!-- c-media-block__image -->
        <div class="c-media-block__content c-block__content u-spacing u-border--left u-theme--border-color--base">
      <div class="u-spacing c-block__group c-media-block__group u-flex--justify-start">
        <div class="u-width--100p u-spacing">
                                          <p class="c-media-block__description c-block__description">"Aenean quis velit vel purus est, vel semper ex tristique ut. Proin dapibus luctus pellentesque."</p>
                  </div>
        <div class="c-media-block__meta c-block__meta ">
                            </div>
                  <a href="" class="c-block__button o-button o-button--outline--white" tabindex="-1">
                          <span class="u-icon u-icon--xs u-path-fill--base u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10.01 10"><title>o-cion</title><path d="M10,2.31H0V0H10ZM6.36,3.85H0v2.3H6.36ZM8.22,7.7H0V10H8.22Z" fill="#231f20"></path></svg></span>
                        Read more
                      </a>
              </div>
    </div>
    <!-- c-media-block__content -->
  </div>
  <!-- c-media-block -->
          </div><div class="c-testimonies-media__block slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1" role="option" aria-describedby="slick-slide02">
              <div class="c-media-block c-block c-block c-media-block u-color--white">
          <div class="c-media-block__image c-block__image ">
        <div class="c-block__image-wrap ">
                      <picture class="picture">
              <!--[if IE 9]><video style="display: none;"><![endif]-->
                                          <source srcset="//picsum.photos/800/450" media="(min-width: 500px)">
              <!--[if IE 9]></video><![endif]-->
              <img itemprop="image" srcset="//picsum.photos/600/330" alt="Alt Text">
            </picture>
                  </div>
      </div>
      <!-- c-media-block__image -->
        <div class="c-media-block__content c-block__content u-spacing u-border--left u-theme--border-color--base">
      <div class="u-spacing c-block__group c-media-block__group u-flex--justify-start">
        <div class="u-width--100p u-spacing">
                                          <p class="c-media-block__description c-block__description">"Aenean quis velit vel purus est, vel semper ex tristique ut. Proin dapibus luctus pellentesque."</p>
                  </div>
        <div class="c-media-block__meta c-block__meta ">
                            </div>
                  <a href="" class="c-block__button o-button o-button--outline--white" tabindex="-1">
                          <span class="u-icon u-icon--xs u-path-fill--base u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10.01 10"><title>o-cion</title><path d="M10,2.31H0V0H10ZM6.36,3.85H0v2.3H6.36ZM8.22,7.7H0V10H8.22Z" fill="#231f20"></path></svg></span>
                        Read more
                      </a>
              </div>
    </div>
    <!-- c-media-block__content -->
  </div>
  <!-- c-media-block -->
          </div></div></div>


              </div>
      <div class="c-testimonies-media__buttons u-spacing--left--half">
        <button aria-label="Previous" class="o-button o-button--outline--white o-arrow o-arrow--prev slick-arrow slick-disabled" aria-disabled="true" style="display: flex;">
          <span class="u-icon u-icon--s u-path-fill--white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>o-arrow__bracket--right</title><path d="M3.25,6.41l3.5,3.5L8.16,8.5,4.66,5l3.5-3.5L6.75.09l-3.5,3.5L1.84,5Z" fill="#9b9b9b"></path></svg>
</span>
        </button>
        <button aria-label="Next" class="o-button o-button--outline--white o-arrow o-arrow--next slick-arrow" aria-disabled="false" style="display: flex;">
          <span class="u-icon u-icon--s u-path-fill--white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>Artboard 1</title><path d="M6.75,3.59,3.25.09,1.84,1.5,5.34,5,1.84,8.5,3.25,9.91l3.5-3.5L8.16,5Z" fill="#9b9b9b"></path></svg>
</span>
        </button>
                  <a href="" class="o-button o-button--outline--white">
            See all testimonies
            <span class="u-icon u-icon--m u-space--half--left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>o-arrow__long--left</title><path d="M18.29,8.59l-3.5-3.5L13.38,6.5,15.88,9H.29v2H15.88l-2.5,2.5,1.41,1.41,3.5-3.5L19.71,10Z" fill="#9b9b9b"></path></svg>
</span>
          </a>
              </div>
    </div>
  </section>
      <section class="l-main__content l-grid l-grid--7-col u-shift--left--1-col--at-xxlarge l-grid-wrap--6-of-7 u-spacing--double--until-xxlarge u-padding--zero--sides">
        <article class="c-article l-grid-item l-grid-item--l--4-col l-grid-item--xl--3-col">
          <div class="c-article__body u-spacing--double">
            <div class="c-home-body-content u-spacing u-theme--border-color--base text">
              <h2>Life is tough. We know that you want to be at peace and have hope for the future. In order to do that, you need trustworthy answers. The problem is, it's difficult to find your way through the maze of competing philosophies that always fail to clarify the Truth, which makes you feel confused and even helpless.</h2>
              <p>We believe evil should not prevail in keeping people from the Truth. We understand the challenges you face—we've faced them too. Which is why we have put a lot of effort into helping millions of people discover  freedom, healing, and hope - all based on the word of the living God - the Bible.</p>
              <p>Here's how we do it:</p>
                <div class="c-step-blocks">
          <div class="c-step-blocks__item u-theme--background-color--base u-color--white u-padding">
        <span class="o-kicker">Step 1</span>
        <p><strong>View our Bible study catalog</strong></p>
      </div>
          <div class="c-step-blocks__item u-theme--background-color--base u-color--white u-padding">
        <span class="o-kicker">Step 2</span>
        <p><strong>Sign up for free with only your name and email</strong></p>
      </div>
          <div class="c-step-blocks__item u-theme--background-color--base u-color--white u-padding">
        <span class="o-kicker">Step 3</span>
        <p><strong>Find answers and peace as you begin to understand God’s plan for your life</strong></p>
      </div>
      </div>
              <p>So check out the Bible Study Catalog. If you're in a hurry, download the free guide on how to study the Bible. And if you'd like to have us pray for you personally, send us a prayer request.</p>
              <p>You can stop drifting through life without answers. You don't have to miss out on the journey that can bring you everlasting life. You can find freedom, healing and hope in Jesus.</p>
              <p>He's waiting for you.</p>
              <button href="" class="o-button o-button--primary">
                <span class="u-icon u-icon--xs u-space--half--right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><title>o-arrow__short--right</title><path d="M5,.09,3.62,1.5,6.12,4H.05V6H6.12L3.62,8.5,5,9.91,10,5Z" fill="#9b9b9b"></path></svg>
</span>
                Start a bible study
              </button>
            </div>
          </div>
        </article>
      </section>
        <section id="QPNxmEviUOg" class="c-section c-section__video-full c-video-full js-video js-toggle">
    <div class="c-video-full__video fitvid u-gradient--bottom">
      <div class="fluid-width-video-wrapper" style="padding-top: 50%;"><iframe src="https://www.youtube.com/embed/QPNxmEviUOg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" id="fitvid632274"></iframe></div>
    </div>
    <div class="c-video-full__content">
      <span class="u-icon u-icon--xl u-space--right u-path-fill--white"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10.56 15"><title>icon-play</title><path d="M10.56,7.5,0,15V0Z" fill="#231f20"></path></svg></span>
      <div class="u-color--white">
        <h3 class="u-font--primary--l"><strong class="js-video-title">Casting a Vision – Revival for Mission</strong></h3>
        <strong class="u-font--secondary--s js-video-duration">29:29</strong>
      </div>
    </div>
  </section>
