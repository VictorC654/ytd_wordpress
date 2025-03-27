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
    /**
     * Hooking up to wp
     */
    public function initialize()
    {
        add_action('wp_head', array($this, 'add_hello_message_to_header'));
        add_action('wp_head', array($this, 'enqueue_styles'));
    }

    /**
     * Enqueing the styles
     */
    public function enqueue_styles()
    {
        wp_enqueue_style('chp-style', plugin_dir_url(__FILE__) . 'assets/css/chp-style.css');
    }

    /**
     * Displaying the message
     */
    public function add_hello_message_to_header()
    {
        echo "<p class='custom-header-message'>Hello from the custom plugin.</p>";
    }
}

/**
 * Setting up the plugin
 */
$chp = new CHP();
$chp->initialize();
