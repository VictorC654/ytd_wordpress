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
    public $poem;

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
     * fetching one poem from the database
     */
    public function fetch_poem()
    {
        $poems = get_option('chp_poems');
        if ($poems)
        {
            $this->poem = $poems[0];
        }
    }

    /**
     * Separating the poem lines, then displaying them
     */
    public function generate_random_poem_line()
    {
        $this->fetch_poem();
        $output = "";
        if(!empty($this->poem))
        {
            $poemLines = explode("\n", $this->poem);
            $output = $poemLines[wp_rand(0, count($poemLines) - 1)];
        }

        return $output;
    }
}

/**
 * Setting up the plugin
 */
$chp = new CHP();
$chp->initialize();

function display_random_line() {
    global $chp;
    return $chp->generate_random_poem_line();
}