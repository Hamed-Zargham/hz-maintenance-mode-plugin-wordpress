<?php
/**
 * Plugin Name:       HZ Maintenance Mode
 * Plugin URI:        https://github.com/Hamed-Zargham/hz-maintenance-mode-plugin-wordpress
 * Description:       Temporarily restrict public access to your site during updates, maintenance, or development.
 * Version:           1.0.2
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            Hamed Zargham
 * Author URI:        https://github.com/Hamed-Zargham
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hz-maintenance-mode
 * Domain Path:       /languages
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'HZMAINT_PLUGIN_ROOT', plugin_dir_path( __FILE__ ) );
define( 'HZMAINT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once HZMAINT_PLUGIN_ROOT . 'includes/settings.php';
require_once HZMAINT_PLUGIN_ROOT . 'includes/core.php';

/**
 * Adds a "Settings" link to the plugin's action links in the Plugins menu.
 *
 * @param array $links An array of plugin action links (e.g., "Deactivate", "Edit", etc)
 * @return array modified array of action links with the 'Settings' link added.
 */
function hzmaint_add_settings_link_to_plugin( $links ) {
    // URL to the plugin's settings page
    $settings_url = admin_url( 'options-general.php?page=maintenance-mode' );

    // Creates the "Settings" link
    $settings_link = '<a href="' . esc_url($settings_url) . '">' . __( 'Settings', 'hz-maintenance-mode' ) . '</a>';

    // Adds the "Settings" link to the beginning of the action links array (before "Deactivate").
    array_unshift( $links, $settings_link );

    return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'hzmaint_add_settings_link_to_plugin' );

/**
 * Sets up default plugin options upon activation.
 *
 * Adds default maintenance mode settings if they don't already exist in the database.
 *
 * @return void
 */
function hzmaint_activate_plugin() {
    // Add default options on activation
    $default_options = [
        'hzmaint_enabled'               => 'yes',
        'hzmaint_show_dashboard_link'   => 'yes',
        'hzmaint_dashboard_link_color'  => '#F6F8D5',
        'hzmaint_page_bkg_color'        => '#205781',
        'hzmaint_heading_tag'           => 'h1',
        'hzmaint_heading_color'         => '#F6F8D5',
        'hzmaint_bypass_logged_in'      => 'yes',
        'hzmaint_bypass_bots'           => 'yes',
        'hzmaint_robots_meta_tag'       => 'noindex, nofollow',
        'hzmaint_social_heading_tag'    => 'h6',
        'hzmaint_social_heading_color'  => '#F6F8D5',
        'hzmaint_social_icons_color'    => '#F6F8D5',

        // Adds default social network URLs as a serialized array
        'hzmaint_social_urls' => array(
            'facebook'  => 'https://facebook.com/',
            'instagram' => 'https://instagram.com/',
            'linkedin'  => 'https://linkedin.com/',
            'telegram'  => 'https://t.me/',
            'twitter'   => 'https://twitter.com/',
            'youtube'   => 'https://youtube.com/',
          )
   ];

   // Checks if the current WordPress site language is Persian (Farsi)
   $is_persian = ( substr( get_bloginfo( 'language' ), 0, 2 ) === 'fa' );

   // Set certain default options based on WordPress language
   $default_options['hzmaint_heading_text'] = ( $is_persian === true ) ? 'حالت تعمیر و نگهداری' : 'Site Under Maintenance';

   $default_options['hzmaint_desc_text'] = ( $is_persian === true ) ? 'در حال انجام تغییراتی در سایت هستیم و تا دقایقی دیگر در دسترس قرار خواهد گرفت. با تشکر از شکیبایی شما' : 'We are currently performing scheduled maintenance';

   $default_options['hzmaint_social_heading_text'] = ( $is_persian === true ) ? 'شبکه های اجتماعی ما' : 'Our Social Networks';

   $default_options['hzmaint_dashboard_link_text'] = ( $is_persian === true ) ? 'لینک ورود به پیشخوان' : 'Dashboard Link Text';

    // Loop through each option and add it only if it doesn't already exist
    foreach ( $default_options as $option_name => $default_value ) {
        if ( get_option( $option_name ) === false ) {
            add_option( $option_name, $default_value );
        }
    }
}

// Activation hook
register_activation_hook( __FILE__ , 'hzmaint_activate_plugin' );

/**
 * Function to run on plugin deactivation.
 *
 * Currently not in use, but kept for potential future functionality.
 */
function hzmaint_deactivate_plugin() {
    // No actions performed during deactivation at this time.
}

// Deactivation hook
register_deactivation_hook( __FILE__ , 'hzmaint_deactivate_plugin' );

// Enqueues admin scripts and styles for the maintenance mode settings page
add_action( 'admin_enqueue_scripts', function ( $hook ) {
    // Check if we're on the maintenance mode settings page
    if ( 'settings_page_maintenance-mode' !== $hook ) {
        return;
    }

    // Enqueue WordPress color picker script and style
    wp_enqueue_script( 'wp-color-picker' );
    wp_enqueue_style( 'wp-color-picker' );

    // Enqueue custom script to initialize the color picker
    wp_enqueue_script(
        'hzmaint-plugin-admin-js',
        plugin_dir_url( __FILE__ ) . 'admin/js/plugin-admin.js',
        array( 'wp-color-picker' ),
        '1.0.0',
        true
    );

    // Enqueue plugin admin CSS
    wp_enqueue_style(
        'hzmaint-plugin-admin-css',
        plugin_dir_url( __FILE__ ) . 'admin/css/plugin-admin.css',
        array(),
        '1.0.0',
        'all'
  );
}, 11 );

/*
 * Uninstallation Note:
 * This plugin's uninstallation process is handled by the `uninstall.php` file located in the plugin's root directory.
 */
