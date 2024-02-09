<?php

/*
Plugin Name: Input personnalisé de place
Description: ajout d'input: date de l'événement, heure, description, informations privées
Version: 1.0
Author: Valentin l'incroyable
*/

// Je recupere dans la base de donnée, active plugin qui me servira pour la vérification
$active_plugins = get_option('active_plugins');
// Je check si c'est activé dans woocomerce.php
if (in_array('woocommerce/woocommerce.php', $active_plugins)) {

    // J'active ma fonction lors de l'initialisation de acf/init
    add_action('acf/init', 'my_acf_fields');

    // j'active ma fonction qui ajoute le style et le script dans le hook wp_enqueue_scripts
    add_action('wp_enqueue_scripts', 'Plugin_Front_enqueue_scripts_and_style');

    // Ajout du shortCode des premieres infos
    add_shortcode( 'perso', 'ajoutPerso' );

    // Ajout du shortCode prive qui contiendra les information sensible
    add_shortcode('prive','informations_privees');

    function my_acf_fields()
    {
        // Vérifie si ACF est actif
        if (function_exists('acf_add_local_field_group')) {

            // Définition d'un tableau pour stocker les paramètres du groupe de champs
            $fields = array(
                'key' => 'group_601f3bb9fbd0e',
                'title' => 'Information personnalisé',
                'fields' => array(
                    array(
                        'key' => 'field_601f3bc9fbd0fhhh',
                        'label' => 'Date de l\'evennement',
                        'name' => 'date_event',
                        'type' => 'date_picker',
                        'instructions' => 'Saisissez votre date ici',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_601f3bc9fbd0fgg',
                        'label' => 'Heure de l\'évennement',
                        'name' => 'heure_event',
                        'type' => 'time_picker',
                        'instructions' => 'Saisissez votre heure d\'evennement',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_601f3bc9fbd0fff',
                        'label' => 'Description de l\'evennement',
                        'name' => 'description_event',
                        'type' => 'text',
                        'instructions' => 'Saisissez votre description ici',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_601f3bc9fbd0fdd',
                        'label' => 'informations privées',
                        'name' => 'info_perso',
                        'type' => 'text',
                        'instructions' => 'Saisissez toute élement personnelle utile.',
                        'required' => 1,
                    ),

                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'product',
                        ),
                    ),
                ),
            );

            // Enregistrement du groupe de champs
            acf_add_local_field_group($fields);
        }
    }



    // fonction qui charge les style et script sur le front
    function Plugin_Front_enqueue_scripts_and_style()
    {
        wp_enqueue_script('script', plugins_url('js/script.js', __FILE__), array('jquery'), '', true);

        wp_enqueue_style('style', plugins_url('css/style.css', __FILE__));
    }



    // fonction qui retourne les valeurs de la bdd sur le front
    function ajoutPerso( $atts, $content ) {

        $id = get_the_ID();

        $dateBdd = get_post_meta(
            $id,
            'date_event',
            true
        );

        $heure = get_post_meta(
            $id,
            'heure_event',
            true
        );

        $description = get_post_meta(
            $id,
            'description_event',
            true
        );

        $date = date( 'Y-m-d', strtotime( $dateBdd ) );
        $event_datetime = strtotime($date . ' ' . $heure);
        $event_datetime = strtotime('-1 hour',$event_datetime);

        return '
                <ul>
                <li>date de l\'evennement: '.$date.'</li>
                <li>heure de l\'evennement: '.$heure.'</li>
                <li>description de l\'evennement: '.$description.'</li>
                </ul>
                <div><div id="MyClockDisplay" class="clock" onload="showTime()"></div>
                <input type=hidden id=variableAPasser value="'.$event_datetime.'"/></div>';
    }


    // Fonction qui vérifie si le client a acheté un produit et dans ce cas affiche le le contenu du shortcode prive
    function informations_privees(){

        $infohtml='';
        // si le user est connecté
        if (is_user_logged_in()) {

            $user_id = get_current_user_id();
            $product_id = get_the_ID();

            // si il a acheté un produit
            if (wc_customer_bought_product($user_id, $user_id, $product_id)) {

                $id = get_the_ID();

                $info = get_post_meta(
                    $id,
                    'info_perso',
                    true
                );

                $infohtml = '<p>Information privée : '.$info.'</p>';

            }

        }
        return $infohtml;
    }

}else{
    // j'ai mis un echo en cas de probleme de non-chargement activation de woocommerce.
    echo('Woocommerce n\'a pas été activé!');
}






