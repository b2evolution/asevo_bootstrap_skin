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
	var $version = '6.0.1';

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
	 * Get supported collection kinds.
	 *
	 * This should be overloaded in skins.
	 *
	 * For each kind the answer could be:
	 * - 'yes' : this skin does support that collection kind (the result will be was is expected)
	 * - 'partial' : this skin is not a primary choice for this collection kind (but still produces an output that makes sense)
	 * - 'maybe' : this skin has not been tested with this collection kind
	 * - 'no' : this skin does not support that collection kind (the result would not be what is expected)
	 * There may be more possible answers in the future...
	 */
	public function get_supported_coll_kinds()
	{
		$supported_kinds = array(
				'main' => 'partial',
				'std' => 'yes',		// Blog
				'photo' => 'no',
				'forum' => 'no',
				'manual' => 'no',
				'group' => 'maybe',  // Tracker
				// Any kind that is not listed should be considered as "maybe" supported
			);

		return $supported_kinds;
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


	/**
	 * Get definitions for editable params
	 *
	 * @see Plugin::GetDefaultSettings()
	 * @param local params like 'for_editing' => true
	 * @return array
	 */
	function get_param_definitions( $params )
	{

		// Load to use function get_available_thumb_sizes()
		load_funcs( 'files/model/_image.funcs.php' );

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
						'note' => T_('Set the skin background color.') . ' ' . T_('Default value is') . ': <code>#ffffff</code>.',
						'defaultvalue' => '#ffffff',
						'type' => 'color',
					),
					'content_color' => array(
						'label' => T_('Content color'),
						'note' => T_('Set the content color.') . ' ' . T_('Default value is') . ': <code>#333333</code>.',
						'defaultvalue' => '#333333',
						'type' => 'color',
					),
					'post_info_color' => array(
						'label' => T_('Post info color'),
						'note' => T_('Set the post info color.') . ' ' . T_('Default value is') . ': <code>#777777</code>.',
						'defaultvalue' => '#777777',
						'type' => 'color',
					),
					'links_color' => array(
						'label' => T_('Content links color'),
						'note' => T_('Set the links color.') . ' ' . T_('Default value is') . ': <code>#3E4651</code>.',
						'defaultvalue' => '#3E4651',
						'type' => 'color',
					),
					'sidebar_links_color' => array(
						'label' => T_('Sidebar links color'),
						'note' => T_('Set the sidebar links color.') . ' ' . T_('Default value is') . ': <code>#888888</code>.',
						'defaultvalue' => '#888888',
						'type' => 'color',
					),
					'widget_titles_color' => array(
						'label' => T_('Widget titles color'),
						'note' => T_('Set the color of widget titles.') . ' ' . T_('Default value is') . ': <code>#e63e41</code>.',
						'defaultvalue' => '#e63e41',
						'type' => 'color',
					),
					'borders_color' => array(
						'label' => T_('Borders color'),
						'note' => T_('Set the borders color. Note: this color is also used for pager buttons color and meta comments button.') . ' ' . T_('Default value is') . ': <code>#eeeeee</code>.',
						'defaultvalue' => '#eeeeee',
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
					'label'  => T_('Menu Settings')
				),
					'menu_bg_color' => array(
						'label' => T_('Menu background color'),
						'note' => T_('Set the background color of the menu section.') . ' ' . T_('Default value is') . ': <code>#3E4651</code>.',
						'defaultvalue' => '#3E4651',
						'type' => 'color',
					),
					'menu_link_color' => array(
						'label' => T_('Menu links color'),
						'note' => T_('Set the color of the menu links.') . ' ' . T_('Default value is') . ': <code>#eeeeee</code>.',
						'defaultvalue' => '#eeeeee',
						'type' => 'color',
					),
					'active_link_bg_color' => array(
						'label' => T_('Active link background color'),
						'note' => T_('Set the background color of the active menu link.') . ' ' . T_('Default value is') . ': <code>#e7e7e7</code>.',
						'defaultvalue' => '#e7e7e7',
						'type' => 'color',
					),
					'active_link_color' => array(
						'label' => T_('Active link color'),
						'note' => T_('Set the color of the active menu link.') . ' ' . T_('Default value is') . ': <code>#3E4651</code>.',
						'defaultvalue' => '#3E4651',
						'type' => 'color',
					),
				'section_menu_end' => array(
					'layout' => 'end_fieldset',
				),


				'section_title_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Post Titles Settings')
				),
					'title_links_color' => array(
						'label' => T_('Titles color'),
						'note' => T_('Set color for post titles.') . ' ' . T_('Default value is') . ': <code>#e63e41</code>.',
						'defaultvalue' => '#e63e41',
						'type' => 'color',
					),
					'title_links_color_h' => array(
						'label' => T_('Titles hover color'),
						'note' => T_('Set color for hovering post titles.') . ' ' . T_('Default value is') . ': <code>#3E4651</code>.',
						'defaultvalue' => '#3E4651',
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
						'note' => T_('Set color for the border below titles.') . ' ' . T_('Default value is') . ': <code>#3e4651</code>.',
						'defaultvalue' => '#3e4651',
						'type' => 'color',
					),
				'section_title_end' => array(
					'layout' => 'end_fieldset',
				),


				'section_mediaidx_start' => array(
					'layout' => 'begin_fieldset',
					'label'  => T_('Colorbox Image Zoom')
				),
					'mediaidx_thumb_size' => array(
						'label'        => T_('Thumbnail Size for Media Index'),
						'note'         => T_('Select thumbnail size for images on Media index page') . ' (disp=mediaidx)',
						'defaultvalue' => 'crop-192x192',
						'options'      => get_available_thumb_sizes(),
						'type'         => 'select',
					),
				'section_mediaidx_end' => array(
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
			$custom_css .= "#skin_wrapper, .preview, .preview:hover, .SaveButton.btn-info, a.btn-primary { background-color: $color }\n";
			$custom_css .= "nav.site_pagination a:hover, .SaveButton.btn-primary, a.btn-primary:hover, input.btn-primary { color: $color }\n";
		}
		if( $color = $this->get_setting( 'content_color' ) )
		{
			$custom_css .= "#skin_wrapper, main .panel-default>.panel-heading, .panel-title>.small, .panel-title>.small>a, .panel-title>a, .panel-title>small, .panel-title>small>a { color: $color }\n";
		}
		if( $color = $this->get_setting( 'post_info_color' ) )
		{
			$custom_css .= ".post-info, .post-info a, .edit_post_button, .evo_comment_footer small { color: $color }\n";
		}
		if( $color = $this->get_setting( 'links_color' ) )
		{
			$custom_css .= "footer.row a, footer.row a:hover, .evo_container__footer a, .evo_container__page_top a, .evo_container__page_top a:hover, main a, main a:hover, .preview, .preview:hover, .evo_post_pagination a, .SaveButton.btn-info, a.btn-primary, .widget-heading .evo_comment_title a, .widget-heading .evo_comment_title a:hover, .pagination>li>a, .pagination>li>span, .pagination>li>a:hover, .pagination>li>span:hover { color: $color }\n";
			$custom_css .= "nav.site_pagination a:hover, .search_submit, .search_submit:hover, .submit, .submit:hover, .evo_panel__register .panel .panel-body .search, .SaveButton.btn-primary, input.btn-success, input.btn-success:hover, a.btn-primary:hover, input.btn-primary, input.btn-primary:hover, .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover { background-color: $color; border-color: $color }\n";
		}
		if( $color = $this->get_setting( 'sidebar_links_color' ) )
		{
			$custom_css .= ".evo_container__sidebar a, .evo_container__sidebar a:hover, .evo_container__sidebar2 a, .evo_container__sidebar2 a:hover { color: $color }\n";
		}
		if( $color = $this->get_setting( 'widget_titles_color' ) )
		{
			$custom_css .= "h1, h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h5 a, h6, h6 a, .widget-heading a, .widget-heading a:hover, .evo_container__header a, evo_container__header a:hover, .widget-heading-title, main .evo_widget h2, .error_404 h2, .error_403 h2, .disp_sitemap main > h3, #bCalendarToday { color: $color }\n";
			$custom_css .= "#bCalendarToday { border-color: $color; color: $color }\n";
		}
		if( $color = $this->get_setting( 'borders_color' ) )
		{
			$custom_css .= "div.compact_search_form input.search_field, .evo_comment, main > h2, .evo_comment__meta_info a, .evo_comment__meta_info a:hover, .comment-form .form-body, .evo_post > .form-horizontal > .fieldset_wrapper > fieldset.fieldset .panel.panel-default .panel-body, .form_textarea_input, nav.site_pagination a, .preview, .preview:hover, .profile_column_right .panel.panel-default .panel-body, .evo_panel__register .panel .panel-body, .SaveButton.btn-info, .evo_panel__login .panel.panel-default .panel-body, a.btn-primary, .evo_panel__lostpass > .panel.skin-form .panel-body, .results, .results .panel-heading, .results .panel-footer, .pagination>li>a, .pagination>li>span { border-color: $color }\n";
			$custom_css .= ".titles-border { border-bottom: 1px solid $color }\n";
			$custom_css .= ".evo_widget .widget-heading { border-bottom: 2px solid $color }\n";
			$custom_css .= ".evo_comment__meta_info a:hover, main .well, .post_tags a, .post_tags a:hover, .ufld_icon_links a { background-color: $color }\n";
		}


		/**
		 * Menu customization
		 */
		if( $color = $this->get_setting( 'menu_bg_color' ) )
		{
			$custom_css .= ".navbar.navbar-default { background-color: $color }\n";
		}
		if( $color = $this->get_setting( 'menu_link_color' ) )
		{
			$custom_css .= ".navbar.navbar-default .navbar-nav li a { color: $color }\n";
		}
		if( $color = $this->get_setting( 'active_link_bg_color' ) )
		{
			$custom_css .= ".navbar.navbar-default .navbar-nav .active a { background-color: $color }\n";
		}
		if( $color = $this->get_setting( 'active_link_color' ) )
		{
			$custom_css .= ".navbar.navbar-default .navbar-nav .active a { color: $color }\n";
		}


		/**
		 * Titles customization
		 */
		 if( $color = $this->get_setting( 'title_links_color' ) )
		 {
			 $custom_css .= ".evo_post_title h2 a, .evo_post_title h1, .evo_post_title h1 a { color: $color }\n";
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
				return 'col-md-8 pull-right';

			case 'right_sidebar':
				// Right Sidebar
			default:
				return 'col-md-8';
		}
	}
}

?>