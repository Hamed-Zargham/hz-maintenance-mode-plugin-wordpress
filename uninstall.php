<?php

// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

$options_to_delete = [
    'hz_maint_enabled',
    'hz_maint_show_dashboard_link',
    'hz_maint_dashboard_link_color',
    'hz_maint_dashboard_link_text',
    'hz_maint_page_bkg_color',
    'hz_maint_heading_tag',
    'hz_maint_heading_text',
    'hz_maint_heading_color',
    'hz_maint_desc_text',
    'hz_maint_bypass_logged_in',
    'hz_maint_bypass_bots',
    'hz_maint_robots_meta_tag',
    'hz_maint_social_heading_tag',
    'hz_maint_social_heading_text',
    'hz_maint_social_heading_color',
    'hz_maint_social_icons_color',
    'hz_maint_social_urls',
];

foreach ( $options_to_delete as $option_name ) {
    delete_option( $option_name );
}
