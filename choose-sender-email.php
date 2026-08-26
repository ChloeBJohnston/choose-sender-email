<?php
/*
Plugin Name: Choose Sender Email
Plugin URI: https://chloebjohnston.com
Description: specify email address for WordPress system mail
Author: Chloe Johnston
Version: 1.0.0
Author URI: https://chloebjohnston.com
Update URI: false
*/

if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'wp_mail_from', function( $original_email_address ) {
    return 'webhost@happyearth.dev';
});

add_filter( 'wp_mail_from_name', function( $original_email_from ) {
    return 'Happy Earth Development';
});

