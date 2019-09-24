<?php
/**
 * The template for displaying header part.
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */

 global $tonight_option; ?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo ( $tonight_option['favicon']['url'] ? esc_url( $tonight_option['favicon']['url'] ) : get_template_directory_uri().'/images/favicon.png' ); ?>" />

<?php wp_head(); ?>
</head>
<body id="top" <?php body_class( 'landing' ); ?>>

    <!-- START: Page Wrapper -->
    <div id="page-wrapper">

        <!-- START: Header -->
        <header id="header" class="alt">
            <h1><a href="<?php echo get_home_url(); ?>"><?php echo bloginfo( 'name' ); ?></a></h1>
            <!-- START: Navigation -->
            <?php
            // Display Main menu
            if ( has_nav_menu( 'main-menu' ) ) {
                echo '<nav id="nav" class="my-menu site-navigation">';
                echo '<a href="#" class="menuToggle"><span>'. __( 'Menu', 'tonight' ) .'</span></a>';
                echo '<div id="menu">';
                wp_nav_menu( array ( 'theme_location' => 'main-menu', 'container' => null, 'menu_class' => 'main-menu', 'depth' => 2 ) );
                echo '</div>';
                echo ' </nav>';
            }
            ?>
            <!-- END: Navigation -->
        </header>
        <!-- END: Header -->

        <!-- START: Banner -->
        <section id="banner">
            <div class="inner">

                <?php if ( $tonight_option['logo_type'] == '1' ) : ?>
                    <h2 class="site-title"><a href="<?php echo get_home_url(); ?>"><?php echo bloginfo( 'name' ); ?></a></h2>
                    <div class="description"><?php echo bloginfo( 'description' ); ?></div>
                <?php elseif ( $tonight_option['logo_type'] == '2' ) : ?>
                    <div class="image-logo-site">
                        <a href="<?php echo home_url('/'); ?>"><img src="<?php echo ( $tonight_option['logo_image'] ? esc_url( $tonight_option['logo_image']['url'] ) : get_template_directory_uri().'/images/logo.jpg' ); ?>" alt="<?php get_bloginfo('name'); ?>" /></a>
                    </div>
                    <div class="description"><?php echo bloginfo( 'description' ); ?></div>
                <?php else : ?>
                    <div class="image-logo-site">
                        <a href="<?php echo home_url('/'); ?>"><img src="<?php echo ( $tonight_option['your_avatar'] ? esc_url( $tonight_option['your_avatar']['url'] ) : get_template_directory_uri().'/images/logo.jpg' ); ?>" alt="<?php get_bloginfo('name'); ?>" /></a>
                    </div>
                    <div class="author-name"><?php echo wpautop( esc_attr( $tonight_option['author_name'] ) ); ?></div>
                    <div class="description"><?php echo wpautop( esc_attr( $tonight_option['author_description'] ) ); ?></div>
                <?php endif; ?>

            </div>
            <a href="#my-articles" class="more scrolly">My Blog</a>
        </section>
        <!-- END: Banner -->

        <!-- -->
        <section id="one" class="wrapper style1 special">
            <div class="inner">
                <header class="major">
                    <?php get_template_part( 'searchform' ); // Include search form ?>
                </header>
            </div>
        </section>

        <!-- START: Content article -->
        <section id="my-articles" class="wrapper alt style2">