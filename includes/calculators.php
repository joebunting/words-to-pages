<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function wpc_word_to_page_simple($word_count, $words_per_page = 250) {
    return ceil($word_count / $words_per_page);
}

function wpc_word_to_page_advanced($word_count, $page_size, $font_size, $line_height) {
    // This is a simplified calculation and may need refinement
    $words_per_line = floor((float)$page_size / (float)$font_size);
    $lines_per_page = floor((float)$page_size / (float)$line_height);
    $words_per_page = $words_per_line * $lines_per_page;
    return ceil($word_count / $words_per_page);
}

function wpc_page_to_word_simple($page_count, $words_per_page = 250) {
    return $page_count * $words_per_page;
}

function wpc_count_words_in_text($text) {
    return str_word_count(strip_tags($text));
}