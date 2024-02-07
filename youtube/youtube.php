<?php
/*
 * Plugin Name: Plugin IT Youtube
 * Description: Plugin video
 * Version: 1.0
 */

if(!defined('ABSPATH')){
    exit; // exit if accessed directly
}



add_action('init','youtube_init_shortcode');


function youtube_init_shortcode(){
    add_shortcode('video','youtube_do_shortcode',10,1);
}

function youtube_do_shortcode($attrs){
    $output ='';
    $url_choisi = '';
    if(!isset($attrs['source']) or empty($attrs['source'])){
        return $output;
    }
    if(!isset($attrs['height']) or empty($attrs['height'])){
        $attrs['height'] = '100px';
    }
    if(!isset($attrs['width']) or empty($attrs['width'])){
        $attrs['width'] = '300px';
    }
    if(!isset($attrs['controls']) or empty($attrs['controls'])){
        $attrs['controls'] = '0';
    }
    if(!isset($attrs['lecteur']) or empty($attrs['lecteur'])){
        $url_choisi = 'https://www.youtube.com/embed/%s?controls=%s';
    }
    switch ($attrs['lecteur']){
        case 'youtube':
            $url_choisi = 'https://www.youtube.com/embed/%s?controls=%s';
            break;
        case 'vimeo':
            $url_choisi = "https://player.vimeo.com/video/";
            break;
        case 'dailymotion':
            $url_choisi = "https://www.dailymotion.com/video/";
            break;
        default:
            return $output;
    }





    $url = sprintf($url_choisi, $attrs['source'],$attrs['controls']);
    $output .= sprintf('<iframe width="'. $attrs['width'].'" height="'.$attrs['height'].'" src="'.$url.'" allow="autoplay;
     encrypted-media" allowfullscreen></iframe>',$url);
    return $output;
}


