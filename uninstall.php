<?php

// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

$options_to_delete = [
    'hzmaint_enabled',
    'hzmaint_show_dashboard_link',
    'hzmaint_dashboard_link_color',
    'hzmaint_dashboard_link_text',
    'hzmaint_page_bkg_color',
    'hzmaint_heading_tag',
    'hzmaint_heading_text',
    'hzmaint_heading_color',
    'hzmaint_desc_text',
    'hzmaint_bypass_logged_in',
    'hzmaint_bypass_bots',
    'hzmaint_robots_meta_tag',
    'hzmaint_social_heading_tag',
    'hzmaint_social_heading_text',
    'hzmaint_social_heading_color',
    'hzmaint_social_icons_color',
    'hzmaint_social_urls',
];

foreach ( $options_to_delete as $option_name ) {
    delete_option( $option_name );
}
