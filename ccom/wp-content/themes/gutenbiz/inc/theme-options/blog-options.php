<?php
/**
* Register blog Options
*
* @return void
* @since 1.0.0
*
* @package Gutenbiz WordPress theme
*/
function gutenbiz_blog_options(){	
	Gutenbiz_Customizer::set(array(
		# Theme option
		'panel' => 'panel',
		# Theme Option > color options
		'section' => array(
		    'id'       => 'blog-section',
		    'title'    => esc_html__( 'Blog Options' ,'gutenbiz' ),
		    'priority' => 25
		),
		'fields'  => array(
			array(
				'id'	=> 'meta-sections-order',
				'label' => esc_html__( 'Archive Meta Order', 'gutenbiz' ),
				'description' => esc_html__( 'Please make sure that you have enabled all sections under "Post Options"', 'gutenbiz' ),
				'type'  => 'gutenbiz-section-order',
				'default' =>json_encode(array(
					'title', 'date', 'category', 'excerpt', 'comment'
				)),
				'choices' => array(
					'title' => esc_html__( 'Title', 'gutenbiz' ),
					'date' => esc_html__( 'Date', 'gutenbiz' ),
					'category' => esc_html( 'Category', 'gutenbiz' ),
					'excerpt' => esc_html__( 'Excerpt', 'gutenbiz' ),
					'comment' => esc_html__( 'Comment', 'gutenbiz' )
				),
				'transport'   => 'refresh'
			),
		),			
	));
}
add_action( 'init', 'gutenbiz_blog_options' );
