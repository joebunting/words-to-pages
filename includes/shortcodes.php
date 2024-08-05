<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function wpc_word_to_page_simple_shortcode() {
    ob_start();
    ?>
    <div class="wpc-calculator">
        <h3>Word Count to Page Count (Simple)</h3>
        <input type="number" id="wpc-word-count" placeholder="Enter word count">
        <input type="number" id="wpc-words-per-page" placeholder="Words per page (default: 250)">
        <button id="wpc-calculate-simple">Calculate</button>
        <p id="wpc-result-simple"></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('wpc_word_to_page_simple', 'wpc_word_to_page_simple_shortcode');

function wpc_word_to_page_advanced_shortcode() {
    ob_start();
    ?>
    <div class="wpc-calculator">
        <h3>Word Count to Page Count (Advanced)</h3>
        <input type="number" id="wpc-word-count-adv" placeholder="Enter word count">
        <input type="number" id="wpc-page-size" placeholder="Page size (in inches)">
        <input type="number" id="wpc-font-size" placeholder="Font size (in points)">
        <input type="number" id="wpc-line-height" placeholder="Line height (in points)">
        <button id="wpc-calculate-advanced">Calculate</button>
        <p id="wpc-result-advanced"></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('wpc_word_to_page_advanced', 'wpc_word_to_page_advanced_shortcode');

function wpc_text_analyzer_shortcode() {
    ob_start();
    ?>
    <div class="wpc-calculator">
        <h3>Text Analyzer</h3>
        <textarea id="wpc-text-input" rows="10" placeholder="Paste your text here"></textarea>
        <button id="wpc-analyze-text">Analyze</button>
        <p id="wpc-text-result"></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('wpc_text_analyzer', 'wpc_text_analyzer_shortcode');

// Add more shortcodes for other calculators as needed