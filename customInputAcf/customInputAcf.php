<?php

/*
Plugin Name: Input personnalisé de place
Description: ajout d'input: date de l'événement, heure, description, informations privées
Version: 1.0
Author: Valentin l'incroyable
*/

// Fonction pour enregistrer les champs personnalisés
$active_plugins = get_option('active_plugins');
if (in_array('woocommerce/woocommerce.php', $active_plugins)) {
    function my_acf_fields()
    {
        // Vérifie si woocommerce est actif

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

                    // Ajoutez d'autres champs selon vos besoins
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
    add_action('acf/init', 'my_acf_fields');


    add_action("save_post", "acf_save_form_product");



    function acf_save_form_product($post_id): void
    {
        if (isset($_POST['date_event'])) {
            update_post_meta(
                $post_id,
                'date_event',
                $_POST['date_event']
            );
        }

        if (isset($_POST['heure_event'])) {
            update_post_meta(
                $post_id,
                'heure_event',
                $_POST['heure_event']
            );
        }
        if (isset($_POST['description_event'])) {
            update_post_meta(
                $post_id,
                'description_event',
                $_POST['description_event']
            );
        }

        if (isset($_POST['info_perso'])) {
            update_post_meta(
                $post_id,
                'info_perso',
                $_POST['info_perso']
            );
        }
    }





    function Plugin_Front_enqueue_scripts()
    {
        wp_enqueue_script('script', plugins_url('js/script.js', __FILE__), array('jquery'), '', true);
        wp_enqueue_style('style', plugins_url('css/style.css', __FILE__));
    }


        add_action('wp_enqueue_scripts', 'Plugin_Front_enqueue_scripts');



    function ajoutPerso( $atts, $content ) {
        $id = get_the_ID();
        $date = get_post_meta(
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

        return '
<ul>
<li>date de l\'evennement: '.$date.'</li>
<li>heure de l\'evennement: '.$heure.'</li>
<li>description de l\'evennement: '.$description.'</li></ul>';
    }


    add_shortcode( 'perso', 'ajoutPerso' );


    add_shortcode('compteur','compteur');

    function compteur(){
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
        $date = date( 'Y-m-d', strtotime( $dateBdd ) );
        $event_datetime = strtotime($date . ' ' . $heure);

        return '<div><div id="MyClockDisplay" class="clock" onload="showTime()"></div><input type=hidden id=variableAPasser value="'.$event_datetime.'"/></div>';
    }

    function informations_privees(){

        $infohtml='';
        if (is_user_logged_in()) {

            $user_id = get_current_user_id();
            $product_id = get_the_ID();


            if (wc_customer_bought_product($user_id, $user_id, $product_id)) {

                $id = get_the_ID();

                $info = get_post_meta(
                    $id,
                    'info_perso',
                    true
                );

                $infohtml = '<p>Info privé : '.$info.'</p>';

            }

        }
        return $infohtml;
    }
    add_shortcode('prive','informations_privees');
}else{
    echo('arretez vous !');
}






