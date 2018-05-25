# ALSP Wordpress Themes

## Getting Started
### Install Composer
First you need to [install composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx).

> Note: The instructions below refer to the [global composer
installation](https://getcomposer.org/doc/00-intro.md#globally). You might need
to replace `composer` with `php composer.phar` (or similar) for your setup.

### Clone & Configure
1. Clone the repo.
1. At the very top level of the repo, run `composer install`.
1. Create a local settings file:
`cp web/wp-config-sample.php web/wp-config.php`.
1. Configure the database connection settings in `wp-config.php` with your
local credentials.

## FAQ
### Should I commit the contrib plugins I download?
No. Contrib plugins should be treated as dependencies and specified in
[composer.json](composer.json).
