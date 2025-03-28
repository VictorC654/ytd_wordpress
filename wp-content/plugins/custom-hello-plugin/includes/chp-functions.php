<?php

add_action( 'admin_menu', 'chp_create_admin_link' );

function chp_create_admin_link()
{
    add_menu_page(
        'Add a poem', // Title of the page
        'CHP', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'chp-add-poem-page', // The 'slug' - file to display when clicking the link
          'chp_display_add_poem_page'
    );
}

/**
 * including the absolute path to the file
 */
function chp_display_add_poem_page()
{
    if(file_exists(plugin_dir_path( __FILE__ ) . 'chp-add-poem-page.php'))
    {
        include plugin_dir_path( __FILE__ ) . 'chp-add-poem-page.php';
    }
}