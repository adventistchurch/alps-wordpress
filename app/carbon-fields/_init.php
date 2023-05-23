<?php
require_once('cf-theme-options.php');
require_once('cf-global.php');
require_once('cf-front-page.php');
require_once('cf-page.php');
require_once('cf-post.php');

// LOAD CF FROM COMPOSER ADDED VENDOR DIR
add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once __DIR__ . '/../../vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
    // IN SAGE THEMES ///////////////
    // WIDGETS HAVE TO BE LOADED HERE
    require_once('cf-widget.php');
}

// REMOVE MEDIA BUTTON FROM CF RICH TEXT EDITOR
add_filter('crb_media_buttons_html', function ($html, $field_name) {
    $fields = ['content_block_freeform_body', 'sb_body', 'content_body_1', 'footer_description'];
    if (in_array($field_name, $fields)) {
        return;
    }

    return $html;
}, 10, 2);

// ADD CF ADMIN STYLESHEET
function cf_admin_style()
{
    wp_enqueue_style('cf-admin-styles', get_template_directory_uri() . '/app/carbon-fields/cf-admin.css');
}

add_action('admin_enqueue_scripts', 'cf_admin_style');

// ADD CF JAVASCRIPT
function cf_admin_js($hook)
{
    wp_enqueue_script('cf-admin-js', get_template_directory_uri() . '/app/carbon-fields/cf-admin.js');
}

add_action('admin_enqueue_scripts', 'cf_admin_js');

//function get_alps_field($field, $id = NULL)
//{
//    global $post;
//    if (empty($id)) {
//        $id = get_queried_object_id();
//    }
//    $cf = get_option('alps_cf_converted');
//    if ($cf) {
//        return carbon_get_post_meta($id, $field);
//    } else {
//        return get_post_meta($id, $field, true);
//    }
//}
//
//function get_alps_option($field)
//{
//    global $post;
//    $cf = get_option('alps_cf_converted');
//    if ($cf) {
//        $option = carbon_get_theme_option($field);
//    } else {
//        $options = get_option('alps_theme_settings');
//        $option = $options[$field];
//    }
//    if (is_array($option)) {
//        // RETURN SINGLE KEY/VAL ARRAY AS VAL (IMAGES)
//        if (count($option) == 1) {
//            return $option[0];
//        } else {
//            // RETURN COMPLETE ARRAY
//            return $option;
//        }
//    } else {
//        return $option;
//    }
//}

// HELPER FUNCTION
function is_multidimensional(array $array)
{
    return count($array) !== count($array, COUNT_RECURSIVE);
}

$cf = get_option('alps_cf_converted');
if (!$cf) {
    function alps_admin_notice__cf_upgrade()
    {
        $url = add_query_arg(['action' => 'alps_convert_plugin'], admin_url('admin.php'));
        ?>
        <div class="notice notice-warning is-dismissible"
             style="background:#fff;border:2px solid black; border-left:6px solid red">
            <p style="font-size:28px"><?php _e('ALPS: The ALPS theme requires an update. Please read and follow the instructions below.', 'alps') ?></p>
            <p style="font-size:22px"><?php _e('Clicking the link below will run an upgrade script. This will download, install and run a converter plugin. After running, the plugin will uninstall and delete itself, and remove the Piklist plugin completely from your site.', 'alps'); ?></p>
            <p style="font-size:22px"><a href="<?php echo $url ?>"><?php _e('click here to install and run the field converter plugin.', 'alps'); ?></a></p>
        </div>
        <?php
    }

    add_action('admin_notices', 'alps_admin_notice__cf_upgrade');

    add_action('admin_action_alps_convert_plugin', 'alps_convert_plugin');
    function alps_convert_plugin()
    {
        $plugin_slug = 'carbon-fields-converter-master/alps-fields-converter.php';
        $plugin_zip = 'https://github.com/adventistchurch/carbon-fields-converter/archive/master.zip';

        if (is_plugin_installed($plugin_slug)) {
            upgrade_plugin($plugin_slug);
            $installed = true;
        } else {
            $installed = install_plugin($plugin_zip);
        }

        if (!is_wp_error($installed) && $installed) {
            echo __('Activating new plugin...', 'alps');
            wp_cache_flush();
            $activate = activate_plugin($plugin_slug);
            if (is_wp_error($activate)) {
                echo '<br>' . $activate->get_error_message();
            } else {
                deactivate_plugins(array($plugin_slug, 'piklist/piklist.php'));
                // NOW NUKE THE PIKLIST & CONVERTER PLUGINS & THEME CONFIG FILES
                $convert_plugin_dir = ABSPATH . 'wp-content/plugins/carbon-fields-converter-master';
                $piklist_plugin_dir = ABSPATH . 'wp-content/plugins/piklist';
                $piklist_theme_dir = get_template_directory() . '/piklist';
                $dirs = array($convert_plugin_dir, $piklist_plugin_dir, $piklist_theme_dir);
                foreach ($dirs as $dir) {
                    alps_remove_dir_recursively($dir);
                }
                // REMOVE THEME SUPPLIED PIKLST
                unlink(get_template_directory() . '/lib/plugins/piklist.zip');

                echo __('<p>Activated.</p> <p style="font-size:26px">The ALPS Fields Converter has run successfully.', 'alps') . '<a href="' . admin_url('plugins.php?action=alps_update_complete') . '">' . __('Click here to return to the plugin management page.', 'alps') . '</a></p>';
            }
        } else {
            echo __('Could not install the new plugin.', 'alps');
        }
    }

    function is_plugin_installed($slug)
    {
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $all_plugins = get_plugins();
        if (!empty($all_plugins[$slug])) {
            return true;
        } else {
            return false;
        }
    }

    function install_plugin($plugin_zip)
    {
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        wp_cache_flush();
        $upgrader = new Plugin_Upgrader();
        $installed = $upgrader->install($plugin_zip);
        return $installed;
    }

    function upgrade_plugin($plugin_slug)
    {
        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        wp_cache_flush();
        $upgrader = new Plugin_Upgrader();
        $upgraded = $upgrader->upgrade($plugin_slug);
        return $upgraded;
    }
}

function alps_admin_notice__alps_update_complete()
{
    if ( isset( $_GET['action'] ) == 'alps_update_complete') {
        ?>
        <div class="notice notice-warning is-dismissible"
             style="background:#fff;border:2px solid black; border-left:6px solid red">
            <p style="font-size:28px"><?php _e('ALPS: The update is complete.', 'alps') ?></p>
            <p style="font-size:22px"><?php _e('The converter plugin has run and updated your ALPS powered site. This plugin has removed both itself and Piklist from your site.', 'alps'); ?></p>
        </div>
        <?php
    }
}

add_action('admin_notices', 'alps_admin_notice__alps_update_complete');

// PIKLIST WILL NOT DELETE THROUGH ADMIN, SO NUKE IT FROM ORBIT
function alps_remove_dir_recursively($dir)
{
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != '.' && $object != '..') {
                if (filetype($dir . '/' . $object) == 'dir') {
                    alps_remove_dir_recursively($dir . '/' . $object);
                } else {
                    unlink($dir . '/' . $object);
                }
            }
        }
        reset($objects);
        rmdir($dir);
    }
}
