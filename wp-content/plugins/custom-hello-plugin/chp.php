<?php
/*
Plugin Name: Custom Hello Plugin
Description: A custom plugin.
Author: Victor
Version: 1.0
*/

// for security, no direct access to plugin
if (!defined('ABSPATH')) {
    exit;
}

class CHP
{
    public $poem = "No one can tell me,\nNobody knows,\nWhere the wind comes from,\nWhere the wind goes.";

    /**
     * Hooking up to wp
     */
    public function initialize()
    {
        add_action('wp_head', array($this, 'display_random_poem_line'));
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
    public function display_random_poem_line()
    {
        $poemLines = explode("\n", $this->poem);

        echo "<p class='custom-header-message'>" . $poemLines[wp_rand(0, count($poemLines) - 1)] . "</p>";
    }
}

/**
 * Setting up the plugin
 */
$chp = new CHP();
$chp->initialize();
