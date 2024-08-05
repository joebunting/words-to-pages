<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function w2p_shortcode($atts) {
    $atts = shortcode_atts(array(
        'type' => ''
    ), $atts, 'w2p');

    ob_start();
    ?>
    <div class="w2p-calculator">
        <h3>Word Count to Page Count</h3>
        <?php if (empty($atts['type'])): ?>
            <label><input type="radio" name="w2p-type" value="simple" checked> Simple</label>
            <label><input type="radio" name="w2p-type" value="advanced"> Advanced</label>
        <?php elseif ($atts['type'] == 'simple'): ?>
            <input type="number" id="w2p-word-count" placeholder="Enter word count">
            <input type="number" id="w2p-words-per-page" placeholder="Words per page (default: 250)">
            <button id="w2p-calculate-simple">Calculate</button>
            <p id="w2p-result-simple"></p>
        <?php elseif ($atts['type'] == 'advanced'): ?>
            <input type="number" id="w2p-word-count-adv" placeholder="Enter word count">
            <input type="number" id="w2p-page-size" placeholder="Page size (in inches)">
            <input type="number" id="w2p-font-size" placeholder="Font size (in points)">
            <input type="number" id="w2p-line-height" placeholder="Line height (in points)">
            <button id="w2p-calculate-advanced">Calculate</button>
            <p id="w2p-result-advanced"></p>
        <?php elseif ($atts['type'] == 'analyzer'): ?>
            <textarea id="wpc-text-input" rows="10" placeholder="Paste your full manuscript text here"></textarea>
            <button id="wpc-analyze-text">Analyze</button>
            <p id="wpc-text-result"></p>
            <p>Your manuscript is private and will not be stored. This is for calculation purposes only.</p>
        <?php endif; ?>
    </div>
    <div class="twp-attribution hidden">
        <p>Powered by <a href="https://thewritepractice.com" target="_blank">The Write Practice</a></p>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('w2p', 'w2p_shortcode');

// Add more shortcodes for other calculators as needed