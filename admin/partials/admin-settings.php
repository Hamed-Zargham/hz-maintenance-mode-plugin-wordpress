<div class="wrap">
  <h1><?php esc_html_e( 'Maintenance Mode Settings', 'hz-maintenance-mode' ) ?></h1>

  <!-- Tab Navigation -->
  <nav class="nav-tab-wrapper">
    <a href="#hz-general-options" class="nav-tab active"><?php esc_html_e( 'General Options', 'hz-maintenance-mode' ) ?></a>
    <a href="#hz-social-networks-options" class="nav-tab"><?php esc_html_e( 'Social Networks Options', 'hz-maintenance-mode' ) ?></a>
  </nav>

  <form method="post" action="options.php">
    <?php
    // Handle the settings registration and saving.
    settings_fields('maintenance_mode_group');
    ?>
    <!-- General Options Tab Content -->
    <div id="hz-general-options" class="tab-content active">
      <table class="form-table">
        <!-- Enable Maintenance Mode -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Enable Maintenance Mode', 'hz-maintenance-mode' ) ?></th>
          <td>
            <div>
              <label><input type="radio" name="hz_maint_enabled" value="yes" <?php checked ( get_option( 'hz_maint_enabled' ), 'yes' ); ?>> <?php esc_html_e( 'Yes', 'hz-maintenance-mode' ) ?></label>
            </div>
            <div>
              <label><input type="radio" name="hz_maint_enabled" value="no" <?php checked ( get_option( 'hz_maint_enabled' ), 'no' ); ?>> <?php esc_html_e( 'No', 'hz-maintenance-mode' ) ?></label>
            </div>
          </td>
        </tr>

        <!-- Show Dashboard Link -->
        <tr>
          <th scope="row" class="hz-padding-bottom-0"><?php esc_html_e( 'Show Dashboard Link', 'hz-maintenance-mode' ) ?></th>
          <td>
            <label><input type="checkbox" name="hz_maint_show_dashboard_link" value="yes" <?php checked( get_option( 'hz_maint_show_dashboard_link' ), 'yes' ); ?>></label>
          </td>
        </tr>

        <!-- One-Line Info -->
        <tr>
          <td colspan="2" class="hz-note-td">
          <?php esc_html_e( 'Displays a link to the WordPress dashboard on the maintenance mode screen, allowing authorized users to log in', 'hz-maintenance-mode' ) ?>
          </td>
        </tr>

        <!-- Dashboard Link Text -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Dashboard Link Text', 'hz-maintenance-mode' ) ?></th>
          <td>
            <input type="text" name="hz_maint_dashboard_link_text" value="<?php echo esc_attr( get_option( 'hz_maint_dashboard_link_text' ) ); ?>" placeholder="<?php esc_attr_e( 'Dashboard link', 'hz-maintenance-mode' ); ?>">
          </td>
        </tr>

        <!-- Dashboard Link Color -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Dashboard Link Color', 'hz-maintenance-mode' ) ?></th>
          <td>
            <input type="text" name="hz_maint_dashboard_link_color" value="<?php echo esc_attr( get_option( 'hz_maint_dashboard_link_color' ) ); ?>" class="color-picker" data-default-color="<?php echo esc_attr( get_option( 'hz_maint_dashboard_link_color' ) ); ?>">
          </td>
        </tr>

        <!-- Bypass Maintenance Mode for Logged-In Users -->
        <tr>
          <th scope="row" class="hz-padding-bottom-0"><?php esc_html_e( 'Bypass Maintenance Mode for Logged-In Users', 'hz-maintenance-mode' ) ?></th>
          <td>
            <label><input type="checkbox" name="hz_maint_bypass_logged_in" value="yes" <?php checked( get_option( 'hz_maint_bypass_logged_in' ), 'yes' ); ?>></label>
          </td>
        </tr>

        <!-- One-Line Info -->
        <tr>
          <td colspan="2" class="hz-note-td">
          <?php esc_html_e( 'Administrators are always excluded from maintenance mode', 'hz-maintenance-mode' ) ?>
          </td>
        </tr>

        <!-- Bypass Maintenance Mode for bots -->
        <tr>
          <th scope="row" class="hz-padding-bottom-0"><?php esc_html_e( 'Bypass Maintenance Mode for Bots', 'hz-maintenance-mode' ) ?></th>
          <td>
            <label><input type="checkbox" name="hz_maint_bypass_bots" value="yes" <?php checked( get_option( 'hz_maint_bypass_bots' ), 'yes' ); ?>></label>
          </td>
        </tr>

        <!-- One-Line Info -->
        <tr>
          <td colspan="2" class="hz-note-td">
          <?php esc_html_e( 'Even if this option is unchecked, your SEO rankings will not be negatively affected, as we send a proper HTTP 503 status code to search engines and bots during maintenance mode', 'hz-maintenance-mode' ) ?>
          </td>
        </tr>

        <!-- Robots Meta Tag -->
        <tr>
          <th scope="row" class="hz-padding-bottom-0"><?php esc_html_e( 'Robots Meta Tag', 'hz-maintenance-mode' ) ?></th>
          <td class="hz-padding-bottom-0">
            <div>
              <label><input type="radio" name="hz_maint_robots_meta_tag" value="noindex, nofollow" <?php checked ( get_option( 'hz_maint_robots_meta_tag' ), 'noindex, nofollow' ); ?>> noindex, nofollow</label>
            </div>
            <div>
              <label><input type="radio" name="hz_maint_robots_meta_tag" value="index, follow" <?php checked ( get_option( 'hz_maint_robots_meta_tag' ), 'index, follow' ); ?>> index, follow</label>
            </div>
          </td>
        </tr>

      <!-- One-Line Info -->
      <tr>
        <td colspan="2" class="hz-note-td">
        <?php esc_html_e( 'We recommend "noindex, nofollow" to prevent SEO issues and ranking drops', 'hz-maintenance-mode' ) ?>
        </td>
      </tr>


        <!-- Page Background Color -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Page Background Color', 'hz-maintenance-mode' ) ?></th>
          <td>
            <input type="text" name="hz_maint_page_bkg_color" value="<?php echo esc_attr( get_option( 'hz_maint_page_bkg_color') ); ?>" class="color-picker" data-default-color="<?php echo esc_attr( get_option( 'hz_maint_page_bkg_color') ); ?>">
          </td>
        </tr>

        <!-- Heading Tag -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Heading Tag', 'hz-maintenance-mode' ) ?></th>
          <td>
            <select name="hz_maint_heading_tag">
              <option value="h1" <?php selected( get_option( 'hz_maint_heading_tag' ), 'h1'); ?>>H1</option>
              <option value="h2" <?php selected( get_option( 'hz_maint_heading_tag' ), 'h2'); ?>>H2</option>
              <option value="h3" <?php selected( get_option( 'hz_maint_heading_tag' ), 'h3'); ?>>H3</option>
              <option value="h4" <?php selected( get_option( 'hz_maint_heading_tag' ), 'h4'); ?>>H4</option>
              <option value="h5" <?php selected( get_option( 'hz_maint_heading_tag' ), 'h5'); ?>>H5</option>
              <option value="h6" <?php selected( get_option( 'hz_maint_heading_tag' ), 'h6'); ?>>H6</option>
            </select>
          </td>
        </tr>

        <!-- Heading Text -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Heading Text', 'hz-maintenance-mode' ) ?></th>
          <td>
            <input type="text" name="hz_maint_heading_text" value="<?php echo esc_attr( get_option( 'hz_maint_heading_text' ) ); ?>" placeholder="<?php esc_attr_e( 'Enter heading text', 'hz-maintenance-mode' ); ?>">
          </td>
        </tr>

        <!-- Heading Color -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Heading Color', 'hz-maintenance-mode' ) ?></th>
          <td>
            <input type="text" name="hz_maint_heading_color" value="<?php echo esc_attr( get_option( 'hz_maint_heading_color' ) ); ?>" class="color-picker" data-default-color="<?php echo esc_attr( get_option( 'hz_maint_heading_color' ) ); ?>">
          </td>
        </tr>

        <!-- Description Text with Rich Text Editor -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Description Text', 'hz-maintenance-mode' ) ?></th>
          <td>
            <?php
            $desc_text = get_option( 'hz_maint_desc_text' );

            // Use wp_editor() to create a rich text editor
            wp_editor(
              $desc_text, // Content to display in the editor
              'hz_maint_desc_text', // ID of the editor (must match the option name)
              array(
                'textarea_name' => 'hz_maint_desc_text',
                'textarea_rows' => 4,
                'media_buttons' => false,
                'teeny'         => false,
              )
            );
            ?>
          </td>
        </tr>
      </table>
    </div>

    <!-- Social Networks Options Tab Content -->
    <div id="hz-social-networks-options" class="tab-content">
      <table class="form-table">
        <!-- Social Heading Tag -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Social Heading Tag', 'hz-maintenance-mode' ) ?></th>
          <td>
            <select name="hz_maint_social_heading_tag">
                <option value="h1" <?php selected( get_option( 'hz_maint_social_heading_tag'), 'h1' ); ?>>H1</option>
                <option value="h2" <?php selected( get_option( 'hz_maint_social_heading_tag'), 'h2' ); ?>>H2</option>
                <option value="h3" <?php selected( get_option( 'hz_maint_social_heading_tag'), 'h3' ); ?>>H3</option>
                <option value="h4" <?php selected( get_option( 'hz_maint_social_heading_tag'), 'h4' ); ?>>H4</option>
                <option value="h5" <?php selected( get_option( 'hz_maint_social_heading_tag'), 'h5' ); ?>>H5</option>
                <option value="h6" <?php selected( get_option( 'hz_maint_social_heading_tag'), 'h6' ); ?>>H6</option>
            </select>
          </td>
        </tr>

        <!-- Social Heading Text -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Social Heading Text', 'hz-maintenance-mode' ) ?></th>
          <td>
              <input type="text" name="hz_maint_social_heading_text" value="<?php echo esc_attr( get_option ( 'hz_maint_social_heading_text' ) ); ?>">
          </td>
        </tr>

        <!-- Social Heading Color -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Social Heading Color', 'hz-maintenance-mode' ) ?></th>
          <td>
            <input type="text" name="hz_maint_social_heading_color" value="<?php echo esc_attr( get_option( 'hz_maint_social_heading_color' ) ); ?>" class="color-picker" data-default-color="<?php echo esc_attr( get_option( 'hz_maint_social_heading_color' ) ); ?>">
          </td>
        </tr>

        <!-- Social Icons Color -->
        <tr>
          <th scope="row"><?php esc_html_e( 'Social Icons Color', 'hz-maintenance-mode' ) ?></th>
          <td>
            <input type="text" name="hz_maint_social_icons_color" id="hz_maint_social_icons_color" value="<?php echo esc_attr( get_option( 'hz_maint_social_icons_color' ) ); ?>" class="color-picker" data-default-color="<?php echo esc_attr( get_option( 'hz_maint_social_icons_color' ) ); ?>">
          </td>
        </tr>

        <tr>
          <th scope="row"><?php esc_html_e( 'Social Network URLs', 'hz-maintenance-mode' ) ?></th>
          <td>
            <p id="hz-social-network-urls-note-p"><?php esc_html_e( 'Enter your page id at the end of each URL', 'hz-maintenance-mode' ) ?></p>
            <?php
            // Define social networks with their respective placeholders
            $social_networks = array(
              'facebook'  => array( 'label' => __('Facebook Page URL', 'hz-maintenance-mode'), 'placeholder'  => 'https://facebook.com/' ),
              'instagram' => array( 'label' => __('Instagram Page URL', 'hz-maintenance-mode'), 'placeholder' => 'https://instagram.com/' ),
              'linkedin'  => array( 'label' => __('Linkedin Page URL', 'hz-maintenance-mode'), 'placeholder'  => 'https://linkedin.com/' ),
              'telegram'  => array( 'label' => __('Telegram Channel URL', 'hz-maintenance-mode'), 'placeholder' => 'https://t.me/' ),
              'twitter'   => array( 'label' => __('Twitter Page URL', 'hz-maintenance-mode'), 'placeholder'   => 'https://twitter.com/' ),
              'youtube'   => array( 'label' => __('Youtube Channel URL', 'hz-maintenance-mode'), 'placeholder' => 'https://youtube.com/' ),
            );

            // Retrieve the saved social network URLs from the database
            $saved_social_urls = get_option( 'hz_maint_social_urls', array() );

            // Loop through the social networks and create input fields
            foreach ( $social_networks as $key => $value ) : ?>
            <?php
            $url_value = isset( $saved_social_urls[$key] ) ? esc_url( $saved_social_urls[$key] ) : '';
            ?>
            <p>
              <label class="social-network-label" for="hz_maint_social_<?php echo esc_attr( $key ); ?>">
                <?php echo esc_html( $value['label'] ); ?>
              </label>
              <input
                type="text"
                id="hz_maint_social_<?php echo esc_attr( $key ); ?>"
                class="hz-social-network-input"
                name="hz_maint_social_urls[<?php echo esc_attr( $key ); ?>]"
                value="<?php echo esc_attr( $url_value ); ?>"
                placeholder="<?php echo esc_attr( $value['placeholder'] ); ?>">
            </p>
            <?php endforeach; ?>
          </td>
        </tr>
      </table>
    </div>

    <?php submit_button(); ?>
  </form>
</div>
<div id="hz-plugin-developer-credit">
  <?php esc_html_e( 'Developed by', 'hz-maintenance-mode' ) ?> :
  <a href="<?php echo esc_url( 'mailto:zargham.hamed@gmail.com' ); ?>"><?php esc_html_e( 'Hamed Zargham', 'hz-maintenance-mode' ) ?></a>
</div>
