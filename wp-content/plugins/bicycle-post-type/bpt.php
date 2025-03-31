<?php
/*
Plugin Name: Bicycle Post Type
Description: A plugin that adds a bicycle post type to a wp app.
Author: Victor
Version: 1.0
*/

/**
 * For security, no direct access to plugin
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Function for registration of the custom bicycle post type
 */
function bpt_bicycle_post_type() {

    /**
     * Labels for the admin interface
     */
    $labels = array(
        'name' => __('Bicycles'),
        'singular_name' => __('Bicycle'),
        'add_new' => __('Add New Bicycle'),
        'add_new_item' => __('Add New Bicycle'),
        'edit_item' => __('Edit Bicycle'),
        'new_item' => __('New Bicycle'),
        'all_items' => __('All Bicycles'),
        'view_item' => __('View Bicycle'),
        'search_items' => __('Search Bicycles'),
        'featured_image' => __('Add image'),
        'set_featured_image' => __('Set image'),
    );

    /**
     * Settings for the custom post types
     */
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'bicycles'),
        'show_in_rest' => true, // for gutenberg
    );

    /**
     * Registers the custom post type
     */
    register_post_type('bicycle', $args);
}

add_action('init', 'bpt_bicycle_post_type');