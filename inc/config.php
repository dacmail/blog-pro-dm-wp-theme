<?php
	//Theme setup
	function ungrynerd_setup() {
		load_theme_textdomain('ungrynerd', get_template_directory() . '/languages');

		//Add support to RSS links in head
		add_theme_support('automatic-feed-links');

		//Add title tag support
		add_theme_support('title-tag');

		// Soporte para miniaturas y definición de tamaños
		add_theme_support('post-thumbnails');
		if ( function_exists('add_image_size')) {
			add_image_size('col-12', 1500, 9999, false);
			add_image_size('col-8', 1000, 9999, false);
			add_image_size('col-4', 500, 9999, false);
			add_image_size('col-4-crop', 500, 270, false);
			add_image_size('col-4-square', 500, 500, true);
		}

		// Definición menús
		if ( function_exists('register_nav_menus')) {
			register_nav_menus(
				array(
				  'main' => esc_html__('Menu principal', 'ungrynerd'),
				  'footer' => esc_html__('Enlaces pie', 'ungrynerd'),
				)
			);
		}

		//HTML markup
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		add_theme_support('custom-logo');
		add_theme_support('custom-header');

	}
	add_action('after_setup_theme', 'ungrynerd_setup');

	// Content width
	function ungrynerd_content_width() {
		$GLOBALS['content_width'] = apply_filters('ungrynerd_content_width', 640);
	}
	add_action('after_setup_theme', 'ungrynerd_content_width', 0);

	// Widgets zones definition
	function ungrynerd_widgets_init() {
		register_sidebar(array(
			'id' => 'sidebar-1',
		    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h2 class="post-category">',
		 	'after_title' => '</h2>',
		 	'name' => esc_html__('Barra Lateral', 'ungrynerd')
		));
		register_sidebar(array(
			'id' => 'sidebar-footer',
		    'before_widget' => '<div id="%1$s" class="widget col-sm-4 %2$s">',
		    'after_widget' => '</div>',
		    'before_title' => '<h2 class="post-category">',
		 	'after_title' => '</h2>',
		 	'name' => esc_html__('Pre Footer Home', 'ungrynerd')
		));
	}
	add_action('widgets_init', 'ungrynerd_widgets_init');
?>
