<?php
/*
Plugin Name: Custom Rest API
Description: A custom plugin.
Author: Victor
Version: 1.0
*/

/**
 * Registering endpoints only when the rest api is initialized
 */
add_action( 'rest_api_init', 'cra_register_routes');

function cra_register_routes()
{

    /**
     * Route for getting 5 books by default
     */
    register_rest_route(
        'cra/v1',
        '/books',
        [
            'methods' => 'GET',
            'callback' => 'cra_get_books',
            'permission_callback' => '__return_true',
            'args' => [
                'limit' => [
                    'required' => false,
                    'validate_callback' => fn($param) => is_numeric($param),
                    'default' => 5,
                ],
            ]
        ]
    );

}

function cra_get_books(WP_REST_Request $request): WP_REST_Response
{
    $query = new WP_Query(
        array(
            'post_type' => 'book',
            'posts_per_page' => $request->get_param('limit')
        )
    );

    /**
     * Looping through the books and saving them in an array
     */
    if($query->have_posts()) {
        $books = [];

        while ($query->have_posts()) {
            $query->the_post();
            $books[] = get_fields(get_the_ID());
        }

        wp_reset_postdata();

        /**
         * Returning a REST response object
         */
        return new WP_REST_Response($books);
    }

    return new WP_REST_Response(['message' => 'Books not found'], 404);
}
