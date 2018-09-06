[![Code Climate](https://codeclimate.com/github/Yoast/i18n-module/badges/gpa.svg)](https://codeclimate.com/github/Yoast/i18n-module)

# Yoast i18n module
Promote your own translation site for people who are using your plugin in another language than `en_US`. 

## Example of the rendered promo box
![Example promo box 1](https://cloud.githubusercontent.com/assets/5147598/17158139/66429a10-5394-11e6-8d6d-5da0e0a5b074.png)

![Example promo box 2](https://cloud.githubusercontent.com/assets/5147598/17158143/6ed2f33c-5394-11e6-825b-a0fc04f2df83.png)

The image, the name of your plugin and the name of your translation project are all configurable (see example below). The name of the language is retrieved from your GlotPress install, as is the percentage translated. The box doesn't display when a language has been translated for 90% or more.

## How to use this module

Include it in your project using composer:
```bash
composer require yoast/i18n-module
```

Alternatively you can include the library as a submodule.
Make sure the class is loaded and instantiate it like this:

```php
new Yoast_I18n_v3(
	array(
		'textdomain'     => '{your text domain}',
		'project_slug'   => '{your probject slug}',
		'plugin_name'    => '{your plugin name}',
		'hook'           => '{the hook to display the message box on}',
		'glotpress_url'  => '{url to your glotpress installation; http://translate.yoast.com}',
		'glotpress_name' => '{name of your glotpress installation}',
		'glotpress_logo' => '{url to a logo which will be shown}',
		'register_url '  => '{url to use when registering for a project}',
	)
);
```

Because translate.wordpress.org is also a GlotPress installation you can use the i18n-module to promote translation your plugin on there. To do this you can use the dedicated wordpress.org class:

```php
new Yoast_I18n_WordPressOrg_v3(
	array(
		'textdomain'  => '{your text domain}',
		'plugin_name' => '{your plugin name}',
		'hook'        => '{hook to display the message box on}',
	)
);
```

### Customize where and when to render the message

Since 3.0.0 you can also decide to render the message in a message-box of your own, just provide the second argument to the constructor as `false` to disable the showing of the box by the module itself.

```php
$i18n_module = new Yoast_I18n_v3(
	array(
		'textdomain'     => '{your text domain}',
		'project_slug'   => '{your probject slug}',
		'plugin_name'    => '{your plugin name}',
		'hook'           => '{the hook to display the message on - not used in this example}',
		'glotpress_url'  => '{url to your glotpress installation; http://translate.yoast.com}',
		'glotpress_name' => '{name of your glotpress installation}',
		'glotpress_logo' => '{url to a logo which will be shown}',
		'register_url '  => '{url to use when registering for a project}',
	),
	false
);

$message = $i18n_module->get_promo_message();
```

```php
$i18n_module = new Yoast_I18n_WordPressOrg_v3(
	array(
		'textdomain'  => '{your text domain}',
		'plugin_name' => '{your plugin name}',
		'hook'        => '{hook to display the message on - not used in this example}',
	),
	false
);

$message = $i18n_module->get_promo_message();
```
