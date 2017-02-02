<?php
	// Listado de comentarios
	function comentarios($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	     <article id="comment-<?php comment_ID(); ?>" class="clearfix">
		  <?php echo get_avatar($comment,$size='75' ); ?>
	    	<div class="comment-content">
	    		<h5 class="author">
					<?php comment_author_link(); ?>
					<?php if ($comment->comment_approved == '0') : ?>
			         	<em><?php _e('Your comment is awaiting moderation.', 'ungrynerd') ?></em>
			      	<?php endif; ?>
			      	<?php edit_comment_link(__('(Edit)', 'ungrynerd'),'  ','') ?>
				</h5>
	    		<?php comment_text() ?>
	    	</div>
	     </article>
	<?php
	}

	function ungrynerd_pagination($query=null) {
		global $wp_query;
		$query = $query ? $query : $wp_query;
		$big = 999999999;

		$paginate = paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'type' => 'array',
			'total' => $query->max_num_pages,
			'format' => '?paged=%#%',
			'mid_size' => 2,
            'end_size' => 1,
			'current' => max( 1, get_query_var('paged') ),
			'prev_text' => __('<i class="fa fa-chevron-left"></i>'),
			'next_text' => __('<i class="fa fa-chevron-right"></i>'),
			)
		);

		if ($query->max_num_pages > 1) : ?>
			<ul class="pagination">
			<?php foreach ( $paginate as $page ) {
				echo '<li>' . $page . '</li>';
			} ?>
		</ul>
		<?php endif;
	}

	function ungrynerd_path($path='') {
		echo get_template_directory_uri() . $path;
	}

	// Define walker nav menu to display custom html output
    class ungrynerd_walker_nav_menu extends Walker_Nav_Menu {

        function start_el( &$output, $item, $depth = 0, $args = array(), $curr = 0 ) {
            global $wp_query;
            $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

            $depth_classes = array(
                ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
                ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
                ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
                'menu-item-depth-' . $depth
            );
            $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
            $class_names = str_replace('current_page_item', 'active', $class_names);
            if (strpos($item->url, '#')) {
                $class_names = str_replace('current-menu-item', '', $class_names);
                $class_names = str_replace('current', '', $class_names);
            }

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
            $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
            $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

            $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

            global $wp;
            $attributes .= ! empty( $item->url )        ? ' data-target="'   . esc_attr( str_replace(home_url($wp->request . '/'), '', $item->url)) .'"' : '';

            $item_output = '';
            if (is_object($args)) :
            $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
                $args->before,
                $attributes,
                $args->link_before,
                apply_filters( 'the_title', $item->title, $item->ID ),
                $args->link_after,
                $args->after
            );
            endif;
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, 0 );
        }
        function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "\n";
		}
    }
?>
