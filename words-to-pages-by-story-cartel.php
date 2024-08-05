<?php
/*
Plugin Name: Words to Pages Calculations
Description: A plugin for various word count and page count calculations.
Version: 1.0
Author: Story Cartel
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/calculators.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Enqueue scripts and styles
function wpc_enqueue_scripts() {
    wp_enqueue_style('wpc-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('wpc-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'wpc_enqueue_scripts');