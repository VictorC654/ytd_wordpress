<?php

/*
Template Name: Books template
*/
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
