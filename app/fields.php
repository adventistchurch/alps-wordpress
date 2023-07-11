<?php
namespace App;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

require_once( 'carbon-fields/cf-theme-options.php' );
require_once( 'carbon-fields/cf-global.php' );
require_once( 'carbon-fields/cf-front-page.php' );
require_once( 'carbon-fields/cf-post-options.php' );

/**
 * Boot Carbon Fields
 */
add_action( 'after_setup_theme', function () {
    \Carbon_Fields\Carbon_Fields::boot();
    // IN SAGE THEMES ///////////////
    // WIDGETS HAVE TO BE LOADED HERE
    require_once( 'carbon-fields/cf-widget.php' );
});
