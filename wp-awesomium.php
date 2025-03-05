<?php
/**
* Plugin Name: WP Awesomium
* Plugin URI: https://martin.co.ke
* Description: Take control over common WordPress nuisance. Simply awesome!
* Version: 1.0
* Requires at least: 6.0
* Requires PHP: 7.2
* Author: Martin Nzuki
* Author URI: https://martin.co.ke
*/

defined( "ABSPATH" ) or die( "Awesomium doesn't allow that!" );

function disable_specific_plugin_updates($value) {
    if (isset($value) && is_object($value)) {
        $plugins_to_disable = [
            'learnpress/learnpress.php',
            'Fluent-Booking-Pro/fluent-booking-pro.php',
        ];
        
        foreach ($plugins_to_disable as $plugin_slug) {
            if (isset($value->response[$plugin_slug])) {
                unset($value->response[$plugin_slug]);
            }
        }
    }
    return $value;
}
add_filter('site_transient_update_plugins', 'disable_specific_plugin_updates');

function hide_plugin_submenus() {
    if (!is_admin()) return;

    remove_submenu_page('learnpress', 'learn-press-addons');
    // remove_submenu_page('learnpress', 'learn-press-addons');
}
add_action('admin_menu', 'hide_plugin_submenus', 999);