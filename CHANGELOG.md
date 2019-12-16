# Changelog
A record of the changes made to `ALPS for Wordpress`.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).


## 3.0.32-adventist]
### Fixed
- Fixing broken hardcoded image links.

## 3.0.31-adventist]
### Fixed
- Fixed header menus. #409

## [3.0.30]
### Fixed
- Fixed homepage content.

## [3.0.29]
### Forked
- This is a forked version of the main ALPS for Wordpress theme that is created for Adventist.org. Eventually this will get merged back into the main branch.

## [3.0.28]
### Fixed
- Removed requirement for the Gutenberg plugin. [#387](https://github.com/adventistchurch/alps-wordpress/pull/387)
- Removes shortcodes from expanding in teasers. [#390](https://github.com/adventistchurch/alps-wordpress/pull/390)

### Add
- Added support for the ARVE/NextGenThemes embed block.
- Adding License.txt file.

## [3.0.27-beta]
### Fixed
- Fixing the version_compare function operator. [#385](https://github.com/adventistchurch/alps-wordpress/issues/385)
- Updating theme incorrectly stops at WP version check. [#384](https://github.com/adventistchurch/alps-wordpress/issues/384)
- Remove Classic Editor Requirement. [#379](https://github.com/adventistchurch/alps-wordpress/issues/379)
- Fixes the display of the Guidepost blocks.

## [3.0.26-beta]
### Fixed
- Fixed Theme cache files not working in some hosting. [#358](https://github.com/adventistchurch/alps-wordpress/issues/358)

## [3.0.25-beta]
### Fixed
- Fixed a bug with the sidebar hiding and 3-up grids. [#376](https://github.com/adventistchurch/alps-wordpress/issues/376)

## [3.0.24-beta]
### Fixed
- Restoring deleted Piklist files.

## [3.0.23-beta]
### Fixed
- Fixed WPML Language Switcher. [#292](https://github.com/adventistchurch/alps-wordpress/issues/292)
- Fixed Display of Special Characters in Title Causes Error. [#367](https://github.com/adventistchurch/alps-wordpress/issues/367)
- Fixed Hero image text hover animation missing [#312](https://github.com/adventistchurch/alps-wordpress/issues/312)
- Fixed Console errors. [#365](https://github.com/adventistchurch/alps-wordpress/issues/365)
- Fixed Sidebar not hiding. [#371](https://github.com/adventistchurch/alps-wordpress/issues/371)

## [3.0.22-beta]
### Added
- Adding support for Tertiary menus. [#341](https://github.com/adventistchurch/alps-wordpress/pull/341)

## [3.0.21-beta]
### Added
- Added support for class, title, target, description and XFN attributes on menu links. [#349](https://github.com/adventistchurch/alps-wordpress/pull/349)
- Removed Piklist and replaced it with Carbon Fields. This new version now works properly on Wordpress 5, not requiring the switching back and forth betwen the Classic and Block editors. [#310](https://github.com/adventistchurch/alps-wordpress/pull/310)

## [3.0.19-beta]
### Fixed
- Version increment to fix deployment.

## [3.0.18-beta]
### Added
- Added the shortcode block to the editor.
- Added a feature to the `Latest Posts` block that allows you filter posts by `tags`. [#336](https://github.com/adventistchurch/alps-wordpress/issues/336)

## [3.0.17-beta]
### Fixed
- Fixes the footer logo missing when the Sabbath column is hidden. [#319](https://github.com/adventistchurch/alps-wordpress/issues/319)

## [3.0.16-beta]
### Fixed
- Fixes the breakout block on the wrong grid alignment. [#307](https://github.com/adventistchurch/alps-wordpress/issues/307)

## [3.0.15-beta]
## Added
- Adds a Latest Posts block [#285](https://github.com/adventistchurch/alps-wordpress/issues/285)

## [3.0.14-beta]
## Added
- Added full support of dropdown menus in secondary menus. This fix came from ALPS core [#361](https://github.com/adventistchurch/alps/issues/361)

### Fixed
- Fixed WPML language menu not attaching correctly to the secondary menu. [#266](https://github.com/adventistchurch/alps-wordpress/issues/266)
- Fixed the version numbering adding the beta number at the end instead of in the 0.0.x position.


## [3.0.13-beta]
### Fixed
- Fixed an issue with the paragraphs block not displaying functioning correctly. This removes the custom block and goes back to the default core paragraphs block. [#282](https://github.com/adventistchurch/alps-wordpress/issues/282)


## [3.0.12-beta]
### Fixed
- Fixed an issue with i18n phrases not using the correct function. [#279](https://github.com/adventistchurch/alps-wordpress/issues/279)

## [3.0.10-beta]
### Fixed
- Fixed the version number in the styles.css.

## [3.0.9-beta]
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


## [3.0.8-alpha]
### Added
- Many changes. This is the first release.
