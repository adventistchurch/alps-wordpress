# ALPS WordPress Theme

ALPS specific documentation to come. ALPS theme is based off of the WordPress starter theme, [Sage](https://roots.io/sage/).

# [Sage](https://roots.io/sage/)

Sage is a WordPress starter theme based on HTML5 Boilerplate, gulp, and Sass, that will help you make better themes.

* Source: [https://github.com/roots/sage](https://github.com/roots/sage)
* Homepage: [https://roots.io/sage/](https://roots.io/sage/)
* Documentation: [https://roots.io/sage/docs/](https://roots.io/sage/docs/)

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

## Theme installation via WordPress Admin Panel

1. In your WordPress admin panel, navigate to Appearance->Themes
2. Click Add New
3. Click Upload Theme
4. Upload the zip file that you downloaded.

## Theme settings

Set front and posts page
1. In your WordPress admin panel, navigate to *Settings->Reading*
2. Set *Front page displays* to a static page
3. Select a page from each dropdown
4. Save Changes

Set page template
1. In your WordPress admin panel, navigate to *Pages*
2. Edit page
3. In the sidebar, navigate to *Page Attributes**
4. Select Template from the dropdown

Add widgets to sidebar
1. In your WordPress admin panel, navigate to *Appearance->Widgets*
2. Drag widget to widget area
    * **Primary Top**: Appears on *Home Template* above the main content
    * **Primary Main**: Appears on *Home Template* within the content
    * **Primary Bottom**: Appears on *Home Template* below the main content
    * **Sidebar (Breakout Block)**: Appears at the top in the right rail
    * **Sidebar**: Appears in the right rail

Add menus
1. In your WordPress admin panel, navigate to *Appearance->Menus*
2. Create a menu
3. Add links
4. Go to *Manage Locations* tab
5. Select location for the menu to appear
    * **Primary Navigation**: The main navigation for the page
    * **Secondary Navigation**: Appears above the main navigation
    * **Secondary Footer Navigation**: Appears above the main footer navigation
    * **Primary Footer Navigation**: The main footer navigation at the bottom of the page
    * **Tertiary Navigation**: Appears below the page header on the *News Template*

## Theme development

Sage uses [gulp](http://gulpjs.com/) as its build system.

### Install gulp

Building the theme requires [node.js](http://nodejs.org/download/). We recommend you update to the latest version of npm: `npm install -g npm@latest`.

From the command line:

1. Install [gulp](http://gulpjs.com) globally with `npm install -g gulp`
2. Navigate to the theme directory, then run `npm install`

You now have all the necessary dependencies to run the build process.

### Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).

### Using BrowserSync

To use BrowserSync during `gulp watch` you need to update `devUrl` at the bottom of `assets/manifest.json` to reflect your local development hostname.

For example, if your local development URL is `http://alps-wp.dev` you would update the file to read:
```json
...
  "config": {
    "devUrl": "http://alps-wp.dev"
  }
...
```

## Documentation

Sage documentation is available at [https://roots.io/sage/docs/](https://roots.io/sage/docs/).

## Contributing

Contributions are welcome from everyone. We have [contributing guidelines](https://github.com/roots/guidelines/blob/master/CONTRIBUTING.md) to help you get started.

## Community

Keep track of development and community news.

* Participate on the [Roots Discourse](https://discourse.roots.io/)
* Follow [@rootswp on Twitter](https://twitter.com/rootswp)
* Read and subscribe to the [Roots Blog](https://roots.io/blog/)
* Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
* Listen to the [Roots Radio podcast](https://roots.io/podcast/)
