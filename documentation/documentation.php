<?php


/*
Plugin Name: The documentation by l'équipe de jose
Description: La documentation pour la documentation
Version: 1.0
Author: Jose.inc
*/

if (!defined('ABSPATH')) {
    exit;
}

function wpdocs_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Documentation',
        'manage_options',
        'documentation/my-doc.php',
        '',
        plugins_url( 'documentation/images/book.png' ),
        6
    );
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );