<?php
/*
Template Name: Custom Template
*/
get_header();
?>

    <main id="primary" class="tc-main">
        <div class="ct-signature">
            CUSTOM TEMPLATE
        </div>
        <div>
        <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );

//                the_post_navigation(
//                    array(
//                        'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'victortwentyfive' ) . '</span> <span class="nav-title">%title</span>',
//                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'victortwentyfive' ) . '</span> <span class="nav-title">%title</span>',
//                    )
//                );
            endwhile; // End of the loop.
            ?>
        </div>
    </main><!-- #main -->

<?php
get_sidebar();
get_footer();
