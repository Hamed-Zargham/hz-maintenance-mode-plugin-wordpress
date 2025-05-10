<?php

/**
 * Plugin Template: Maintenance Mode Page
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Use WordPress's header to maintain proper flow
get_header();

// Retrieve options for customization
$page_bkg_color        = get_option( 'hz_maint_page_bkg_color' );
$heading_tag           = get_option( 'hz_maint_heading_tag' );
$heading_text          = get_option( 'hz_maint_heading_text' );
$heading_color         = get_option( 'hz_maint_heading_color' );
$desc_text             = get_option( 'hz_maint_desc_text' );
$show_dashboard_link   = get_option( 'hz_maint_show_dashboard_link' );
$dashboard_link_text   = get_option( 'hz_maint_dashboard_link_text' );
$dashboard_link_color  = get_option( 'hz_maint_dashboard_link_color' );
$social_heading_tag    = get_option( 'hz_maint_social_heading_tag' );
$social_heading_text   = get_option( 'hz_maint_social_heading_text' );
$social_heading_color  = get_option( 'hz_maint_social_heading_color' );
$social_icons_color    = get_option( 'hz_maint_social_icons_color' )
?>

<style>
  body {
    background-color: <?php echo esc_attr( $page_bkg_color ); ?>;
    font-family: Arial, sans-serif;
  }
</style>

<div id="maintenance-mode-page">

    <div id="hz-heading-container" class="<?php echo is_rtl() ? 'rtl-font' : ''; ?>">
      <?php
        // Display the heading
        echo '<' . esc_attr( $heading_tag ) . ' style="color: ' . esc_attr( $heading_color ) . '">' . esc_html( $heading_text ) . '</' . esc_attr( $heading_tag ) . '>';
      ?>
    </div>

    <div id="hz-maintenance-description" class="<?php echo is_rtl() ? 'rtl-font' : ''; ?>">
      <?php
      // Display the description text with proper formatting
      echo wpautop( wp_kses_post( $desc_text ) );
       ?>
    </div>

    <?php if ( $show_dashboard_link ) : ?>
      <div id="hz-dashboard-link" >
        <p class="<?php echo is_rtl() ? 'rtl-font' : ''; ?>">
           <a href="<?php echo esc_url( wp_login_url() ); ?>" style="color: <?php echo esc_attr( $dashboard_link_color ) ?>"><?php echo esc_html( $dashboard_link_text ); ?></a>
        </p>

      </div>
    <?php endif; ?>

    <div id="hz-social-heading-container" class="<?php echo is_rtl() ? 'rtl-font' : ''; ?>">
    <?php
    // Display the social heading text
    echo '<' . esc_attr( $social_heading_tag ) . ' style="color: ' . esc_attr( $social_heading_color ) . '">' . esc_html( $social_heading_text ) . '</' . esc_attr( $social_heading_tag ) . '>';
    ?>
    </div>

    <?php
      // Retrieve the saved social network URLs from the database
      $saved_social_urls = get_option( 'hz_maint_social_urls', array() );

      // Define the social networks with their respective icons and default labels
      $social_networks = array(
          'facebook'  => array( 'icon' => 'bi bi-facebook',  'label' => 'Facebook' ),
          'instagram' => array( 'icon' => 'bi bi-instagram', 'label' => 'Instagram' ),
          'linkedin'  => array( 'icon' => 'bi bi-linkedin',  'label' => 'LinkedIn' ),
          'telegram'  => array( 'icon' => 'bi bi-telegram',  'label' => 'Telegram' ),
          'twitter'   => array( 'icon' => 'bi bi-twitter',   'label' => 'Twitter' ),
          'youtube'   => array( 'icon' => 'bi bi-youtube',   'label' => 'YouTube' ),
      );

      // Check if there are any saved URLs and generate the social network links
      if ( ! empty( $saved_social_urls ) ) {
        echo '<div id="hz-social-networks-container" class="social-icons">';

        // Loop through the social networks and generate links dynamically
        foreach ( $social_networks as $key => $value ) {
          // Check if the URL for this social network is saved in the database
          if ( ! empty( $saved_social_urls[$key] ) ) {
            ?>
            <a href="<?php echo esc_url( $saved_social_urls[$key] ); ?>" target="_blank" aria-label="<?php echo esc_attr( $value['label'] ); ?>">
              <i class="<?php echo esc_attr( $value['icon'] ); ?>" style="color: <?php echo esc_attr( $social_icons_color ); ?>;"></i>
            </a>
            <?php
          }
        }
        echo '</div>';
      }
      ?>
</div>

<?php
// Use WordPress's footer to maintain proper flow
get_footer();
