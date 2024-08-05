<?php
/*
Plugin Name: Words to Pages Calculations
Description: A plugin for various word count and page count calculations for authors. Use the shortcode [w2p] to display the calculator on your site. Use the shortcode `[w2p]` in your post or page.You can specify the type of calculator by adding the `type` attribute: `[w2p type="simple"]` for the simple calculator, `[w2p type="advanced"]` for the advanced calculator, `[w2p type="analyzer"]` for the text analyzer.
Version: 1.0
Author: Story Cartel
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

define('WORDS_TO_PAGES_VERSION', filemtime(__FILE__));
define('WORDS_TO_PAGES_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WORDS_TO_PAGES_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WORDS_TO_PAGES_GITHUB_REPO', 'joebunting/words-to-pages');
define('WORDS_TO_PAGES_PLUGIN_SLUG', 'words-to-pages');


// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/calculators.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';

// Enqueue scripts and styles
function wpc_enqueue_scripts() {
    wp_enqueue_style('wpc-style', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), WORDS_TO_PAGES_VERSION);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3');
    wp_enqueue_script('wpc-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), WORDS_TO_PAGES_VERSION, true);
}
add_action('wp_enqueue_scripts', 'wpc_enqueue_scripts');

function words_to_pages_github_updater() {
    if (!class_exists('WP_GitHub_Updater')) {
        include_once plugin_dir_path(__FILE__) . 'updater.php';
    }
    if (class_exists('WP_GitHub_Updater')) {
        $updater = new WP_GitHub_Updater(array(
            'slug' => 'words-to-pages',
            'plugin' => plugin_basename(__FILE__),
            'github_repo' => 'joebunting/words-to-pages',
            'access_token' => '' // Optional: for private repos
        ));
    }
}
add_action('init', 'words_to_pages_github_updater');