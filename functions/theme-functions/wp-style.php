<?php
if ( ! function_exists( 'my_enqueue_scripts' ) ) {
	function my_enqueue_scripts() {
		global $pagenow, $tonight_option;
		// Only load these scripts on frontend
		if( !is_admin() && $pagenow != 'wp-login.php' ) {

			wp_enqueue_script( 'jquery' );

			if ( is_singular( 'post' ) ) {
				wp_enqueue_script( 'comment-reply' );
			}

			// Load all Javascript files
			wp_enqueue_script( 'justifiedGallery', get_template_directory_uri() .'/js/jquery.justifiedGallery.min.js', '', '3.5.1', true );
			wp_enqueue_script( 'scrollex', get_template_directory_uri() .'/js/jquery.scrollex.min.js', '', null, true );
			wp_enqueue_script( 'scrolly', get_template_directory_uri() .'/js/jquery.scrolly.min.js', '', null, true );
			wp_enqueue_script( 'skel', get_template_directory_uri() .'/js/skel.min.js', '', null, true );
			wp_enqueue_script( 'init', get_template_directory_uri() .'/js/init.js', '', null, true );

			// Load all CSS files
			wp_enqueue_style( 'reset', get_stylesheet_directory_uri() .'/css/font-awesome.min.css', array(), false, 'all' );
			wp_enqueue_style( 'justifiedGallery', get_template_directory_uri() .'/css/justifiedGallery.min.css', array(), false, 'all' );
			wp_enqueue_style( 'style', get_stylesheet_directory_uri() .'/style.css', array(), false, 'all' );	

		}
	}
}
add_action( 'wp_print_styles', 'my_enqueue_scripts' );
?>