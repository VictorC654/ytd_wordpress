<?php
/*
Plugin Name: Custom Hello Plugin
Description: A custom plugin.
Author: Victor
Version: 1.0
*/

require_once plugin_dir_path(__FILE__) . 'includes/chp-functions.php';

// for security, no direct access to plugin
if (!defined('ABSPATH')) {
    exit;
}

class CHP
{
    /**
     * Hooking up to wp
     */
    public function initialize()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    }

    /**
     * Enqueing the styles
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('chp-style', plugin_dir_url(__FILE__) . 'assets/css/chp-style.css');
    }

    /**
     * Separating the poem lines, then displaying them
     */
    public static function get_random_poem_line()
    {
        $poem = get_option('chp_poem');
        $output = "";
        if(!empty($poem))
        {
            $poemLines = explode("\n", $poem);
            $output = $poemLines[wp_rand(0, count($poemLines) - 1)];
        }

        return $output;
    }
}