<?php

/**
 * Sanitizes an array of social media URLs.
 *
 * Takes an array of URLs, trims whitespace, and sanitizes each URL using esc_url_raw().
 * Returns an array containing only valid, non-empty URLs with their original keys preserved.
 *
 * @param array $urls an array of URLs to sanitize.
 * @return array an array of sanitized URLs. Returns empty array if input is not an array.
 */
function hz_sanitize_social_urls( $urls ) {
    if ( ! is_array( $urls ) ) {
        return array();
    }

    $sanitized_urls = array();

    foreach ( $urls as $key => $val ) {
        // Sanitize each URL and ensure it's a valid URL
        $sanitized_url = esc_url_raw( trim( $val ) );
        if ( ! empty( $sanitized_url ) ) {
            $sanitized_urls[$key] = $sanitized_url;
        }
    }
    return $sanitized_urls;
}

// Registers settings
add_action( 'admin_init', function () {
    // Maintenance Mode Enabled
    register_setting(
        'maintenance_mode_group',
        'hz_maint_enabled',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Show Dashboard Link
    register_setting(
        'maintenance_mode_group',
        'hz_maint_show_dashboard_link',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Dashboard Link Text
    register_setting(
        'maintenance_mode_group',
        'hz_maint_dashboard_link_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Dashboard Link Color
    register_setting(
        'maintenance_mode_group',
        'hz_maint_dashboard_link_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    // Bypass Logged-In Users
    register_setting(
        'maintenance_mode_group',
        'hz_maint_bypass_logged_in',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Bypass Bots
    register_setting(
        'maintenance_mode_group',
        'hz_maint_bypass_bots',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Robots Meta tag
    register_setting(
        'maintenance_mode_group',
        'hz_maint_robots_meta_tag',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Page Background Color
    register_setting(
        'maintenance_mode_group',
        'hz_maint_page_bkg_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    // Heading Tag
    register_setting(
        'maintenance_mode_group',
        'hz_maint_heading_tag',
        array(
            'sanitize_callback' => 'sanitize_html_class',
        )
    );

    // Heading Text
    register_setting(
        'maintenance_mode_group',
        'hz_maint_heading_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Heading Color
    register_setting(
        'maintenance_mode_group',
        'hz_maint_heading_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    // Description Text (Rich Text)
    register_setting(
        'maintenance_mode_group',
        'hz_maint_desc_text',
        array(
            'sanitize_callback' => 'wp_kses_post', // Allow safe HTML tags for rich text content
        )
    );

    // Social Heading Tag
    register_setting(
        'maintenance_mode_group',
        'hz_maint_social_heading_tag',
        array(
            'sanitize_callback' => 'sanitize_html_class',
        )
    );

    // Social Heading Text
    register_setting(
        'maintenance_mode_group',
        'hz_maint_social_heading_text',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    // Social Heading Color
    register_setting(
        'maintenance_mode_group',
        'hz_maint_social_heading_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    // Social Icons Color
    register_setting(
        'maintenance_mode_group',
        'hz_maint_social_icons_color',
        array(
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    /*
     * Social Network URLs (Array of URLs)
     * registers a single setting to store all social network URLs as a serialized array or JSON object
    */
    register_setting(
        'maintenance_mode_group',
        'hz_maint_social_urls',
        array(
            'sanitize_callback' => 'hz_sanitize_social_urls', // Custom sanitization function
        )
    );
});

/**
 * Checks if the current request is from a bot or crawler.
 *
 * @return bool True if it's a bot, false otherwise.
 */
function hz_maint_is_bot() {
    $default_bots = array(
        'Ahrefs'          => 'AhrefsBot',
        'AltaVista'       => 'Altavista',
        'Apple'           => 'Applebot',
        'Bing'            => 'bingbot',
        'Baiduspider'     => 'Baidu',
        'BingPreview'     => 'BingPreview',
        'Facebook'        => 'facebookexternalhit',
        'Gigabot'         => 'Gigabot',
        'Google'          => 'Googlebot',
        'LinkedIn'        => 'LinkedInBot',
        'MSN'             => 'msnbot',
        'Moz'             => 'Dotbot',
        'Semrush'         => 'SemrushBot',
        'Sogou Spider'    => 'Sogou',
        'Slackbot'        => 'Slackbot',
        'Yahoo'           => 'Yahoo',
        'Yandex'          => 'YandexBot',
    );

    /**
     * Filters the list of bots during maintenance mode.
     *
     * This filter allows developers to modify the array of bots during maintenance mode checks.
     *
     * @param string[] $default_bots An array of default bots to check against.
     * @return string[] Filtered array of bot identifiers to recognize during maintenance mode.
     */
    $bots = apply_filters( 'hz_maint_bots', $default_bots );

    if ( ! is_array( $bots ) ) {
        $bots = [];
    }

    // Edge case: Empty user agent (e.g., CLI requests)
    $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT'])) : '';



    // $user_agent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? wp_unslash( $_SERVER['HTTP_USER_AGENT'] ) : '';
    // $user_agent = sanitize_text_field( $user_agent );

    if ( empty( $user_agent ) ) {
        return false;
    }

    // Escape any special regex characters (. *) in bot names
    $quoted_bots = array_map( 'preg_quote', array_values( $bots ) );

    $bot_list = implode( '|', $quoted_bots );

    // Build optimized regex pattern
    $pattern = '~( ' . $bot_list . ' )~i';

    // Return boolean result
    return ( bool ) preg_match( $pattern, $user_agent );
}

/**
 * Renders the Maintenance Mode settings page.
 *
 * This function includes the template file for the Maintenance Mode settings page.
 *
 * @return void
 */
function render_maintenance_mode_settings_page() {
    include_once hz_maint_PLUGIN_ROOT . 'admin/partials/admin-settings.php';
}


/**
 * Registers the Maintenance Mode settings page in the WordPress admin area.
 *
 * This function adds an options page under the "Settings" menu in the WordPress admin.
 * It allows users with the 'manage_options' capability to access the Maintenance Mode settings.
 *
 * @return void
 */
 function register_maintenance_mode_settings_page() {
    add_options_page(
        'Maintenance Mode Settings', // Page title
        'HZ Maintenance Mode',       // Menu title
        'manage_options',            // Capability required to access the page
        'maintenance-mode',          // Menu slug
        'render_maintenance_mode_settings_page' // Callback function to render the page
    );
}

// Adds settings page to the WordPress admin menu
add_action( 'admin_menu', 'register_maintenance_mode_settings_page' );
