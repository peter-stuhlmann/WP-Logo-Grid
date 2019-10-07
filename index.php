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
