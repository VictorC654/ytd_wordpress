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
        $queryArgs = array(
            'post_type' => 'poem',
            'post_status' => 'publish',
            'posts_per_page' => 1,
        );
        $query = new WP_Query($queryArgs);
        wp_reset_postdata();
        if($query->have_posts()) {

            $query->the_post();

            get_post();

            $this->poem = nl2br(get_the_content());
        }
    }

    /**
     * Separating the poem lines, then displaying them
     */
    public function generate_random_poem_line()
    {
        $this->fetch_poem();
        if(!empty($this->poem))
        {
            $poemLines = explode("\n", $this->poem);
            return $poemLines[wp_rand(0, count($poemLines) - 1)];
        }
        else
        {
            echo "";
        }
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