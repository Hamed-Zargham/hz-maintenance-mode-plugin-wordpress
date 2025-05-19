<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'template_redirect', function () {
    if ( get_option( 'hzmaint_enabled' ) !== 'yes' ) {
        return; // Don't load maintenance page
    }

    // Bypasses maintenance mode for logged-in users
    if ( get_option( 'hzmaint_bypass_logged_in' ) === 'yes' && is_user_logged_in() ) {
        return; // Don't load maintenance page
    }

    // Bypasses maintenance mode for bots
    if ( hzmaint_is_bot() && get_option( 'hzmaint_bypass_bots' ) === 'yes' ) {
        return; // Don't load maintenance page
    }

    // If execution reaches this point, the request is not bypassed, and maintenance mode logic will be applied.
    add_action( 'wp_enqueue_scripts', function () {
        // Enqueue Bootstrap icons
        wp_enqueue_style(
            'hzmaint-bootstrap-icons-css',
            plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/bootstrap-icons/font/bootstrap-icons.min.css',
            array(),
            '1.11.3',
            'all'
      );

      // Enqueue plugin public CSS
      wp_enqueue_style(
        'hzmaint-plugin-public-css',
        plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/plugin-public.css',
        array(),
        '1.0.0',
        'all'
        );
    }, 11 );

    status_header( 503 );
    header( 'Retry-After: 86400' ); // Retry after 24 hours

    // Start output buffering
    ob_start();

    // Loads maintenance page
    include HZMAINT_PLUGIN_ROOT . 'public/partials/maintenance-page.php';

    // Get buffered content
    $output = ob_get_clean();

    // Remove any existing robots meta tag
    $output = preg_replace( '/<meta\s+name\s*=\s*[\'"]robots[\'"][^>]*>/i', '', $output );

    // Get the robots meta tag content from plugin options
    $robots_content = get_option( 'hzmaint_robots_meta_tag', 'noindex, nofollow' );

    // Create the meta tag with the dynamic content
    $robots_meta = '<meta name="robots" content="' . esc_attr( $robots_content ) . '">';

    $noindex_meta = '<meta name="robots" content="noindex, nofollow">';

    // inserts the $noindex_meta string
    $output = preg_replace(
        '/(<head\b[^>]*>)/i',
        '$1' . PHP_EOL . '    ' . $robots_meta,
        $output,
        1
    );

    // Output final content
    echo $output;

    exit;
});
