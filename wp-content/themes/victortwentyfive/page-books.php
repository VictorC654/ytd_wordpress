<?php

/*
Template Name: Books template
*/
if (function_exists('acf_form')) {
    acf_form_head();
}
get_header();
?>

<main id="primary" class="tc-main">
    <div class="ct-signature">
        CUSTOM TEMPLATE that displays 5 posts
    </div>
    <div>
        <?php
        $query = new WP_Query(array('post_type' => 'book', 'posts_per_page' => '5'));
        if($query->have_posts()):
            while($query->have_posts()): $query->the_post();
                ?>
                <article class="tc-article">
                    <a href="<?php the_permalink(); ?>">
                        <?php echo get_field('book_title') ?>
                    </a>
                    <br>
                    by <?php echo get_field('book_author'); ?>
                </article>
            <?php
            endwhile;
            wp_reset_postdata();
        else :
            ?>
            <h1> No posts found </h1>
        <?php endif; ?>
    </div>
</main><!-- #main -->

<?php
function save_book() {
    $book_post = array('post_title' => 'Example Book', 'post_type' => 'book', 'post_status' => 'publish');
    $book_id = wp_insert_post($book_post);

    if($book_id)
    {
        update_field('book_title', 'Example Title', $book_id);
        update_field('book_author', 'Example Author', $book_id);
        update_field('book_genre', 'Example Genre', $book_id);
        update_field('book_publication_date', get_the_date(), $book_id);
        update_field('book_price', 19.22, $book_id);
        update_field('book_rating', 4.5, $book_id);
    }
}

wp_register_script('custom-script', get_template_directory_uri() . '/js/custom-script.js', array(), '1.0.0', true);
wp_enqueue_script('custom-script');

get_sidebar();
get_footer();

