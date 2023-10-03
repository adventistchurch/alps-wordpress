# ALPS WordPress Theme Setup

![](https://img.shields.io/badge/Required_PHP_version-8.1.23-green) ![](https://img.shields.io/badge/Required_WP_version-6.1.1-blue)


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
* **Posts Template**: Landing page of posts in the category *news* 
  * (~~https://alps.adventist.io/v3/?p=pages-news~~) - _deprecated_
  * (https://adventistchurch.github.io/alps/?path=/story/templates-news--no-aside) - new

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

* [WordPress](https://wordpress.org/) >= 6.1^
* [PHP](https://secure.php.net/manual/en/install.php) >= 8.1 (with [`php-mbstring`](https://secure.php.net/manual/en/book.mbstring.php) enabled)
* [Composer](https://getcomposer.org/download/)
* [Node.js](http://nodejs.org/) >= 18.x

### Theme structure

```shell
themes/your-theme-name/   # → Root of your Sage based theme
├── app/                  # → Theme PHP
│   ├── carbon-fields     # → Carbon fields plugin for Theme Settings
│   ├── Core              # → Utils functionality for theme support
│   ├── local             # → folder for storing styles on your local env
│   │   ├── alps          # → folder with generated css and js files 
│   │   └── source        # → folder with source css and js files. After generation of this folder files will store in the /alps folder 
│   ├── Providers/        # → Service providers
│   ├── View/             # → View models
│   ├── filters.php       # → Theme filters
│   └── setup.php         # → Theme setup
├── devtools/             # → Build, release scripts for release theme 
├── composer.json         # → Autoloading for `app/` files
├── public/               # → Built theme assets (never edit)
├── functions.php         # → Theme bootloader
├── index.php             # → Theme template wrapper
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── fonts/            # → Theme fonts
│   ├── images/           # → Theme images
│   ├── scripts/          # → Theme javascript
│   ├── styles/           # → Theme stylesheets
│   └── views/            # → Theme templates
│       ├── components/   # → Component templates
│       ├── forms/        # → Form templates
│       ├── layouts/      # → Base templates
│       └── partials/     # → Partial templates
├── screenshot.png        # → Theme screenshot for WP admin
├── style.css             # → Theme meta information
├── vendor/               # → Composer packages (never edit)
└── bud.config.js         # → Bud configuration
```

### Theme setup

Edit `app/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.

### Theme development

* Run `npm` from the theme directory to install dependencies
* Update `resources/assets/config.json` settings:
  * `devUrl` should reflect your local development hostname
  * `publicPath` should reflect your WordPress folder structure (`/wp-content/themes/sage` for non-[Bedrock](https://roots.io/bedrock/) installs)

### Localization
Theme uses WordPress recommended way to localize with *.po files. Localization template located in `lang/alps.pot`.
To add new language special software should be used (ex. [POEdit](https://poedit.net/)).

To perform scan of new localizable strings in source files, run `npm run i18n-create-pot`.

[WPML plugin](https://wpml.org/) recommended for the multilingual websites.
Theme provides autogenerated file `lang/alps.php` to help WPML scan the strings for translation.

#### Translators:
The translation in `ALPS for Wordpress` was done thanks to the following individuals:
- Spanish:
- German:
- Russian: Marian Maximciuc (https://github.com/marianmaximciuc)

### Build commands

* `npm run dev` — Compile assets when file changes are made, start Browsersync session
* `npm run build` — Compile and optimize the files in your assets directory
* [DEPRECATED] `npm run build:production` — ~~Compile assets for production~~

### Documentation

* [Sage documentation](https://docs.roots.io/sage/10.x/installation/)
* [Controller documentation](https://github.com/soberwp/controller#usage)

### Contributing

Contributions are welcome from everyone. We have [contributing guidelines](https://github.com/roots/guidelines/blob/master/CONTRIBUTING.md) to help you get started.

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
