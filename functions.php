<?php
/**
 * Loads the theme functions
 * 
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */

$themename = 'Tonight';
$version = wp_get_theme()->Version;

// Include theme functions
require_once( get_template_directory() . '/functions/theme-functions/wp-widgets.php' ); // Load widgets
require_once( get_template_directory() . '/functions/theme-functions/wp-style.php' ); // Load function style
require_once( get_template_directory() . '/functions/theme-functions/wp-support.php' ); // Load function support
require_once( get_template_directory() . '/functions/theme-functions/wp-functions.php' ); // Load function support
require_once( get_template_directory() . '/functions/class-tgm-plugin-activation.php' ); // Load TGM-Plugin-Activation


/**
 * After setup theme
 *
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
function my_theme_init() {
	add_action( 'widgets_init', 'my_footer_widgets' );
}
add_action( 'after_setup_theme', 'my_theme_init' );


/**
 * Loads the Options Panel
 * 
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/functions/redux/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/functions/redux/framework.php' );
}
if ( !isset( $tonight_option ) && file_exists( dirname( __FILE__ ) . '/functions/theme-functions/wp-options.php' ) ) {
	require_once( dirname( __FILE__ ) . '/functions/theme-functions/wp-options.php' );
}


/**
 * Required & recommended plugins
 * *
 * @package WordPress
 * @package WordPress
 * @subpackage Tonight
 * @since Tonight 1.0.0
 */
function blog_aink_required_plugins() {
	$plugins = array(
		array(
			'name'			=> 'Advanced Custom Fields',
			'slug'			=> 'advanced-custom-fields',
			'required'		=> true,
		),
	);

	$string = array(
		'page_title' => __( 'Install Required Plugins', 'tonight' ),
		'menu_title' => __( 'Install Plugins', 'tonight' ),
		'installing' => __( 'Installing Plugin: %s', 'tonight' ),
		'oops' => __( 'Something went wrong with the plugin API.', 'tonight' ),
		'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
		'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
		'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
		'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
		'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
		'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
		'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
		'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
		'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
		'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
		'return' => __( 'Return to Required Plugins Installer', 'tonight' ),
		'plugin_activated' => __( 'Plugin activated successfully.', 'tonight' ),
		'complete' => __( 'All plugins installed and activated successfully. %s', 'tonight' ),
		'nag_type' => 'updated'
	);

	$theme_text_domain = 'tonight';

	$config = array(
		'domain' 			=> 'tonight',
		'default_path' 		=> '',
		'parent_menu_slug' 	=> 'themes.php',
		'parent_url_slug' 	=> 'themes.php',
		'menu' 				=> 'install-plugins',
		'has_notices' 		=> true,
		'is_automatic' 		=> true,
		'message' 			=> '',
		'strings' 			=> $string
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'blog_aink_required_plugins' );