<?php
/*
 * Plugin Name: Bold
 * Description: Plugin pour mettre du texte en gras
 * Version: 1.0
 */

if(!defined('ABSPATH')){
    exit; // exit if accessed directly
}


function bold_shortcode( $atts, $content ) {
    return '<strong>' . $content . '<strong>';
}


add_shortcode( 'bold', 'bold_shortcode' );

