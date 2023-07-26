<?php
namespace App\Integrations;

class CustomSidebars {
    public function init()
    {
        add_action('alps_custom_sidebar_widgets', [$this, 'sidebarWidgets']);
    }

    public function sidebarWidgets()
    {
        if (class_exists('CustomSidebarsReplacer')) {
            $replacer = \CustomSidebarsReplacer::instance();
            $replacer->replace_sidebars();
        }
    }
}
