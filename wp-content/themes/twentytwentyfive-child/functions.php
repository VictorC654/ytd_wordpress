<?php

function child_theme_enqueue_styles() {
    wp_enqueue_style('twentytwentyfive-child-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));
}
add_action('wp_enqueue_scripts', 'child_theme_enqueue_styles');

