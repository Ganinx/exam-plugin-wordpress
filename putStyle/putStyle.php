<?php

/*
Plugin Name: Plugin frontback
Description: Exercice pages ajout
Version: 1.0
Author: Romain Aurélie Sabrina Emeline
*/

if (!defined('ABSPATH')) {
    exit;
}

// Chercher les Hooks

// Récupérer les fichiers - dans quels dossiers sont-ils rangés ?
// On les met où ?
// Les créer : 1 fichier JS et un fichier CSS

// Fonction : comment récupère t-on les fichiers ?
// Comment on les intègre ?

function Plugin_FrontBack_enqueue_styles()
{
    wp_enqueue_style('style', plugins_url('css/style.css', __FILE__));
}



function Plugin_FrontBack_enqueue_scripts()
{
    wp_enqueue_script('script', plugins_url('js/script.js', __FILE__), array('jquery'), '', true);
}

if (is_admin()) {
    add_action('admin_enqueue_scripts', 'Plugin_FrontBack_enqueue_scripts');
} else {
    add_action('wp_enqueue_scripts', 'Plugin_FrontBack_enqueue_styles');
}