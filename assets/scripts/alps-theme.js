/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var ALPS = {
    // All pages
    'common': {
      init: function() {
        // Add class to footer description links
        $('.footer__desc-text a').addClass('link--white');

        // Add classes to submenu items in the primary navigation.
        $('.current_page_parent, .current_page_item').children('a').removeClass('theme--primary-text-color').addClass('theme--secondary-text-color active');
        $('.primary-nav__subnav').children('li').removeClass('primary-nav__list-item').addClass('primary-nav__subnav__list-item');
        $('.primary-nav__subnav').children().children('a').removeClass('primary-nav__link').addClass('primary-nav__subnav__link');
        $('<div class="primary-nav__subnav__arrow nav__subnav__arrow va--middle js-toggle-parent"><span class="arrow--down"></span></div>').insertAfter('.primary-nav--with-subnav > .primary-nav__link, .secondary-nav--with-subnav > .secondary-nav__link');
        $('.article-nav__subnav > li').removeClass('article-nav__list-item dropdown__item').addClass('article-nav__subnav__list-item');
        $('.article-nav__subnav > li > a').removeClass('article-nav__link dropdown__item-link white').addClass('article-nav__subnav__link');
        $('.dropdown__label + .article-nav__subnav__arrow').remove();
        $('.theme-widget-social').removeClass('text');

        $('.widget').filter(function() {
            return $.trim($(this).text()) === '' && $(this).children().length == 0
        }).remove()

        // Toggle parent class
        $(document).on('click', '.nav__subnav__arrow', function(e) {
          e.preventDefault();
          var $this = $(this);
          $this.toggleClass('is-active');
          $this.parent().toggleClass('is-active');
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = ALPS;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
