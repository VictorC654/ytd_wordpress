<?php
/**
 * The header for our theme
 *
 * This template displays the <head> section and the header up to <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package victortwentyfive
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'victortwentyfive' ); ?></a>

    <header id="masthead" class="site-header" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem;">
        <div class="site-branding">
            <?php
            the_custom_logo();
            if ( is_front_page() && is_home() ) :
                ?>
                <h1 class="site-title" style="margin: 0;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
            else :
                ?>
                <p class="site-title" style="margin: 0;"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php
            endif;
            $victortwentyfive_description = get_bloginfo( 'description', 'display' );
            if ( $victortwentyfive_description || is_customize_preview() ) :
                ?>
                <p class="site-description" style="margin: 0; color: #666;"><?php echo $victortwentyfive_description; ?></p>
            <?php endif; ?>
        </div>

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'victortwentyfive' ); ?></button>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'container'      => 'div',
                    'container_class' => 'menu-container',
                )
            );
            ?>
            <?php
            if (is_callable(['CHP', 'get_random_poem_line'])) {
                echo CHP::get_random_poem_line();
            }
            ?>
        </nav>
    </header>
</div>
