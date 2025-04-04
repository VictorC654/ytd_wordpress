<?php
/*
Template Name: Custom Template
*/
get_header();
?>

    <main id="primary" class="tc-main">
        <div class="ct-signature">
            CUSTOM TEMPLATE that displays 5 posts
        </div>
        <div>
            <?php
            $query = new WP_Query(array('posts_per_page' => '5'));
            if($query->have_posts()):
                while($query->have_posts()): $query->the_post();
                    ?>
                    <article class="tc-article">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php the_content(); ?>
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
get_sidebar();
get_footer();
