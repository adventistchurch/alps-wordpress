# ALPS WordPress Theme Setup


## Theme installation via WordPress Admin Panel

1. In your WordPress admin panel, navigate to `Appearance->Themes`
2. Click **Add New**
3. Click **Upload Theme**
4. Upload the zip file that you downloaded.


## Theme settings

### Set front and posts page

1. In your WordPress admin panel, navigate to `Settings->Reading`
2. Set **Front page displays** to a static page
3. Select a page from each dropdown
4. Save Changes

### Set page template

1. In your WordPress admin panel, navigate to `Pages`
2. Edit page
3. In the sidebar, navigate to **Page Attributes**
4. Select Template from the dropdown
  * **Default Template**: Default template for all pages
  * **Home Template**: Includes story block and freeform/relationship post fields (http://alps.adventist.io/public/?p=templates-home)
  * **News Template**: Landing page of posts in the category *news* (http://alps.adventist.io/public/?p=organisms-news-content)
  * **Long form Template**: Provides a large, single column page that focuses on the content. (http://alps.adventist.io/public/?p=templates-longform)
  * **Single Template**: Provides a single column width page with the ablity to add rows with columns in varying widths (100, 70/30, 50/50, 30/70, images, and paralax images areas.) (http://alps.adventist.io/public/?p=templates-single-page)

### Add widgets to sidebar

1. In your WordPress admin panel, navigate to `Appearance->Widgets`
2. Drag widget to widget area
  * **Primary Top** / **Primary Main** / **Primary Bottom** (Home Template): These areas allow you to put content at the top and bottom of the main content areas on the home template.
  * **Footer**: The area at the bottom of the page.
  * **Sidebar (Breakout Block)**: This area is located at the top of the sidebar, and is pulled out from the sidebar area a bit.
  * **Sidebar**: This is the main aside on the page.


### Add menus

1. In your WordPress admin panel, navigate to `Appearance->Menus`
2. Create a menu
3. Add links
4. Go to **Manage Locations** tab
5. Select location for the menu to appear
  * **Primary Navigation**: The main navigation for the page
  * **Secondary Navigation**: Appears above the main navigation
  * **Secondary Footer Navigation**: Appears above the main footer navigation
  * **Primary Footer Navigation**: The main footer navigation at the bottom of the page
  * **Tertiary Navigation**: Appears below the page header on the *News Template*



# ALPS WordPress Theme Development

Sage uses [gulp](http://gulpjs.com/) as its build system.

### [Sage](https://roots.io/sage/)

Sage is a WordPress starter theme based on HTML5 Boilerplate, gulp, and Sass, that will help you make better themes.

* Source: [https://github.com/roots/sage](https://github.com/roots/sage)
* Homepage: [https://roots.io/sage/](https://roots.io/sage/)
* Documentation: [https://roots.io/sage/docs/](https://roots.io/sage/docs/)

## Install gulp

Building the theme requires [node.js](http://nodejs.org/download/). We recommend you update to the latest version of npm: `npm install -g npm@latest`.

From the command line:

1. Install [gulp](http://gulpjs.com) and [Bower](https://bower.io/) globally with npm install -g gulp bower
2. Navigate to the theme directory, then run `npm install`
3. Run `bower install`

You now have all the necessary dependencies to run the build process.

## Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).

## Using BrowserSync

To use BrowserSync during `gulp watch` you need to update `devUrl` at the bottom of `assets/manifest.json` to reflect your local development hostname.

For example, if your local development URL is `http://alps-wp.test` you would update the file to read:
```json
...
  "config": {
    "devUrl": "http://alps-wp.test"
  }
...
```


## Documentation

Sage documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).


## Requirements

| Prerequisite    | How to check | How to install
| --------------- | ------------ | ------------- |
| PHP >= 5.4.x    | `php -v`     | [php.net](http://php.net/manual/en/install.php) |
| Node.js 0.12.x  | `node -v`    | [nodejs.org](http://nodejs.org/) |
| gulp >= 3.8.10  | `gulp -v`    | `npm install -g gulp` |

For more installation notes, refer to the [Install gulp](#install-gulp) section in this document.


## Features

* [gulp](http://gulpjs.com/) build script that compiles both Sass and Less, checks for JavaScript errors, optimizes images, and concatenates and minifies files
* [BrowserSync](http://www.browsersync.io/) for keeping multiple browsers and devices synchronized while testing, along with injecting updated CSS and JS into your browser while you're developing
* [asset-builder](https://github.com/austinpray/asset-builder) for the JSON file based asset pipeline
* [Theme wrapper](https://roots.io/sage/docs/theme-wrapper/)
* ARIA roles and microformats
* Posts use the [hNews](http://microformats.org/wiki/hnews) microformat
* [Multilingual ready](https://roots.io/wpml/) and over 30 available [community translations](https://github.com/roots/sage-translations)
