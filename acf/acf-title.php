<?php

/*
Plugin Name: Plugin acf
Description: Omg le plugin
Version: 1.0
Author: Jose.inc
*/

// Fonction pour enregistrer les champs personnalisés
function my_acf_fields() {

    // Vérifie si ACF est actif
    if( function_exists('acf_add_local_field_group') ) {

        // Définition d'un tableau pour stocker les paramètres du groupe de champs
        $fields = array(
            'key' => 'group_601f3bb9fbd0e',
            'title' => 'Mon Groupe de Champs',
            'fields' => array(
                array(
                    'key' => 'field_601f3bc9fbd0f',
                    'label' => 'Mon Champ Texte',
                    'name' => 'mon_champ_texte',
                    'type' => 'text',
                    'instructions' => 'Saisissez votre texte ici.',
                    'required' => 1,
                ),
                // Ajoutez d'autres champs selon vos besoins
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post', // Vous pouvez changer le type de publication ici
                    ),
                ),
            ),
        );

        // Enregistrement du groupe de champs
        acf_add_local_field_group( $fields );
    }
}

// Hook pour enregistrer les champs personnalisés
add_action('acf/init', 'my_acf_fields');