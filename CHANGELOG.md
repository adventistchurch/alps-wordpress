## Change Log ##

### v2.2.0 ###
- [#133](https://github.com/adventistchurch/alps-wordpress/issues/133) Changing the way thumbnails on child pages are handled to give the option of either a circle or a rectangle/square.
- [#220](https://github.com/adventistchurch/alps-wordpress/issues/220) Fixing some IE11 errors.

### v2.1.9 ###
- Bug: Fixing a version error bug.

### v2.1.8 ###
- [#177](https://github.com/adventistchurch/alps-wordpress/issues/177) Bug: This Fixes an issue introduced with some changes to the Piklist extension. It fixes the ability to edit the home-row-blocks on the home template. 


### v2.1.7 ###
- Bug: This change reverses a fix made in `v2.1.5`. The Piklist module, in versions `0.9.9.14` and `0.9.9.15` removed the ablity to include multiple images. With no sign of a fix in 2 weeks from Piklist, we fixed the them. Then a day after we rolled out our fix, Piklist rolled out a new update, `0.9.9.16` with a fix, breaking our fix. This release brings the theme back to correct working conditions. Please accept our apologies for this mixup.

### v2.1.6 ###
- [#166](https://github.com/adventistchurch/alps-wordpress/issues/166) Feature: Add a method for selecting a category (or group of categories) on the appearance settings page that decides which categories of posts show on the News template page.

### v2.1.5 ### 
- [#164](https://github.com/adventistchurch/alps-wordpress/issues/164) Bug: Fixes an issue with a newer version of Piklist that caused uploaded pictures to not show.
- Feature: Added a .pot file for more internationalization options. If you would like to submit a .po file, we would be happy to include it for out of the box support for your language.

### v2.1.4 ### 
- [#161](https://github.com/adventistchurch/alps-wordpress/issues/161) Bug: This fixes and issue where the featured image was showing the first paragraph of the body field when the caption is missing.

### v2.1.3 ### 
- [#159](https://github.com/adventistchurch/alps-wordpress/issues/159) A fix for image and description sizing in IE11.

### v2.1.2 ### 
- [#157](https://github.com/adventistchurch/alps-wordpress/issues/157) Bug: The featured image wasn't showing the caption. When the caption is added, it will show up using the figcaption on the post.
- [#155](https://github.com/adventistchurch/alps-wordpress/issues/155) Feature: When selecting multiple catagories you can now set a primary catagory using the Yoast SEO plugin (optional).

### v2.1.1 ###
- [#153](https://github.com/adventistchurch/alps-wordpress/issues/153) Bug: Fix to a bug that prevented the color settings from sticking.
- [#151](https://github.com/adventistchurch/alps-wordpress/issues/151) Feature: Override of the caption shortcode to use ALPS markup.

### v2.1.0 ###
This release is a culmination of many smaller releases that add much better internationalization support to ALPS for Wordpress. Together with the [WPML plugin](https://wpml.org/), ALPS for Wordpress is now fully compatible in any language you need.

- [#145](https://github.com/adventistchurch/alps-wordpress/pull/145) This release give you full internationalziation support for logos, allowing any language configured in [WPML](https://wpml.org/) to have it's own custom language version of the logo.
- [#148](https://github.com/adventistchurch/alps-wordpress/pull/148) Fixes to remove exstra space when there is no body content on the homepage template.


### v2.0.7 ###
- [#134](https://github.com/adventistchurch/alps-wordpress/issues/134): Changes so the WPML the language chooser works in either the primary and secondary menus.
- A fix to remove the `bg--tan` color style from ALPS text widget.


### v2.0.6 ###
- [#102](https://github.com/adventistchurch/alps-wordpress/issues/102) Home Template Row Block: The Row Block item on the home template now allows users to select either pages or posts to be highlighted on the homepage.
- [#126](https://github.com/adventistchurch/alps-wordpress/issues/126) Updated the default logo to use the new versions.
- [#112](https://github.com/adventistchurch/alps-wordpress/issues/112) Support for Wide Logo: Site editors can now use the wide version of the church logo.
- [#127](https://github.com/adventistchurch/alps-wordpress/issues/127) Updates to the CDN URL: Uses the updated CDN url: https://cdn.adventist.org.
- [#128](https://github.com/adventistchurch/alps-wordpress/issues/128) Page title is now optional to include on the home template.
- [#119](https://github.com/adventistchurch/alps-wordpress/issues/119) Carousel Slide Title: The "title" item is no longer required on slides.
- [#121](https://github.com/adventistchurch/alps-wordpress/issues/121) Fix for Tertiary Navigation. Fixed errors on page with hide author
- [#124](https://github.com/adventistchurch/alps-wordpress/issues/124) Favicon Support: The theme now includes a  favicon file to match the theme colors.
- [#129](https://github.com/adventistchurch/alps-wordpress/issues/129) Subcontent on Landing Pages: Using the new "Landing Page" template, a user can limit the links to the sub-posts at the bottom of the page.

### v2.0.5 ###
Fixing issues with creating child themes and the primary menus.
- [#113](https://github.com/adventistchurch/alps-wordpress/issues/113) Child theme support.

### v2.0.4 ###
This is a bug squasher release, as well as a couple new features.

#### Features ####

- [#105](https://github.com/adventistchurch/alps-wordpress/issues/105) Fixing submenu items that weren't showing on narrow screens.
- [#104](https://github.com/adventistchurch/alps-wordpress/pull/104) Adding a new template called `Simple Full-Width` that removes the sidebars from the page.

#### Bugs ####
- [#158](https://github.com/adventistchurch/alps-wordpress/pull/95) Fix right-aligned text in the slider module.
- [#96](https://github.com/adventistchurch/alps-wordpress/pull/96) Option to hide the author on blog posts.

### v2.0.3 ###
A new bug fix release featuring 2 fixes:
 - [#90](https://github.com/adventistchurch/alps-wordpress/issues/90)  Inline images not keeping the right aspect ratio
 - [#93](https://github.com/adventistchurch/alps-wordpress/issues/93)  Reversed template change. After further testing, we found that the bug was affecting all ALPS installations. We moved the FIXES to ALPS.

### v2.0.2 ###
A new bug fix release featuring 3 fixes:

 - [#86](https://github.com/adventistchurch/alps-wordpress/issues/86) Display Errors in Internet Explorer 11 - bug
 - [#85](https://github.com/adventistchurch/alps-wordpress/issues/85) Single Page 100% grid layout - enhancement
 - [#84](https://github.com/adventistchurch/alps-wordpress/issues/84) Menu sub-items for mobile devices - bug

### v2.0.1 ###
- Fix to a minor error that caused Content Block freeform images to not display if you didn't include a URL in the block. [#81](https://github.com/adventistchurch/alps-wordpress/issues/81)

### v2.0.0 ###
 - The first release of the full ALPS for Wordpress theme full full support for 4 templates:
  * **Default Template**: Default template for all pages
  * **Home Template**: Includes story block and freeform/relationship post fields (http://alps.adventist.io/public/?p=templates-home)
  * **News Template**: Landing page of posts in the category *news* (http://alps.adventist.io/public/?p=organisms-news-content)
  * **Longform Template**: Provides a large, single column page that focuses on the content. (http://alps.adventist.io/public/?p=templates-longform)
  * **Single Template**: Provides a single column width page with the ablity to add rows with columns in varying widths (100, 70/30, 50/50, 30/70, images, and paralax images areas.) (http://alps.adventist.io/public/?p=templates-single-page)
