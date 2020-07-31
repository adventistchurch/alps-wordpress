# Changelog
A record of the changes made to `ALPS for Wordpress`.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


##[3.5.x]
### Fixed
- Fixed the double-spacing betwen paragraphs on articles. [#480](https://github.com/adventistchurch/alps/issues/480)

##[3.5.4]
### Fixed
- Fixed to properly format the localized post date. [#327](https://github.com/adventistchurch/alps-wordpress/issues/327)

##[3.5.3]
### Fixed
- Adding support for `gt3pg-pro/grid` block.

##[3.5.2]
### Fixed
- Adding support for more kadance, gt3-photo-video-gallery, uagb, and kioken blocks.

##[3.5.1]
### Fixed
- Removing Qubely block support and adding support for two Kadence blocks.

##[3.5.0]
### Added
- ALPS version selector to allow an admin to set the version of ALPS used, including a "latest" option.  [#484](https://github.com/adventistchurch/alps-wordpress/issues/484)

##[3.4.13]
### Fixed
- Fixed: BUG in breakout box right margin [#490](https://github.com/adventistchurch/alps-wordpress/issues/490)

##[3.4.12]
### Fixed
- Fixed: External comment systems not working. [#493](https://github.com/adventistchurch/alps-wordpress/issues/493)

##[3.4.11]
### Fixed
- Fixed: Custom Logo set with WPML not Showing in 3.4.0 and forward [#469](https://github.com/adventistchurch/alps-wordpress/issues/469)

##[3.4.10]
### Added
- Added: Switched the jquery CDN to Cloudflare's version after running extensive WebpageTest.com checks on the top 5 jQuery CDN's. The Cloudflare URL came it much a litte faster then GoogleAPis.com and a bit faster then the jquery.com version.

##[3.4.9]
### Added
- Added: Added support for select `gutentor` and `qubely` blocks.

##[3.4.8]
### Fixed
- Fixed: adding cache busting for WP css/js [#487](https://github.com/adventistchurch/alps-wordpress/issues/478)

##[3.4.7]
### Fixed
- Fixed: & in categories displays as `&amp;` [#481](https://github.com/adventistchurch/alps-wordpress/issues/481)
- Fixed: Category Posts Feed Label setting not working. [#466](https://github.com/adventistchurch/alps-wordpress/issues/466)
- Fixed: Sabbath column hide settings working incorrectly. [#479](https://github.com/adventistchurch/alps-wordpress/issues/479)

### Added
- Added: a checkbox to disable images on the `Related Images` sidebar.


##[3.4.6]
### Added
- Added: Support for a custom field called `schemamarkup` to output JSON schema markup on a page.

### Fixed
- Fixed: Fixed an issue with `aligncenter` not centering images.
- Fixed: CTA buttons on Related pages to include the outlines.

##[3.4.5]
### Added
- Added: Core Table and Core Columns blocks for Gutenberg.

##[3.4.4]
### Fixed
- Fixed: Fixed an error with the footer schema not using the correct `itemprop` name for the `postalCode`.
- Fixed: Custom fields being hidden to prevent Piklist error. [#140](https://github.com/adventistchurch/alps-wordpress/issues/140)

##[3.4.3]
### Fixed
- Fixed: Comments not showing. [#462](https://github.com/adventistchurch/alps-wordpress/issues/462)

##[3.4.2]
### Fixed
- Fixed: CTA button missing from Full screen hero. [#476](https://github.com/adventistchurch/alps-wordpress/issues/476)

##[3.4.1]
### Fixed
- Fixed: The theme was missing the `hide-sabbath` class on all instances of the Sabbath column being hidden. [#29](https://github.com/adventistchurch/alps-gutenberg-blocks/issues/29)

##[3.4.0]
### Added
- Added: Site admins can now customize the homepage title (when using recent posts), customize the posts title, and use the various header settings on custom posts listing pages. [#337](https://github.com/adventistchurch/alps-wordpress/issues/337)

##[3.3.0]
### Added
- Added: A new Media Testimonies block. [#448](https://github.com/adventistchurch/alps-wordpress/pull/448)
- Added: Link underlines on sidebar menus. [#440](https://github.com/adventistchurch/alps/issues/440)

##[3.2.2]
### Fixed
- Fix: Fixed links when the related pages were set to child pages and resolving to the page id and not the freindly url. [#460](https://github.com/adventistchurch/alps-wordpress/issues/460)

##[3.2.1]
### Fixed
- Fix: Fixed an error that broke the gallery. [#455](https://github.com/adventistchurch/alps-wordpress/issues/455)

##[3.2.0]
### Fixed
- Fix: Buttons not available in Wordpress 5.4. [#451](https://github.com/adventistchurch/alps-wordpress/issues/451)
- Fix: add support for multilanguage logos [#443](https://github.com/adventistchurch/alps-wordpress/issues/443)

### Added
- Added: New "Full screen image with text and header overlay" [#445](https://github.com/adventistchurch/alps-wordpress/issues/443)


##[3.1.3]
### Fixed
- Fix: Theme update notifications [#422](https://github.com/adventistchurch/alps-wordpress/issues/422)

### Added
- Added: Enable Separator block [#403](https://github.com/adventistchurch/alps-wordpress/issues/403)


##[3.1.2]
### Fixed
- Fix: 4-digit Numbers appears on page when adding a 'Footer Logo Icon' [#437](https://github.com/adventistchurch/alps-wordpress/issues/437)

##[3.1.1]
### Fixed
- Fix for comment form not rendering correctly [#433](https://github.com/adventistchurch/alps-wordpress/issues/433)

##[3.1.0]
### Added
- Added a Hero Carousel slideshow with a maximum number of 6 images. [#318](https://github.com/adventistchurch/alps-wordpress/issues/318)


##[3.0.34]
### Fixed
- Fixed Guidepost css with the change of the Guidepost plugin.

##[3.0.33]
### Fixed
- Fixed the footer message. [#424](https://github.com/adventistchurch/alps-wordpress/issues/424)
- Update the location and name for the Guidepost plugin. [#427](https://github.com/adventistchurch/alps-wordpress/issues/427)
- Fixed header to use h1's for media blocks in the header. [#414](https://github.com/adventistchurch/alps-wordpress/issues/424)

##[3.0.32]
### Fixed
- Fixed the footer zipcode location. [#416](https://github.com/adventistchurch/alps-wordpress/issues/416)

##[3.0.31]
### Fixed
- Fixed the navigation bar covering ALPS elements for logged in users. [#391](https://github.com/adventistchurch/alps-wordpress/issues/391)

##[3.0.30]
### Fixed
- Removed custom jQuery version. Now it depends on the Wordpress version. [#362](https://github.com/adventistchurch/alps-wordpress/issues/362)


##[3.0.29]
### Fixed
- Fix to the header menu. [#409](https://github.com/adventistchurch/alps-wordpress/issues/409)

##[3.0.28]
### Fixed
- Removed requirement for the Gutenberg plugin. [#387](https://github.com/adventistchurch/alps-wordpress/pull/387)
- Removes shortcodes from expanding in teasers. [#390](https://github.com/adventistchurch/alps-wordpress/pull/390)

### Add
- Added support for the ARVE/NextGenThemes embed block.
- Adding License.txt file.

##[3.0.27-beta]
### Fixed
- Fixing the version_compare function operator. [#385](https://github.com/adventistchurch/alps-wordpress/issues/385)
- Updating theme incorrectly stops at WP version check. [#384](https://github.com/adventistchurch/alps-wordpress/issues/384)
- Remove Classic Editor Requirement. [#379](https://github.com/adventistchurch/alps-wordpress/issues/379)
- Fixes the display of the Guidepost blocks.


##[3.0.26-beta]
### Fixed
- Fixed Theme cache files not working in some hosting. [#358](https://github.com/adventistchurch/alps-wordpress/issues/358)

##[3.0.25-beta]
### Fixed
- Fixed a bug with the sidebar hiding and 3-up grids. [#376](https://github.com/adventistchurch/alps-wordpress/issues/376)

##[3.0.24-beta]
### Fixed
- Restoring deleted Piklist files.

##[3.0.23-beta]
### Fixed
- Fixed WPML Language Switcher. [#292](https://github.com/adventistchurch/alps-wordpress/issues/292)
- Fixed Display of Special Characters in Title Causes Error. [#367](https://github.com/adventistchurch/alps-wordpress/issues/367)
- Fixed Hero image text hover animation missing [#312](https://github.com/adventistchurch/alps-wordpress/issues/312)
- Fixed Console errors. [#365](https://github.com/adventistchurch/alps-wordpress/issues/365)
- Fixed Sidebar not hiding. [#371](https://github.com/adventistchurch/alps-wordpress/issues/371)

##[3.0.22-beta]
### Added
- Adding support for Tertiary menus. [#341](https://github.com/adventistchurch/alps-wordpress/pull/341)

##[3.0.21-beta]
### Added
- Added support for class, title, target, description and XFN attributes on menu links. [#349](https://github.com/adventistchurch/alps-wordpress/pull/349)
- Removed Piklist and replaced it with Carbon Fields. This new version now works properly on Wordpress 5, not requiring the switching back and forth betwen the Classic and Block editors. [#310](https://github.com/adventistchurch/alps-wordpress/pull/310)

##[3.0.19-beta]
### Fixed
- Version increment to fix deployment.

##[3.0.18-beta]
### Added
- Added the shortcode block to the editor.
- Added a feature to the `Latest Posts` block that allows you filter posts by `tags`. [#336](https://github.com/adventistchurch/alps-wordpress/issues/336)

##[3.0.17-beta]
### Fixed
- Fixes the footer logo missing when the Sabbath column is hidden. [#319](https://github.com/adventistchurch/alps-wordpress/issues/319)

##[3.0.16-beta]
### Fixed
- Fixes the breakout block on the wrong grid alignment. [#307](https://github.com/adventistchurch/alps-wordpress/issues/307)

##[3.0.15-beta]
## Added
- Adds a Latest Posts block [#285](https://github.com/adventistchurch/alps-wordpress/issues/285)

##[3.0.14-beta]
## Added
- Added full support of dropdown menus in secondary menus. This fix came from ALPS core [#361](https://github.com/adventistchurch/alps/issues/361)

### Fixed
- Fixed WPML language menu not attaching correctly to the secondary menu. [#266](https://github.com/adventistchurch/alps-wordpress/issues/266)
- Fixed the version numbering adding the beta number at the end instead of in the 0.0.x position.


##[3.0.13-beta]
### Fixed
- Fixed an issue with the paragraphs block not displaying functioning correctly. This removes the custom block and goes back to the default core paragraphs block. [#282](https://github.com/adventistchurch/alps-wordpress/issues/282)


##[3.0.12-beta]
### Fixed
- Fixed an issue with i18n phrases not using the correct function. [#279](https://github.com/adventistchurch/alps-wordpress/issues/279)

##[3.0.10-beta]
### Fixed
- Fixed the version number in the styles.css.

##[3.0.9-beta]
### Added
- i18n (internationalization) `.pot` file for translation.
- `es.po` and `es.mo` translation files. from [@bertobox](https://github.com/bertobox)
- More Gutenberg block types: List, Video, HTML, embed, button.
- Ability to translate the `Learn More` menu title.
- Switched

### Changed
- Updated the site branding statement to be more generic and force people to change it.
- Clarified `Posts Sidebar` region to `Posts Template Sidebar`.
- Removed unused `Default Tempalte`.
- Switched the download url for `alps-gutenberg-blocks` to a kernl.us url to pull it from the packaged source.

### Fixed
- Added pagination.
- Error with WPML causing white screen [#266](https://github.com/adventistchurch/alps-wordpress/issues/266)
- The requirements for the Gutenberg plugins.
- Issue with related pages not pulling the correct teaser or honoring the format settings. [#257](https://github.com/adventistchurch/alps-wordpress/issues/257)


##[3.0.8-alpha]
### Added
- Many changes. This is the first release.
