<?php
/*
 * Plugin Name: Plugin Chouquette
 * Description: Plugin pour mettre des chouquette devant les titres
 * Version: 1.0
 */

if(!defined('ABSPATH')){
    exit; // exit if accessed directly
}




    add_filter( 'document_title_parts', function( $title ) {
            $title[] = 'Chouquette';
        return $title;
    } );

