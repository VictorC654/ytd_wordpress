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
                    'default' => 1,
                ],
            ]
        ]
    );

    /**
     * Route for posting a book
     */
    register_rest_route(
        'cra/v1',
        '/books',
        [
            'methods' => 'POST',
            'callback' => 'cra_create_book',
            'permission_callback' => fn() => is_user_logged_in(),
        ]
    );
}

function cra_get_books(WP_REST_Request $request): WP_REST_Response
{
    return new WP_REST_Response(get_books());
}

function cra_create_book(WP_REST_Request $request): WP_REST_Response
{
    /**
     * Array of fields and their sanitization functions
     */
    $fields = [
        'post_title' => 'sanitize_text_field',
        'book_title' => 'sanitize_text_field',
        'book_author' => 'sanitize_text_field',
        'book_genre' => 'sanitize_text_field',
        'book_publication_date' => 'sanitize_text_field',
        'book_price' => 'floatval',
        'book_rating' => 'intval',
    ];

    /**
     * Storing the sanitized values in an array
     */
    $book_data = [];
    foreach ($fields as $field => $sanitize_function) {
        $book_data[$field] = $sanitize_function($request[$field] ?? '');
    }

    /**
     * Validation of book data
     */
    if (empty($book_data['book_title']) || empty($book_data['book_author']) || empty($book_data['book_genre']) || $book_data['book_rating'] < 1 || $book_data['book_rating'] > 5)
    {
        return new WP_REST_Response(['message' => 'Invalid input'], 400);
    }

    /**
     * Inserting the book post into the database and retrieving the post ID
     */
    $book_post = [
        'post_title' => $request['post_title'],
        'post_type' => 'book',
        'post_status' => 'publish'
    ];
    $book_id = wp_insert_post($book_post);

    /**
     * Checking if the book object was inserted correctly
     */
    if (!$book_id) {
        return new WP_REST_Response(['message' => 'Failed to create post.'], 500);
    }

    /**
     * If validation was successfull, save the custom fields
     */
    foreach ($book_data as $field => $value) {
        update_field($field, $value, $book_id);
    }

    return new WP_REST_Response(['message' => 'Book created succesfully.'], 200);
}
