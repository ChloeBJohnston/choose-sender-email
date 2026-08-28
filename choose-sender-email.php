<?php
/*
Plugin Name: Choose Sender Email
Plugin URI: https://github.com/ChloeBJohnston/choose-sender-email
Description: specify email address for WordPress system mail
Author: Chloe Johnston
Version: 1.0.0
Author URI: https://chloebjohnston.com
Update URI: false
*/

/*****************************************************************************************
                                   CHOOSE SENDER EMAIL
*****************************************************************************************/

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/****************************************************************************************/

/* Add 'Choose Sender Email' Section to WP Settings Page */
function cbj_add_choose_sender_email_section() {

    // Add section to WP settings page
    add_settings_section(                       // https://developer.wordpress.org/reference/functions/add_settings_section
        'sender_email_section',                 // $id
        'Choose Sender Email',                  // $title
        'cbj_render_sender_email_section',      // $callback
        'general'                               // $page
    );

    function cbj_render_sender_email_section() {
    ?>
    <p>
        Add the email address and sender name you want WordPress to use when sending system mail.
    </p>
    <?php
    }

} add_action( 'admin_init', 'cbj_add_choose_sender_email_section' );

/****************************************************************************************/

/* Register Email & Name Settings, Then Add Settings Fields to Settings Page Section */
function cbj_register_sender_settings() {

    // Register 'sender_email' setting 
    register_setting(           // https://developer.wordpress.org/reference/functions/register_setting
        'general',              // $option_group
        'sender_email',         // $option_name
        [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_email',
            'default'           => '',
        ]                       // $args
    );

    // Register 'sender_name' setting
    register_setting(           // https://developer.wordpress.org/reference/functions/register_setting
        'general',              // $option_group
        'sender_name',          // $option_name
        [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ]                       // $args
    );

    // Add 'sender_email' field to 'Choose Sender Email' Section to WP Settings Page
    add_settings_field(                     // https://developer.wordpress.org/reference/functions/add_settings_field
        'sender_email_field',               // $id
        'Sender Email Address',             // $title
        'cbj_render_sender_email_setting',  // $callback
        'general',                          // $page
        'sender_email_section'              // $section
    );

    // Callback function to render sender_email_field setting 
    function cbj_render_sender_email_setting() {
        $value = get_option('sender_email', '');
        ?>
        <input 
            name="sender_email" 
            type="email" 
            id="sender_email" 
            aria-describedby="sender-email-description" 
            value="<?php echo esc_attr($value); ?>" 
            class="regular-text"
        />
        <p class="description" id="sender-email-description">
            This address is used to override the default email sender address.
        </p>
        <?php
    }

    // Add 'sender_name' field to 'Choose Sender Email' Section to WP Settings Page
    add_settings_field(                     // https://developer.wordpress.org/reference/functions/add_settings_field
        'sender_name_field',                // $id
        'Sender Name',                      // $title
        'cbj_render_sender_name_setting',   // $callback
        'general',                          // $page
        'sender_email_section'              // $section
    );

    // Callback function to render sender_name_field setting
    function cbj_render_sender_name_setting() {
        $value = get_option('sender_name', '');
        ?>
        <input 
            name="sender_name" 
            type="text" 
            id="sender_name" 
            aria-describedby="sender-name-description" 
            value="<?php echo esc_attr($value); ?>" 
            class="regular-text"
        />
        <p class="description" id="sender-name-description">
            This name is used to override the default email sender name.
        </p>
        <?php
    }

} add_action( 'admin_init', 'cbj_register_sender_settings' );

/****************************************************************************************/

/* Change default from email address */
add_filter( 'wp_mail_from', function( $original_email_address ) {       // https://developer.wordpress.org/reference/hooks/wp_mail_from/
    $value = get_option('sender_email', '');
    return esc_attr($value);
});

/* Change default from name */
add_filter( 'wp_mail_from_name', function( $original_email_from ) {         // https://developer.wordpress.org/reference/hooks/wp_mail_from_name/
    $value = get_option('sender_name', '');
    return esc_attr($value);
});

