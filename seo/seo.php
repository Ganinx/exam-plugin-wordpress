<?php
/*
Plugin Name:    Seo
Description:    Rajoute les inputs du titre et de la méta description
Version: 1.0
*/

if (!defined('ABSPATH')) {
    exit;
}

add_action("add_meta_boxes","seo_add_form");
add_action("save_post","seo_save_form");
add_filter('pre_get_document_title','seo_change_title');
add_action('wp_head','seo_change_meta_description');

function seo_add_form(): void{
    add_meta_box(
        'my-meta-box',
        __( 'My Meta Box' ),
        'render_my_meta_box',
        'page',
        'normal',
        'default'
    );
}
function render_my_meta_box($post): void{

    $title = get_post_meta(
        $post->ID,
        'seo_title',
        true
    );

    $meta_description = get_post_meta(
        $post->ID,
        'seo_meta_description',
        true
    );


    echo '  <label for="seo_title">Titre de la page: </label>
            <input type="text" name="seo_title" placeholder="titre de la page" value="'.$title.'"> <br>
            <label for="seo_meta_description">Meta description de la page: </label>
            <input type="text" name="seo_meta_description" placeholder="meta description" value="'.$meta_description.'">';
}
function seo_save_form($post_id): void{
    if(isset($_POST['seo_title'])){
        update_post_meta(
            $post_id,
            'seo_title',
            $_POST['seo_title']
        );
    }

    if(isset($_POST['seo_meta_description'])){
        update_post_meta(
            $post_id,
            'seo_meta_description',
            $_POST['seo_meta_description']
        );
    }
}

function seo_change_title(){
    $id = get_the_ID();

    $title = get_post_meta(
        $id,
        'seo_title',
        true
    );
    return $title;
}

function seo_change_meta_description(){
    $id = get_the_ID();
    $meta_description = get_post_meta(
        $id,
        'seo_meta_description',
        true
    );

    echo '<meta name="description" content="'.$meta_description.'">';
}