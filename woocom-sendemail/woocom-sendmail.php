<?php
/**
 * Plugin Name: WooEmailSender
 * Description:  Envoyer un e-mail a la l'inscription woocommerce.
 * Version: 1.0
 * Author: Me
 */

add_action('woocommerce_created_customer', 'admin_email_on_registration', 10, 1);

function admin_email_on_registration($customer_id)
{
    // Récupérer les informations de l'utilisateur
    $user = get_userdata($customer_id);
    // Récupérer l'adresse e-mail de l'administrateur
    $admin_email = get_option('admin_email');
    // Envoyer un e-mail à l'administrateur
    $subject = 'Nouveau client inscrit';
    // l'objet $user est constitué de plusieurs informations dont l'email voir vardump($user);
    $message = 'Un nouveau client s\'est inscrit : ' . $user->user_email;
    // wpmail prends 3 parametres : l'email de l'admin, l'objet du mail et le message.
    // pour envoyé un mail à l'admin wp_mail utilise la fonction mail() de php.
    wp_mail($admin_email, $subject, $message);
}

// object User :
# object(WP_User)#16075 (8) {
# ["data"]=> object(stdClass)#300 (10) {
# ["ID"]=> string(1) "7" ["user_login"]=> string(14) "81821665c23556"
# ["user_pass"]=> string(34) "$P$Bs5nDbRY7jQTH.pu34lsJoS6Beopzu."
# ["user_nicename"]=> string(14) "81821665c23556"
# ["user_email"]=> string(33) "81821665c23556@ez.cashbenties.com"
# ["user_url"]=> string(0) "" ["user_registered"]=> string(19) "2024-02-06 13:34:22"
# ["user_activation_key"]=> string(0) ""
# ["user_status"]=> string(1) "0"
# ["display_name"]=> string(14) "81821665c23556" } ["ID"]=> int(7) ["caps"]=> array(1) { ["customer"]=> bool(true) } ["cap_key"]=> string(15) "wp_capabilities"
# ["roles"]=> array(1) { [0]=> string(8) "customer" }
# ["allcaps"]=> array(2) { ["read"]=> bool(true) ["customer"]=> bool(true) }
# ["filter"]=> NULL
# ["site_id":"WP_User":private]=> int(1)

?>