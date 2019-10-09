<?php
/*
 * Plugin Name: WP Logo Grid
 * Description: Creates responsive grid overviews of customers, partners, sponsors or similar.
 * Version: 1.0.0
 * Author: Peter R. Stuhlmann
 * Author URI: https://peter-stuhlmann-webentwicklung.de
 */

// Stylesheets and JavaScript files
function wp_logo_grid_enqueue_scripts() {
    wp_enqueue_style( 'wp_logo_grid-styles', plugin_dir_url( __FILE__ ) . "/assets/css/styles.css", '', '20191007');
}
add_action( 'wp_enqueue_scripts', 'wp_logo_grid_enqueue_scripts' );

// Accept image IDs, seperated by commas and output images in a flexbox div
function wp_logo_grid_flexbox($atts, $content = NULL) {
    $array1 = preg_split("/[,]+/", $content );
    $output = '<div class="x_flex">';
    foreach ($array1 as $value) {
        $image = wp_get_attachment_url($value);
        $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
        $output .= '<div><img src="' . $image . '" alt="' . $alt . '" /></div>';
    }
    return $output . '</div>';
}
add_shortcode('x', 'wp_logo_grid_flexbox');

// Plugin row meta
function wp_logo_grid_plugin_row_meta( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'donate' => '<a href="https://www.paypal.me/prstuhlmann/2" style="color: green" target="_blank">Donate</a>'
        );
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}
add_filter( 'plugin_row_meta', 'wp_logo_grid_plugin_row_meta', 10, 2 );


// Plugin action links
function wp_logo_grid_plugin_action_links( $links ) {
   $links[] = '<a href="' . plugin_dir_url( __FILE__ ) . 'manual.html" style="color: green" target="_blank">Manual</a>';
   return $links;
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'wp_logo_grid_plugin_action_links' );
