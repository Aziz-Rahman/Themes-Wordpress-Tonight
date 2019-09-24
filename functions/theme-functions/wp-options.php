<?php
// ReduxFramework Sample Config File
// For full documentation, please visit: https://docs.reduxframework.com
if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections() {
            // General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Setting', 'tonight'),
                'fields' => array(
                     array(
                        'id'                => 'logo_type',
                        'type'              => 'button_set',
                        'title'             => __('Logo Type', 'tonight'), 
                        'desc'              => sprintf(__('Use site <a href="%s" target="_blank">title & desription</a>, image logo or use your profile.', 'tonight'), admin_url('/options-general.php') ),
                        'options'           => array('1' => __('Site Title', 'tonight'), '2' => __('Image Logo', 'tonight'), '3' => __('Your Avatar', 'tonight')),
                        'default'           => '3'
                    ),

                    array(
                        'id'                => 'logo_image',
                        'type'              => 'media', 
                        'url'               => true,
                        'required'          => array('logo_type', 'equals', '2'),
                        'title'             => __('Image Logo', 'tonight'),
                        'output'            => 'true',
                        'desc'              => __('Upload your logo or type the URL on the text box.', 'tonight'),
                        'default'           => array('url' => get_stylesheet_directory_uri() .'/images/logo.jpg'),
                    ),

                    array(
                        'id'                => 'your_avatar',
                        'type'              => 'media', 
                        'url'               => true,
                        'required'          => array('logo_type', 'equals', '3'),
                        'title'             => __('Your Avatar', 'tonight'),
                        'output'            => 'true',
                        'desc'              => __('Upload your profile.', 'tonight'),
                        'default'           => array('url' => get_stylesheet_directory_uri() .'/images/avatar.jpg'),
                    ),

                    array(
                        'id'                => 'author_name',
                        'type'              => 'text',
                        'required'          => array('logo_type', 'equals', '3'),
                        'title'             => __('Author Name', 'tonight'),
                        'output'            => 'true',
                        'desc'              => __('Create your name.', 'tonight'),
                        'default'           => __('Create Your Name', 'tonight')
                    ),

                    array(
                        'id'                    => 'author_description',
                        'type'                  => 'textarea',
                        'required'              => array('logo_type', 'equals', '3'),
                        'title'                 => __('Author Short Description', 'tonight'),
                        'default'               => __('Write a short description about your self and what you do. That way your blog readers could get to know you better.', 'tonight')
                    ),

                    array(
                        'id'                =>'favicon',
                        'type'              => 'media', 
                        'title'             => __('Favicon', 'tonight'),
                        'output'            => 'true',
                        'mode'              => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'              => __('Upload your favicon.', 'tonight'),
                        'default'           => array('url' => get_stylesheet_directory_uri().'/images/favicon.png'),
                    ),

                    array(
                        'id'                => '404_image',
                        'type'              => 'media',
                        'title'             => __('404 page image', 'note'),
                        'desc'              => __('Preferred image size is 600x400 pixel.', 'tonight'),
                        'default'           => array(
                                                     'url' => get_stylesheet_directory_uri().'/images/404.jpg'),
                    ),

                    array(
                        'id'                   		=> 'post_excerpt_length',
                        'type'                 		=> 'slider',
                        'title'                		=> __('Post Excerpt Length', 'tonight'),
                        'default'              		=> 45,
                        'min'                  	    => 20,
                        'step'                 		=> 1,
                        'max'                   	=> 65,
                        'display_value'        		=> 'text'
                    ),

                    array(
                        'id'                        => 'share_buttons',
                        'type'                      => 'switch',
                        'title'                     => __('Display Share Buttons', 'tonight'),
                        'desc'                      => __('Display share buttons in posts detail.', 'tonight'),
                        'default'                   => 1,
                    ),

                    array(
                        'id'                        => 'display_comments',
                        'type'                      => 'switch',
                        'title'                     => __('Display Comments', 'tonight'),
                        'desc'                      => __('Display comments in post detail.', 'tonight'),
                        'default'                   => 1,
                    ),
                )
            );


             // Typography Settings
            $this->sections[] = array(
                'icon'    => 'el-icon-text-width',
                'title'   => __('Typography', 'tonight'),
                'fields'  => array(
                    array(
                        'id'                => 'body_text_wp',
                        'type'              => 'typography',
                        'title'             => __('Text Body', 'tonight'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('body#top'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '15px',
                            'font-weight'       => '400',
                            'line-height'       => '24px',
                            'color'             => '#8F9AAB',
                        )
                    ),

                    array(
                        'id'                => 'site_title_font_tonight',
                        'type'              => 'typography',
                        'title'             => __('Site Title', 'tonight'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('#banner .inner .site-title'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '28px',
                            'font-weight'       => '800',
                            'color'             => '#fff',
                        )
                    ),

                    array(
                        'id'                => 'site_desc_font_wp',
                        'type'              => 'typography',
                        'title'             => __('Site Description', 'tonight'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'text-align'        => false,
                        'line-height'       => true,
                        'output'            => array('#banner .inner .description'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '13px',
                            'font-weight'       => '400',
                            'line-height'       => '25px',
                            'color'             => '#8F9AAB',
                        )
                    ),

                    array(
                        'id'                => 'post_title',
                        'type'              => 'typography',
                        'title'             => __('Post Title', 'tonight'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('article.hentry .head-article h2.post-title'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '22px',
                            'line-height'       => '33px',
                            'font-weight'       => '800',
                            'color'             => '#BABFC5',
                        )
                    ),

                    array(
                        'id'                => 'single_post_title',
                        'type'              => 'typography',
                        'title'             => __('Post Title on Single Post', 'tonight'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('article.hentry .head-article h1.post-title'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '22px',
                            'line-height'       => '33px',
                            'font-weight'       => '800',
                            'color'             => '#505050',
                        )
                    ),

                    array(
                        'id'                => 'tonight-commments-list',
                        'type'              => 'typography',
                        'title'             => __('Comment List', 'tonight'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'text-align'        => false,
                        'output'            => array('.article-widget .comments-widget .main-comment .detail'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '15px',
                            'font-weight'       => '400',
                            'line-height'       => '24px',
                            'color'             => '#8F9AAB',
                            )
                        ),
                    ),
                );

              
            // Color Settings
            $this->sections[] = array(
                'icon'    => 'el-icon-brush',
                'title'   => __('Colors', 'tonight'),
                'fields'  => array(
                    array(
                        'id'                        => 'info_link_color',
                        'type'                      => 'info',
                        'icon'                      => 'el-icon-info-sign',
                        'title'                     => __('Link Color', 'tonight'),
                        'desc'                      => __('Link color settings.', 'tonight'),
                    ),

                    array(
                        'id'                    => 'main_link_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Main Link Color', 'tonight'),
                        'active'                => false,
                        'output'                => array('body a'),
                        'default'               => array(
                                                    'regular'  => '#9E9010',
                                                    'hover'    => '#BFAE13',
                        )
                    ),

                    array(
                        'id'                    => 'site_title_link',
                        'type'                  => 'link_color',
                        'title'                 => __('Site Title Link Color', 'tonight'),
                        'active'                => false,
                        'output'                => array('#header h1 a, #banner .inner .site-title a'),
                        'default'               => array(
                                                    'regular'  => '#fff',
                                                    'hover'    => '#F1F2FE',
                        )
                    ),

                    array(
                        'id'                    => 'post_title_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Post Title Link color ', 'tonight'),
                        'active'                => false,
                        'output'                => array('article.hentry .head-article h2.post-title a'),
                        'default'               => array(
                                                'regular'  => '#BABFC5',
                                                'hover'    => '#fff',
                        )
                    ),

                    array(
                        'id'                    => 'meta_post_wp',
                        'type'                  => 'link_color',
                        'title'                 => __('Post Meta Link Color', 'tonight'),
                        'active'                => false,
                        'output'                => array('article.hentry .entry-meta span a'),
                        'default'               => array(
                                                'regular'  => '#9E9010',
                                                'hover'    => '#BFAE13',
                        )
                    ),

                    array(
                        'id'                    => 'widgets_area',
                        'type'                  => 'link_color',
                        'title'                 => __('Widgets Link Color', 'tonight'),
                        'active'                => false,
                        'output'                => array('.my-widgets-area a'),
                        'default'               => array(
                                                'regular'  => '#3F646B',
                                                'hover'    => '#D21212',
                        )
                    ),
                ),
            );

            // Social Networks
            $this->sections[] = array(
                'icon' => 'el-icon-user',
                'title' => __('Social Networks', 'tonight'),
                'fields' => array(
                    array(
                        'id'                          => 'url_facebook',
                        'type'                        => 'text', 
                        'title'                       => __('Facebook Profile', 'tonight'),
                        'desc'                        => __('Your facebook profile page.', 'tonight'),
                        'placeholder'                 => 'http://facebook.com',
                        'default'                     => 'http://facebook.com'
                    ),

                    array(
                        'id'                          => 'url_twitter',
                        'type'                        => 'text', 
                        'title'                       => __('Twitter Profile', 'tonight'),
                        'desc'                        => __('Your twitter profile page.', 'tonight'),
                        'placeholder'                 => 'http://twitter.com',
                        'default'                     => 'http://twitter.com'
                    ),

                    array(
                        'id'                          => 'url_gplus',
                        'type'                        => 'text', 
                        'title'                       => __('Google+ Profile', 'tonight'),
                        'desc'                        => __('Your google+ profile page.', 'tonight'),
                        'placeholder'                 => 'http://plus.google.com',
                        'default'                     => 'http://plus.google.com'
                    ),

                    array(
                        'id'                          => 'url_youtube',
                        'type'                        => 'text', 
                        'title'                       => __('YouTube Profile', 'tonight'),
                        'desc'                        => __('Your YouTube video page.', 'tonight'),
                        'placeholder'                 => 'http://youtube.com',
                        'default'                     => 'http://youtube.com'
                    ),

                    array(
                        'id'                          => 'url_instagram',
                        'type'                        => 'text', 
                        'title'                       => __('Instagram Profile', 'tonight'),
                        'desc'                        => __('Your instagram page.', 'tonight'),
                        'placeholder'                 => 'http://instagram.com',
                        'default'                     => 'http://instagram.com'
                    ),

                    array(
                        'id'                          => 'url_linkedin',
                        'type'                        => 'text', 
                        'title'                       => __('Linkedin Profile', 'tonight'),
                        'desc'                        => __('Your linkedin page.', 'tonight'),
                        'placeholder'                 => 'http://linkedin.com',
                        'default'                     => 'http://linkedin.com'
                    ),

                    array(
                        'id'                          => 'url_pinterest',
                        'type'                        => 'text', 
                        'title'                       => __('Pinterest Profile', 'tonight'),
                        'desc'                        => __('Your pinterest page.', 'tonight'),
                        'placeholder'                 => 'http://pinterest.com',
                        'default'                     => 'http://pinterest.com'
                    ),
                )
            );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'tonight'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'tonight')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'tonight'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'tonight')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'tonight');
        }

        //  All the possible arguments for Redux.
        //  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'             => 'tonight_option',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'         => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'      => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'            => 'submenu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'       => true,
                // Show the sections below the admin menu item or not
                'menu_title'           => __( 'My Options', 'tonight' ),
                'page_title'           => __( 'My Options', 'tonight' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'       => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography'     => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'            => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon'     => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable'      => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'             => false,
                // Show the time the page took to load, etc
                'update_notice'        => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer'           => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'        => 61,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'          => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'     => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'            => get_template_directory_uri() .'/images/theme-options.png',
                // Specify a custom URL to an icon
                'last_tab'             => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'            => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'            => 'tonightpanel',
                // Page slug used to denote the panel
                'save_defaults'        => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'         => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'         => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export'   => false,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'       => 60 * MINUTE_IN_SECONDS,
                'output'               => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'           => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'             => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'          => false,
                // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                    'hide'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'click mouseleave',
                        ),
                    ),
                )
            );

            // Panel Intro text -> before the form
            $this->args['intro_text'] = __('<p>If you like this theme, please consider giving it a 5 star rating on ThemeForest. <a href="http://themeforest.net/downloads" target="_blank">Rate now</a>.</p>', 'tonight');

            // Add content after the form.
            // $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'tonight');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}