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
  * **Posts Template**: Landing page of posts in the category *news* (https://alps.adventist.io/v3/?p=pages-news)

### Add widgets to sidebar

1. In your WordPress admin panel, navigate to `Appearance->Widgets`
2. Drag widget to widget area
  * **Page Top**: A region at the top of a Page content type.
  * **Page Bottom**: A region at the bottom of a Page content type.
  * **Page Sidebar**: A region at the side of a Page content type.
  * **Post Sidebar**: A region at the side of a Post content type.
  * **Post Footer Region**: A region at the bottom of a Post content type.
  * **Footer Region**: A region at the bottom of any content type.

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

ALPS is developed using Sage, from roots.io.

## [Sage](https://roots.io/sage/)
[![Packagist](https://img.shields.io/packagist/vpre/roots/sage.svg?style=flat-square)](https://packagist.org/packages/roots/sage)
[![devDependency Status](https://img.shields.io/david/dev/roots/sage.svg?style=flat-square)](https://david-dm.org/roots/sage#info=devDependencies)
[![Build Status](https://img.shields.io/travis/roots/sage.svg?style=flat-square)](https://travis-ci.org/roots/sage)

Sage is a WordPress starter theme with a modern development workflow.

### Features

* Sass for stylesheets
* Modern JavaScript
* [Webpack](https://webpack.github.io/) for compiling assets, optimizing images, and concatenating and minifying files
* [Browsersync](http://www.browsersync.io/) for synchronized browser testing
* [Blade](https://laravel.com/docs/5.5/blade) as a templating engine
* [Controller](https://github.com/soberwp/controller) for passing data to Blade templates
* CSS framework (optional): [Bootstrap 4](https://getbootstrap.com/), [Bulma](https://bulma.io/), [Foundation](https://foundation.zurb.com/), [Tachyons](http://tachyons.io/)

See a working example at [roots-example-project.com](https://roots-example-project.com/).

### Requirements

Make sure all dependencies have been installed before moving on:

* [WordPress](https://wordpress.org/) >= 4.7
* [PHP](https://secure.php.net/manual/en/install.php) >= 7.1.3 (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 6.9.x
* [Yarn](https://yarnpkg.com/en/docs/install)

### Theme installation

Install Sage using Composer from your WordPress themes directory (replace `your-theme-name` below with the name of your theme):

```shell
# @ app/themes/ or wp-content/themes/
$ composer create-project roots/sage your-theme-name
```

To install the latest development version of Sage, add `dev-master` to the end of the command:

```shell
$ composer create-project roots/sage your-theme-name dev-master
```

During theme installation you will have options to update `style.css` theme headers, select a CSS framework, and configure Browsersync.

### Theme structure

```shell
themes/your-theme-name/   # → Root of your Sage based theme
├── app/                  # → Theme PHP
│   ├── controllers/      # → Controller files
│   ├── admin.php         # → Theme customizer setup
│   ├── filters.php       # → Theme filters
│   ├── helpers.php       # → Helper functions
│   └── setup.php         # → Theme setup
├── composer.json         # → Autoloading for `app/` files
├── composer.lock         # → Composer lock file (never edit)
├── dist/                 # → Built theme assets (never edit)
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── assets/           # → Front-end assets
│   │   ├── config.json   # → Settings for compiled assets
│   │   ├── build/        # → Webpack and ESLint config
│   │   ├── fonts/        # → Theme fonts
│   │   ├── images/       # → Theme images
│   │   ├── scripts/      # → Theme JS
│   │   └── styles/       # → Theme stylesheets
│   ├── functions.php     # → Composer autoloader, theme includes
│   ├── index.php         # → Never manually edit
│   ├── screenshot.png    # → Theme screenshot for WP admin
│   ├── style.css         # → Theme meta information
│   └── views/            # → Theme templates
│       ├── layouts/      # → Base templates
│       └── partials/     # → Partial templates
└── vendor/               # → Composer packages (never edit)
```

### Theme setup

Edit `app/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

### Theme development

* Run `yarn` from the theme directory to install dependencies
* Update `resources/assets/config.json` settings:
  * `devUrl` should reflect your local development hostname
  * `publicPath` should reflect your WordPress folder structure (`/wp-content/themes/sage` for non-[Bedrock](https://roots.io/bedrock/) installs)

### Localization
Theme uses WordPress recommended way to localize with *.po files. Localization template located in `lang/alps.pot`.
To add new language special software should be used (ex. POEdit).

To perform scan of new localizable strings in source files, run `npm run i18n-create-pot`.

[WPML plugin](https://wpml.org/) recommended for the multilingual websites.
Theme provides autogenerated file `lang/alps.php` to help WPML scan the strings for translation.

#### Build commands

* `yarn start` — Compile assets when file changes are made, start Browsersync session
* `yarn build` — Compile and optimize the files in your assets directory
* `yarn build:production` — Compile assets for production

### Documentation

* [Sage documentation](https://roots.io/sage/docs/)
* [Controller documentation](https://github.com/soberwp/controller#usage)

### Contributing

Contributions are welcome from everyone. We have [contributing guidelines](https://github.com/roots/guidelines/blob/master/CONTRIBUTING.md) to help you get started.

### Gold sponsors

Help support our open-source development efforts by [contributing to Sage on OpenCollective](https://opencollective.com/sage).

<a href="https://kinsta.com/?kaid=OFDHAJIXUDIV"><img src="https://roots.io/app/uploads/kinsta.svg" alt="Kinsta" width="200" height="150"></a> <a href="https://k-m.com/"><img src="https://roots.io/app/uploads/km-digital.svg" alt="KM Digital" width="200" height="150"></a>

### Community

Keep track of development and community news.

* Participate on the [Roots Discourse](https://discourse.roots.io/)
* Follow [@rootswp on Twitter](https://twitter.com/rootswp)
* Read and subscribe to the [Roots Blog](https://roots.io/blog/)
* Subscribe to the [Roots Newsletter](https://roots.io/subscribe/)
* Listen to the [Roots Radio podcast](https://roots.io/podcast/)

### Troubleshooting

Cache Error `vendor/illuminate/view/Engines/PhpEngine.php on line 43`:
* Fix by changing the folder permissions of `wp-content` and `uploads` to `777`.

## Add Secondary Nav icons

* In `Appearance > Menus`, select `Screen Options` in the top-right hand corner of your screen.
* Check `Title Attribute`
* Add menu items to nav that has the Display location set to `Secondary Naviation`
* Expand the menu item settings and add a `Title Attribute` with one of the following
  - contact
  - legal
  - language
  - find-a-church
  - sitemap
* IMPORTANT: You must use the title attributes above or you will get an error. They are case sensitive.
