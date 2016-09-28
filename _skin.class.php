<?php
/**
 * This file implements a class derived of the generic Skin class in order to provide custom code for
 * the skin in this folder.
 *
 * This file is part of the b2evolution project - {@link http://b2evolution.net/}
 *
 * @package skins
 * @subpackage bootstrap_blog
 */
if( !defined('EVO_MAIN_INIT') ) die( 'Please, do not access this page directly.' );

/**
 * Specific code for this skin.
 *
 * ATTENTION: if you make a new skin you have to change the class name below accordingly
 */
class asevo_bootstrap_Skin extends Skin
{
	/**
	 * Skin version
	 * @var string
	 */
	var $version = '1.0.0';

	/**
	 * Do we want to use style.min.css instead of style.css ?
	 */
	var $use_min_css = 'check';  // true|false|'check' Set this to true for better optimization
	// Note: we leave this on "check" in the bootstrap_blog_skin so it's easier for beginners to just delete the .min.css file
	// But for best performance, you should set it to true.

	/**
	 * Get default name for the skin.
	 * Note: the admin can customize it.
	 */
	function get_default_name()
	{
		return 'Asevo Bootstrap Skin';
	}


	/**
	 * Get default type for the skin.
	 */
	function get_default_type()
	{
		return 'normal';
	}


	/**
	 * What evoSkins API does has this skin been designed with?
	 *
	 * This determines where we get the fallback templates from (skins_fallback_v*)
	 * (allows to use new markup in new b2evolution versions)
	 */
	function get_api_version()
	{
		return 6;
	}


	/**
	 * What CSS framework does has this skin been designed with?
	 *
	 * This may impact default markup returned by Skin::get_template() for example
	 */
	function get_css_framework()
	{
		return 'bootstrap';
	}
	
	
	function disabled_fields($param)
	{
		if( $this->get_setting( $param ) == 0 ) {
			echo '<style>#edit_plugin_11_set_titles_border_color:hover{cursor:default}</style>';
		}
	}


	/**
	 * Get definitions for editable params
	 *
	 * @see Plugin::GetDefaultSettings()
	 * @param local params like 'for_editing' => true
	 * @return array
	 */
	function get_param_definitions( $params )
	{
		$r = array_merge( array(
				'section_layout_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Layout Settings')
				),
					'layout' => array(
						'label' => T_('Layout'),
						'note' => T_('Select skin layout.'),
						'defaultvalue' => 'right_sidebar',
						'options' => array(
								'single_column'              => T_('Single Column Large'),
								'single_column_normal'       => T_('Single Column'),
								'single_column_narrow'       => T_('Single Column Narrow'),
								'single_column_extra_narrow' => T_('Single Column Extra Narrow'),
								'left_sidebar'               => T_('Left Sidebar'),
								'right_sidebar'              => T_('Right Sidebar'),
							),
						'type' => 'select',
					),
					'container_width' => array(
						'label' => T_('Container width'),
						'note' => T_('Select skin container width.'),
						'defaultvalue' => 'narrow_container',
						'options' => array(
								'narrow_container'     => T_('Narrow container'),
								'default_container'    => T_('Default container'),
								'wide_container'       => T_('Wide container'),
							),
						'type' => 'select',
					),
					'background_color' => array(
						'label' => T_('Background color'),
						'note' => T_('Set the skin background color.') . T_('Default value is') . ': <code>#ffffff</code>.',
						'defaultvalue' => '#ffffff',
						'type' => 'color',
					),
					'content_color' => array(
						'label' => T_('Content color'),
						'note' => T_('Set the content color.') . T_('Default value is') . ': <code>#333333</code>.',
						'defaultvalue' => '#333333',
						'type' => 'color',
					),
					'max_image_height' => array(
						'label' => T_('Max image height'),
						'note' => 'px. ' . T_('Set maximum height for post images.'),
						'defaultvalue' => '',
						'type' => 'integer',
						'allow_empty' => true,
					),
				'section_layout_end' => array(
					'layout' => 'end_fieldset',
				),
				
				
				'section_menu_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Layout Settings')
				),
					'menu_bg_color' => array(
						'label' => T_('Menu background color'),
						'note' => T_('Set the background color of the menu section.') . T_('Default value is') . ': <code>#3E4651</code>.',
						'defaultvalue' => '#3E4651',
						'type' => 'color',
					),
					'menu_link_color' => array(
						'label' => T_('Menu links color'),
						'note' => T_('Set the color of the menu links.') . T_('Default value is') . ': <code>#cccccc</code>.',
						'defaultvalue' => '#cccccc',
						'type' => 'color',
					),
					'active_link_bg_color' => array(
						'label' => T_('Active link background color'),
						'note' => T_('Set the background color of the active menu link.') . T_('Default value is') . ': <code>#e7e7e7</code>.',
						'defaultvalue' => '#e7e7e7',
						'type' => 'color',
					),
					'active_link_color' => array(
						'label' => T_('Active link color'),
						'note' => T_('Set the color of the active menu link.') . T_('Default value is') . ': <code>#3E4651</code>.',
						'defaultvalue' => '#3E4651',
						'type' => 'color',
					),
				'section_menu_end' => array(
					'layout' => 'end_fieldset',
				),
				
				
				'section_title_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Layout Settings')
				),
					'title_links_color' => array(
						'label' => T_('Titles color'),
						'note' => T_('Set color for post titles.') . T_('Default value is') . ': <code>#e63e41</code>.',
						'defaultvalue' => '#e63e41',
						'type' => 'color',
					),
					'title_links_color_h' => array(
						'label' => T_('Titles hover color'),
						'note' => T_('Set color for hovering post titles.') . T_('Default value is') . ': <code>#878B91</code>.',
						'defaultvalue' => '#878B91',
						'type' => 'color',
					),
					'titles_bold' => array(
						'label' => T_('Titles format'),
						'note' => T_('Bold'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'titles_italic' => array(
						'label' => '',
						'note' => T_('Italic'),
						'defaultvalue' => 0,
						'type' => 'checkbox',
					),
					'titles_uppercase' => array(
						'label' => T_(''),
						'note' => T_('Uppercase'),
						'defaultvalue' => 0,
						'type' => 'checkbox',
					),
					'titles_border' => array(
						'label' => '',
						'note' => T_('Bottom border'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'titles_border_color' => array(
						'label' => T_('Titles border color'),
						'note' => T_('Set color for the border below titles.') . T_('Default value is') . ': <code>#3e4651</code>.',
						'defaultvalue' => '#3e4651',
						'type' => 'color',
					),
				'section_title_end' => array(
					'layout' => 'end_fieldset',
				),
				

				'section_colorbox_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Colorbox Image Zoom')
				),
					'colorbox' => array(
						'label' => T_('Colorbox Image Zoom'),
						'note' => T_('Check to enable javascript zooming on images (using the colorbox script)'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_post' => array(
						'label' => T_('Voting on Post Images'),
						'note' => T_('Check this to enable AJAX voting buttons in the colorbox zoom view'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_post_numbers' => array(
						'label' => T_('Display Votes'),
						'note' => T_('Check to display number of likes and dislikes'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_comment' => array(
						'label' => T_('Voting on Comment Images'),
						'note' => T_('Check this to enable AJAX voting buttons in the colorbox zoom view'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_comment_numbers' => array(
						'label' => T_('Display Votes'),
						'note' => T_('Check to display number of likes and dislikes'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_user' => array(
						'label' => T_('Voting on User Images'),
						'note' => T_('Check this to enable AJAX voting buttons in the colorbox zoom view'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
					'colorbox_vote_user_numbers' => array(
						'label' => T_('Display Votes'),
						'note' => T_('Check to display number of likes and dislikes'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
				'section_colorbox_end' => array(
					'layout' => 'end_fieldset',
				),


				'section_username_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Username options')
				),
					'gender_colored' => array(
						'label' => T_('Display gender'),
						'note' => T_('Use colored usernames to differentiate men & women.'),
						'defaultvalue' => 0,
						'type' => 'checkbox',
					),
					'bubbletip' => array(
						'label' => T_('Username bubble tips'),
						'note' => T_('Check to enable bubble tips on usernames'),
						'defaultvalue' => 0,
						'type' => 'checkbox',
					),
					'autocomplete_usernames' => array(
						'label' => T_('Autocomplete usernames'),
						'note' => T_('Check to enable auto-completion of usernames entered after a "@" sign in the comment forms'),
						'defaultvalue' => 1,
						'type' => 'checkbox',
					),
				'section_username_end' => array(
					'layout' => 'end_fieldset',
				),


				'section_access_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('When access is denied or requires login...')
				),
					'access_login_containers' => array(
						'label' => T_('Display on login screen'),
						'note' => '',
						'type' => 'checklist',
						'options' => array(
							array( 'header',   sprintf( T_('"%s" container'), NT_('Header') ),    1 ),
							array( 'page_top', sprintf( T_('"%s" container'), NT_('Page Top') ),  1 ),
							array( 'menu',     sprintf( T_('"%s" container'), NT_('Menu') ),      0 ),
							array( 'sidebar',  sprintf( T_('"%s" container'), NT_('Sidebar') ),   0 ),
							array( 'sidebar2', sprintf( T_('"%s" container'), NT_('Sidebar 2') ), 0 ),
							array( 'footer',   sprintf( T_('"%s" container'), NT_('Footer') ),    1 ) ),
						),
				'section_access_end' => array(
					'layout' => 'end_fieldset',
				),

			), parent::get_param_definitions( $params ) );

		return $r;
	}


	/**
	 * Get ready for displaying the skin.
	 *
	 * This may register some CSS or JS...
	 */
	function display_init()
	{
		global $Messages, $debug;

		// Request some common features that the parent function (Skin::display_init()) knows how to provide:
		parent::display_init( array(
				'jquery',                  // Load jQuery
				'font_awesome',            // Load Font Awesome (and use its icons as a priority over the Bootstrap glyphicons)
				'bootstrap',               // Load Bootstrap (without 'bootstrap_theme_css')
				'bootstrap_evo_css',       // Load the b2evo_base styles for Bootstrap (instead of the old b2evo_base styles)
				'bootstrap_messages',      // Initialize $Messages Class to use Bootstrap styles
				'style_css',               // Load the style.css file of the current skin
				'colorbox',                // Load Colorbox (a lightweight Lightbox alternative + customizations for b2evo)
				'bootstrap_init_tooltips', // Inline JS to init Bootstrap tooltips (E.g. on comment form for allowed file extensions)
				'disp_auto',               // Automatically include additional CSS and/or JS required by certain disps (replace with 'disp_off' to disable this)
			) );

		// Skin specific initializations:

		// Limit images by max height:
		$max_image_height = intval( $this->get_setting( 'max_image_height' ) );
		if( $max_image_height > 0 )
		{
			add_css_headline( '.evo_image_block img { max-height: '.$max_image_height.'px; width: auto; }' );
		}

		// Add custom CSS:
		$custom_css = '';


		/**
		 * General customization
		 */
		if( $color = $this->get_setting( 'background_color' ) )
		{
			$custom_css .= "#skin_wrapper { background-color: $color }";
		}
		if( $color = $this->get_setting( 'content_color' ) )
		{
			$custom_css .= "#skin_wrapper { color: $color }";
		}


		/**
		 * Menu customization
		 */
		if( $color = $this->get_setting( 'menu_bg_color' ) )
		{
			$custom_css .= ".navbar.navbar-default { background-color: $color }";
		}
		if( $color = $this->get_setting( 'menu_link_color' ) )
		{
			$custom_css .= ".navbar.navbar-default .navbar-nav li a { color: $color }";
		}
		if( $color = $this->get_setting( 'active_link_bg_color' ) )
		{
			$custom_css .= ".navbar.navbar-default .navbar-nav .active a { background-color: $color }";
		}
		if( $color = $this->get_setting( 'active_link_color' ) )
		{
			$custom_css .= ".navbar.navbar-default .navbar-nav .active a { color: $color }";
		}

		
		/**
		 * Titles customization
		 */
		 if( $color = $this->get_setting( 'title_links_color' ) )
		 {
			 $custom_css .= ".evo_post_title a { color: $color }";
		 }
		 if( $color = $this->get_setting( 'title_links_color_h' ) )
		 {
			 $custom_css .= ".evo_post_title a:hover { color: $color }";
		 }
		

		if( ! empty( $custom_css ) )
		{ // Function for custom_css:
		$custom_css = '<style type="text/css">
<!--
'.$custom_css.'
-->
		</style>';
		add_headline( $custom_css );
		}
	}


	/**
	 * Check if we can display a widget container
	 *
	 * @param string Widget container key: 'header', 'page_top', 'menu', 'sidebar', 'sidebar2', 'footer'
	 * @return boolean TRUE to display
	 */
	function is_visible_container( $container_key )
	{
		global $Blog;

		if( $Blog->has_access() )
		{	// If current user has an access to this collection then don't restrict containers:
			return true;
		}

		// Get what containers are available for this skin when access is denied or requires login:
		$access = $this->get_setting( 'access_login_containers' );

		return ( ! empty( $access ) && ! empty( $access[ $container_key ] ) );
	}


	/**
	 * Check if we can display a sidebar for the current layout
	 *
	 * @param boolean TRUE to check if at least one sidebar container is visible
	 * @return boolean TRUE to display a sidebar
	 */
	function is_visible_sidebar( $check_containers = false )
	{
		$layout = $this->get_setting( 'layout' );

		if( $layout != 'left_sidebar' && $layout != 'right_sidebar' )
		{ // Sidebar is not displayed for selected skin layout
			return false;
		}

		if( $check_containers )
		{ // Check if at least one sidebar container is visible
			return ( $this->is_visible_container( 'sidebar' ) ||  $this->is_visible_container( 'sidebar2' ) );
		}
		else
		{ // We should not check the visibility of the sidebar containers for this case
			return true;
		}
	}


	/**
	 * Get value for attbiute "class" of column block
	 * depending on skin setting "Layout"
	 *
	 * @return string
	 */
	function get_column_class()
	{
		switch( $this->get_setting( 'layout' ) )
		{
			case 'single_column':
				// Single Column Large
				return 'col-md-12';

			case 'single_column_normal':
				// Single Column
				return 'col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1';

			case 'single_column_narrow':
				// Single Column Narrow
				return 'col-xs-12 col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2';

			case 'single_column_extra_narrow':
				// Single Column Extra Narrow
				return 'col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3';

			case 'left_sidebar':
				// Left Sidebar
				return 'col-md-9 pull-right';

			case 'right_sidebar':
				// Right Sidebar
			default:
				return 'col-md-9';
		}
	}
}

?>