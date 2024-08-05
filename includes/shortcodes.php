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
        <label><input type="radio" name="w2p-type" value="simple" checked> Simple</label>
        <label><input type="radio" name="w2p-type" value="advanced"> Advanced</label>

        <div id="simple-calculator" class="calculator">
            <input type="number" id="w2p-word-count" placeholder="Enter word count">
            <input type="number" id="w2p-words-per-page" placeholder="Words per page (default: 250)">
            <button id="w2p-calculate-simple">Calculate</button>
            <p id="w2p-result-simple"></p>
        </div>

        <div id="advanced-calculator" class="calculator" style="display: none;">
            <input type="number" id="w2p-word-count-adv" placeholder="Enter word count">
            <input type="number" id="w2p-page-size" placeholder="Page size (in inches)">
            <input type="number" id="w2p-font-size" placeholder="Font size (in points)">
            <input type="number" id="w2p-line-height" placeholder="Line height (in points)">
            <button id="w2p-calculate-advanced">Calculate</button>
            <p id="w2p-result-advanced"></p>
        </div>
    </div>
    <div class="twp-attribution hidden">
        <p>Powered by <a href="https://thewritepractice.com" target="_blank">The Write Practice</a></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const simpleRadio = document.querySelector('input[name="w2p-type"][value="simple"]');
            const advancedRadio = document.querySelector('input[name="w2p-type"][value="advanced"]');
            const simpleCalculator = document.getElementById('simple-calculator');
            const advancedCalculator = document.getElementById('advanced-calculator');

            simpleRadio.addEventListener('change', function() {
                if (this.checked) {
                    simpleCalculator.style.display = 'block';
                    advancedCalculator.style.display = 'none';
                }
            });

            advancedRadio.addEventListener('change', function() {
                if (this.checked) {
                    simpleCalculator.style.display = 'none';
                    advancedCalculator.style.display = 'block';
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('w2p', 'w2p_shortcode');

// Add more shortcodes for other calculators as needed