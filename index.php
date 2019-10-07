<?php
/*
 * Plugin Name: Plugin
 * Description: Wordpress plugin.
 * Version: 1.0.0
 * Author: Peter R. Stuhlmann
 * Author URI: https://peter-stuhlmann-webentwicklung.de
 */

// Stylesheets and JavaScript files
function plugin_enqueue_scripts() {
    wp_enqueue_style( 'plugin-styles', plugin_dir_url( __FILE__ ) . "/assets/css/style.css", '', '20191007');
}
add_action( 'wp_enqueue_scripts', 'plugin_enqueue_scripts' );

// Accept image IDs, seperated by commas and output images in a flexbox div
function plugin_display_logos($atts, $content = NULL) {
    $array1 = preg_split("/[,]+/", $content );
    $output = '<div>';
    foreach ($array1 as $value) {
        $image = wp_get_attachment_url($value);
        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
        $output .= '<img src="' . $image . '" alt="' . $alt . '" />';
    }
    return $output . '</div>';
}
add_shortcode('x', 'plugin_display_logos');