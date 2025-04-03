<?php
/*
Template Name: Ajax Template
*/

get_header();
?>

    <main id="primary" class="tc-main">
        <div class="ct-signature">
            CUSTOM TEMPLATE that displays 5 posts using AJAX
        </div>
        <div>
            <a id="ajax-button">
                Make AJAX request
            </a>
            <table id="bookTable" style="color:white; border-collapse: collapse; width: 100%;">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Price</th>
                    <th>Publication Date</th>
                    <th>Rating</th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </main><!-- #main -->

<?php

wp_register_script('custom-ajax-script', get_template_directory_uri() . '/js/custom-ajax.js', '1.0.0', true);
wp_localize_script('custom-ajax-script', 'ajax_obj', ['ajax_url' => admin_url('admin-ajax.php')]);
wp_enqueue_script('custom-ajax-script');

get_sidebar();
get_footer();

