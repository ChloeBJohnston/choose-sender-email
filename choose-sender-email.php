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

/* Change default from email address */
add_filter( 'wp_mail_from', function( $original_email_address ) {
    return 'webhost@happyearth.dev';
});

/* Change default from name */
add_filter( 'wp_mail_from_name', function( $original_email_from ) {
    return 'Happy Earth Development';
});

/****************************************************************************************/

/* Add 'Choose Sender Email' Section to WP Settings Page */

function cbj_add_choose_sender_email_section() {

    /* Add section to WP settings page */
    add_settings_section(                       // https://developer.wordpress.org/reference/functions/add_settings_section
        'sender_email_section',                 // $id
        'Choose Sender Email',                  // $title
        'cbj_render_sender_email_section',      // $callback
        'general'                               // $page
    );

    function cbj_render_sender_email_section() {
    /* placeholder */
    }

} add_action( 'admin_init', 'cbj_add_choose_sender_email_section' );




