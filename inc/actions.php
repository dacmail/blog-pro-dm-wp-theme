<?php
	//Change for activate development mode (using JS and CSS in assets folder)
	define('WP_DEVELOPMENT_MODE', false);


	//Enqueue scripts and styles
	function ungrynerd_scripts() {
		wp_enqueue_style(
			'ungrynerd-theme-style',
			get_stylesheet_uri());

		//If WP_DEVELOPMENT_MODE is activate use LESS files
		if (defined('WP_DEVELOPMENT_MODE') && WP_DEVELOPMENT_MODE ) {
			wp_enqueue_script(
				'ungrynerd-js',
				'//cdnjs.cloudflare.com/ajax/libs/less.js/2.5.3/less.min.js',
				array('jquery'),
				'1.0.0',
				true);
			wp_enqueue_style('ungrynerd-main-less',
				get_template_directory_uri() . '/assets/styles/main.less');
		} else {
			wp_enqueue_style('ungrynerd-main-styles',
				get_template_directory_uri() . '/css/main.css');
		}


		if (!is_admin()) {

			wp_deregister_script('jquery');
			wp_enqueue_script(
				'jquery',
				'/wp-includes/js/jquery/jquery.js',
				'',
				'',
				true);

			if (defined('WP_DEVELOPMENT_MODE') && WP_DEVELOPMENT_MODE ) {
				wp_enqueue_script(
					'bootstrap',
					get_template_directory_uri() . '/assets/scripts/bootstrap.js',
					array('jquery'),
					'1.0.0',
					true);
				wp_enqueue_script(
					'ungrynerd-main',
					get_template_directory_uri() . '/assets/scripts/main.js',
					array('jquery'),
					'1.0.0',
					true);
			} else {
				wp_enqueue_script(
					'ungrynerd-js',
					get_template_directory_uri() . '/js/main.js',
					array('jquery'),
					'1.0.0',
					true);
			}

			wp_enqueue_script(
				'html5shiv',
				'//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js',
				array(),
				'3.7.2');
			wp_enqueue_script('respond',
				'//oss.maxcdn.com/respond/1.4.2/respond.min.js',
				array(),
				'1.4.2');

			wp_script_add_data('html5shiv', 'conditional', 'lt IE 9');
			wp_script_add_data('respond', 'conditional', 'lt IE 9');
		}

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
	}
	add_action('wp_enqueue_scripts', 'ungrynerd_scripts');

	//Remove emojis support
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	//Remove recent comments styles in head
	function remove_recent_comments_style() {
	    global $wp_widget_factory;
	    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
	}
	add_action('widgets_init', 'remove_recent_comments_style');

	//Custom image sizes in Media popups
	add_filter( 'image_size_names_choose', 'ungrynerd_custom_image_sizes' );
	function ungrynerd_custom_image_sizes( $sizes ){
		$custom_sizes = array(
			'col-4-square' =>	'Miniatura de galería',
		);
		return array_merge( $sizes, $custom_sizes );
	}

	function enqueue_less_styles($tag, $handle) {
	    global $wp_styles;
	    $match_pattern = '/\.less$/U';
	    if ( preg_match( $match_pattern, $wp_styles->registered[$handle]->src ) ) {
	        $handle = $wp_styles->registered[$handle]->handle;
	        $media = $wp_styles->registered[$handle]->args;
	        $href = $wp_styles->registered[$handle]->src . '?ver=' . $wp_styles->registered[$handle]->ver;
	        $rel = isset($wp_styles->registered[$handle]->extra['alt']) && $wp_styles->registered[$handle]->extra['alt'] ? 'alternate stylesheet' : 'stylesheet';
	        $title = isset($wp_styles->registered[$handle]->extra['title']) ? "title='" . esc_attr( $wp_styles->registered[$handle]->extra['title'] ) . "'" : '';

	        $tag = "<link rel='stylesheet' id='$handle' $title href='$href' type='text/less' media='$media' />";
	    }
	    echo $tag;
	}

	// DEVELOPMENT MODE LESS FILES
	if (defined('WP_DEVELOPMENT_MODE') && WP_DEVELOPMENT_MODE && !is_admin() ) {
		add_filter( 'style_loader_tag', 'enqueue_less_styles', 5, 2);
	}

	add_filter( 'body_class', function( $classes ) {
		if (has_header_image()) {
			return array_merge( $classes, array('has-header-image'));
		}
		return $classes;
	});

	add_action('pre_get_posts', 'ungrynerd_ignore_sticky');
	function ungrynerd_ignore_sticky($query) {
	    if (is_home() && $query->is_main_query() || is_front_page())
	        $query->set('post__not_in', get_option('sticky_posts'));
	}

	add_filter( 'post_class', 'ungrynerd_post_class', 10, 3 );
	if( !function_exists( 'ungrynerd_post_class' ) ) {
	    function ungrynerd_post_class( $classes, $class, $ID ) {
	        if (!has_post_thumbnail()) {
	        	$classes[] = 'no-thumbnail';
	        }
	    	return $classes;
	    }
	}

	//Customize archives title
	add_filter('get_the_archive_title', function($title) {
		if ( is_category() ) {
	        $title = sprintf( __( 'Categoría %s' ), '<span class="term">' .single_cat_title( '', false ) . '</span>');
	    } elseif ( is_tag() ) {
	        $title = sprintf( __( 'Etiqueta %s' ), '<span class="term">' .single_tag_title( '', false ) . '</span>');
	    } elseif ( is_author() ) {
	        $title = sprintf( __( 'Autor %s' ), '<span class="term">' . get_the_author() . '</span>' );
	    } elseif ( is_year() ) {
	        $title = sprintf( __( 'Búsqueda por año %s' ), '<span class="term">' .get_the_date( _x( 'Y', 'yearly archives date format' ) ) . '</span>');
	    } elseif ( is_month() ) {
	        $title = sprintf( __( 'Búsqueda por mes %s' ), '<span class="term">' .get_the_date( _x( 'F Y', 'monthly archives date format' ) ) . '</span>');
	    } elseif ( is_day() ) {
	        $title = sprintf( __( 'Búsqueda por día %s' ), '<span class="term">' .get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) . '</span>');
	    } elseif ( is_post_type_archive() ) {
	        $title = sprintf( __( 'Archivos %s' ), '<span class="term">' .post_type_archive_title( '', false ) . '</span>');
	    } elseif ( is_tax() ) {
	        $tax = get_taxonomy( get_queried_object()->taxonomy );
	        $title = sprintf( __( '%1$s %2$s' ), $tax->labels->singular_name, '<span class="term">' . single_term_title( '', false ) . '</span>');
	    } elseif (is_search()) {
	    	$title = sprintf( __( 'Resultados de búsqueda %s' ), '<span class="term">' . get_search_query() . '</span>');
	    } else {
	        $title = __( 'Archivos' );
	    }
	    return $title;
	});

	function ungrynerd_opengraph( $output ) {
			return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
		}
	add_filter('language_attributes', 'ungrynerd_opengraph');

	function ungrynerd_facebook_info() {
		global $post;
		if (!is_singular())
			return;
	        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	        echo '<meta property="og:type" content="article"/>';
	        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	        echo '<meta property="og:site_name" content="Diario de Madrid"/>';
		if(has_post_thumbnail( $post->ID )) {
			$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
		}
		echo "
	";
	}
	add_action( 'wp_head', 'ungrynerd_facebook_info', 5 );
