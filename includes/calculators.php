<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

function wpc_word_to_page_simple($word_count, $words_per_page = 250) {
    return ceil($word_count / $words_per_page);
}

function wpc_word_to_page_advanced($word_count, $page_size, $font_size, $line_height, $margins) {
    list($page_width, $page_height) = explode('x', $page_size);
    $page_width = (float)$page_width;
    $page_height = (float)$page_height;

    $usable_width = $page_width - 2 * $margins;
    $usable_height = $page_height - 2 * $margins;

    $cpi = 15 - ($font_size - 12) * 0.6;
    $chars_per_line = floor($usable_width * $cpi);
    $words_per_line = $chars_per_line / 5.5;

    $line_height_inches = ($font_size / 72) * $line_height;
    $lines_per_page = floor($usable_height / $line_height_inches);

    $adjustment_factor = $line_height <= 1.2 ? 0.97 : 0.95;
    $words_per_page = round($words_per_line * $lines_per_page * $adjustment_factor);
    $page_count = ceil($word_count / $words_per_page);

    return array(
        'page_count' => $page_count,
        'words_per_page' => $words_per_page
    );
}

function wpc_page_to_word_advanced($page_count, $page_size, $font_size, $line_height, $margins) {
    list($page_width, $page_height) = explode('x', $page_size);
    $page_width = (float)$page_width;
    $page_height = (float)$page_height;

    $usable_width = $page_width - 2 * $margins;
    $usable_height = $page_height - 2 * $margins;

    $cpi = 15 - ($font_size - 12) * 0.6;
    $chars_per_line = floor($usable_width * $cpi);
    $words_per_line = $chars_per_line / 5.5;

    $line_height_inches = ($font_size / 72) * $line_height;
    $lines_per_page = floor($usable_height / $line_height_inches);

    $adjustment_factor = $line_height <= 1.2 ? 0.97 : 0.95;
    $words_per_page = round($words_per_line * $lines_per_page * $adjustment_factor);
    $word_count = $page_count * $words_per_page;

    return array(
        'word_count' => $word_count,
        'words_per_page' => $words_per_page
    );
}

function wpc_page_to_word_simple($page_count, $words_per_page = 250) {
    return $page_count * $words_per_page;
}

function wpc_count_words_in_text($text) {
    return str_word_count(strip_tags($text));
}