<?php
/*
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


$prefix = '_ungrynerd_';

global $meta_boxes;

$meta_boxes = array();

$meta_boxes[] = array(
        'id'         => 'general_options',
        'title'      =>  __('Options'),
        'pages'      => array( 'page', 'post' ), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields'     => array(
            array(
                    'name' =>  __('Destacar en portada de blog', 'ungrynerd'),
                    'id' => $prefix . 'featured',
                    'type' => 'checkbox',
                ),
            array(
                    'name' =>  __('Autor/a', 'ungrynerd'),
                    'id' => $prefix . 'author',
                    'type' => 'text',
                ),
            array(
                    'name' =>  __('Enlaces', 'ungrynerd'),
                    'desc' =>  __('Enlaces: a la izquierda el texto y a la derecha la URL del enlace.', 'ungrynerd'),
                    'id' => $prefix . 'links',
                    'type' => 'key_value',
                ),
            array(
                    'name' =>  __('No mostrar imagen destacada en página de artículo', 'ungrynerd'),
                    'id' => $prefix . 'hide_thumb',
                    'type' => 'checkbox',
                ),
            array(
                    'name' =>  __('Este post contiene una galería', 'ungrynerd'),
                    'id' => $prefix . 'has_gallery',
                    'type' => 'checkbox',
                    'desc' =>  __('Se mostrará un icono descriptivo en portada', 'ungrynerd'),

                ),
            array(
                'name'       => esc_html__( 'Etiqueta destacada', 'ungrynerd' ),
                'id'         => $prefix . 'tag',
                'type'       => 'taxonomy_advanced',
                'taxonomy'   => 'post_tag',
                'field_type' => 'select',
                'std' => '0'
                )
        ),
    );

function ungrynerd_register_meta_boxes()
{
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
add_action( 'admin_init', 'ungrynerd_register_meta_boxes' );
