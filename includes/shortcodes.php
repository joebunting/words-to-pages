<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function w2p_shortcode($atts) {
    $atts = shortcode_atts(array(
        'type' => ''
    ), $atts, 'w2p');

    ob_start();
    ?>
    <div id="w2p-calculator-container" data-type="<?php echo $atts['type']; ?>">
        <div class="w2p-calculator">
            <h3>Word Count to Page Count Calculator</h3>
            <?php if (empty($atts['type'])): ?>
                <div class="w2p-calculator-options">
                    <label><input type="radio" name="w2p-type" value="word-to-page-simple" checked> Words to Pages (Simple)</label>
                    <label><input type="radio" name="w2p-type" value="word-to-page-advanced"> Words to Pages (Advanced)</label>
                    <label><input type="radio" name="w2p-type" value="page-to-word-simple"> Pages to Words (Simple)</label>
                    <label><input type="radio" name="w2p-type" value="page-to-word-advanced"> Pages to Words (Advanced)</label>
                    <label><input type="radio" name="w2p-type" value="analyzer"> Full Manuscript Calculator</label>
                </div>
            <?php endif; ?>

            <div id="simple-calculator" class="calculator">
                <label><strong>Enter your word count</strong></label>
                <input type="number" id="w2p-word-count" placeholder="Word count">
                <label><strong>How many words per page? (default: 250)</strong></label>
                <input type="number" id="w2p-words-per-page" placeholder="Words per page=" value="250">
                <button id="w2p-calculate-simple">Calculate »</button>
                <div class="result-box">
                    <h3>Result</h3>
                    <p id="w2p-result-simple"></p>
                </div>
            </div>

            <div id="advanced-calculator" class="hidden">
                <label><strong>Enter your word count</strong></label>
                <input type="number" id="w2p-word-count-adv" placeholder="Enter word count">
                <label><strong>Page size</strong></label>
                <select id="w2p-page-size">
                    <option value="5x8" selected>Trade Paperback 5" x 8"</option>
                    <option value="5.5x8.5">Digest 5.5" x 8.5"</option>
                    <option value="6x9">US Trade 6" x 9"</option>
                    <option value="7x10">Textbook 7" x 10"</option>
                    <option value="8.5x11">Letter 8.5" x 11"</option>
                </select>
                <label><strong>Font size (in points)</strong></label>
                <select id="w2p-font-size">
                    <option value="10">Small (10 pt)</option>
                    <option value="11">Smaller (11 pt)</option>
                    <option value="12" selected>Normal (12 pt)</option>
                    <option value="14">Large (14 pt)</option>
                </select>
                <label><strong>Line height</strong></label>
                <select id="w2p-line-height">
                    <option value="1.2">Compact (1.2x)</option>
                    <option value="1.5" selected>Standard (1.5x)</option>
                    <option value="1.8">Spacious (1.8x)</option>
                </select>
                <label><strong>Margins</strong></label>
                <select id="w2p-margins">
                    <option value="0.5">Narrow (0.5 inches)</option>
                    <option value="0.75" selected>Normal (0.75 inches)</option>
                    <option value="1">Wide (1 inch)</option>
                </select>
                <button id="w2p-calculate-advanced" class="w2p-calculator-button">Calculate »</button>
                <div class="result-box">
                    <h3>Result</h3>
                    <p id="w2p-result-advanced" class="w2p-calculator-result"></p>
                </div>
            </div>

            <div id="analyzer-calculator" class="hidden">
                <p>Copy and paste your entire manuscript below, then click "Analyze" to get your estimated word count and book page numbers.</p>
                <p><em>Your text will not be stored. This is for word count checking only.</em></p>
                <textarea id="w2p-text-input" placeholder="Copy and paste your complete manuscript to analyze" style="height: 400px;"></textarea>
                <button id="w2p-analyze-text">Analyze »</button>
                <div class="result-box">
                    <h3>Result</h3>
                    <p id="w2p-text-result"></p>
                </div>
            </div>

            <div id="page-to-word-simple-calculator" class="hidden">
                <label><strong>Enter your page count</strong></label>
                <input type="number" id="w2p-page-count-simple" placeholder="Page count">
                <label><strong>How many words per page? (default: 250)</strong></label>
                <input type="number" id="w2p-words-per-page-simple" placeholder="Words per page" value="250">
                <button id="w2p-calculate-page-to-word-simple">Calculate »</button>
                <div class="result-box">
                    <h3>Result</h3>
                    <p id="w2p-result-page-to-word-simple"></p>
            </div>
            <!--
            <div id="page-to-word-advanced-calculator" class="hidden">
                <label><strong>Enter your page count</strong></label>
                <input type="number" id="w2p-page-count-adv" placeholder="Page count">
                <label><strong>Page size</strong></label>
                <select id="w2p-page-size-ptw">
                    <option value="5x8" selected>Trade Paperback 5" x 8"</option>
                    <option value="5.5x8.5">Digest 5.5" x 8.5"</option>
                    <option value="6x9">US Trade 6" x 9"</option>
                    <option value="7x10">Textbook 7" x 10"</option>
                    <option value="8.5x11">Letter 8.5" x 11"</option>
                </select>
                <label><strong>Font size (in points)</strong></label>
                <select id="w2p-font-size-ptw">
                    <option value="10">Small (10 pt)</option>
                    <option value="11">Smaller (11 pt)</option>
                    <option value="12" selected>Normal (12 pt)</option>
                    <option value="14">Large (14 pt)</option>
                </select>
                <label><strong>Line height</strong></label>
                <select id="w2p-line-height-ptw">
                    <option value="1.2">Compact (1.2x)</option>
                    <option value="1.5" selected>Standard (1.5x)</option>
                    <option value="1.8">Spacious (1.8x)</option>
                </select>
                <label><strong>Margins</strong></label>
                <select id="w2p-margins-ptw">
                    <option value="0.5">Narrow (0.5 inches)</option>
                    <option value="0.75" selected>Normal (0.75 inches)</option>
                    <option value="1">Wide (1 inch)</option>
                </select>
                <button id="w2p-calculate-page-to-word-advanced" class="w2p-calculator-button">Calculate »</button>
                <div class="result-box">
                    <h3>Result</h3>
                    <p id="w2p-result-page-to-word-advanced" class="w2p-calculator-result"></p>
                </div>
            </div>
            -->
        </div>
    </div>
        <div class="twp-attribution hidden">
            <p>Powered by <a href="https://thewritepractice.com" target="_blank">The Write Practice</a></p>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('w2p', 'w2p_shortcode');

// Add more shortcodes for other calculators as needed