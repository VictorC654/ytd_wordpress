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
    <div class="tc-add-book">
        <h1>
            Add a new book
        </h1>
        <?php acf_form(array(
            'post_id' => 'new_post',
            'new_post' => array('post_type' => 'book', 'post_status' => 'publish'),
            'post_title' => true,
            'submit_value'  => 'Add book',
        )) ?>
    </div>
</main><!-- #main -->

<?php
get_sidebar();
get_footer();

