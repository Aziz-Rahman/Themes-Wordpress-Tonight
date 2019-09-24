<?php
/**
 * Function to register widget areas
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
if ( ! function_exists( 'my_footer_widgets' ) ) {
	function my_footer_widgets(){
		// Footer Widget
		if ( function_exists( 'register_sidebar') ) {
			register_sidebar( array(
				'name' 			=> __( 'Footer', 'tonight' ),
				'id' 			=> 'footer-widgets',
				'description' 	=> '',
				'class' 		=> '',
				'before_widget' => '<div id="widget-%1$s" class="widget %2$s"><div class="widget-wrapper">',
				'after_widget' 	=> '</div></div>',
				'before_title' 	=> '<h4 class="widget-title"><span>',
				'after_title' 	=> '</span></h4>',
			) );
		}
	}
}

// Load Custom Widgets
include_once( get_template_directory() . '/includes/widgets/widgets-popular-posts.php' );
?>