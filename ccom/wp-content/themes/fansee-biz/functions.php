<?php
/**
*  Enqueue parent stylesheet
* @since Fansee Biz 1.0
*/
function fansee_biz_scripts(){
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'fansee-business-parent-style', get_template_directory_uri() . '/style.css', array(), $theme_version );
	wp_enqueue_script( 'fansee-business-sticky-header', get_stylesheet_directory_uri() . '/assets/js/jquery.sticky.js', array('jquery') );
	wp_enqueue_script( 'fansee-business-main-js', get_stylesheet_directory_uri() . '/assets/js/main-script.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'fansee_biz_scripts' );

/**
*  Add options for top header
* @since Fansee Biz 1.0
*/
function fansee_biz_customizer_register(){
	$panel = array(
		'id' => Fansee_Business_Customizer::get_id( 'fansee-biz' ),
		'args' => array(
			'title'    => esc_html__( 'Fansee Biz', 'fansee-biz' ),
			'priority' => 10,
		)
	);

	$customizer = new Fansee_Business_Customizer();
	$customizer->fields = array(
		array(
		    'id'     => 'top-header',
		    'title'  => esc_html__( 'Top Header', 'fansee-biz' ),
		    'fields' => array(
		    	array(
		    		'id'      	  => 'top-header-enable',
		    		'label'   	  => esc_html__( 'Enable' , 'fansee-biz' ),
		    		'default' 	  => true,
		    		'type'	  	  => 'toggle'
		    	),
		    	array(
		    		'id'      	  => 'top-header-phone',
		    		'label'   	  => esc_html__( 'Phone' , 'fansee-biz' ),
		    		'default' 	  => '+999987675776',
		    		'type'	  	  => 'text',
		    		'active_callback' => 'fansee_biz_top_header_a_callback'
		    	),
		    	array(
		    		'id'      	  => 'top-header-email',
		    		'label'   	  => esc_html__( 'Email' , 'fansee-biz' ),
		    		'default' 	  => 'fanseethemes@gmail.com',
		    		'type'	  	  => 'text',
		    		'active_callback' => 'fansee_biz_top_header_a_callback'
		    	),
		    	array(
		    		'id'      	  => 'top-header-address',
		    		'label'   	  => esc_html__( 'Address' , 'fansee-biz' ),
		    		'default' 	  => 'NYC, NC 1234',
		    		'type'	  	  => 'text',
		    		'active_callback' => 'fansee_biz_top_header_a_callback'
		    	),
		    	array(
		    		'id'      	  => 'top-header-business-time',
		    		'label'   	  => esc_html__( 'Business Time' , 'fansee-biz' ),
		    		'default' 	  => '9 AM - 6 PM',
		    		'type'	  	  => 'text',
		    		'active_callback' => 'fansee_biz_top_header_a_callback'
		    	),
		    )
		)
	);

	$customizer->add( $panel );
}
add_action( 'init', 'fansee_biz_customizer_register' );

/**
*  Active callback function for top header
* @since Fansee Biz 1.0
*/
function fansee_biz_top_header_a_callback(){
	return Fansee_Business_Customizer::get( 'top-header-enable' );
}

/**
*  Register menu for social profile
* @since Fansee Biz 1.0
*/
function fansee_biz_register_nav(){
	register_nav_menus(array(
		'social' => esc_html__( 'Social', 'fansee-biz' )
	));
}
add_action( 'after_setup_theme', 'fansee_biz_register_nav' );

/**
 * get sidebar position
 * @since Fansee Biz 1.0
 */
function fansee_biz_get_sidebar_position(){
	if( is_search() ){
		return false;
	}elseif( is_singular( 'post' ) || is_page() || is_home() ){

		if( is_home() && is_front_page() ){
			$pos = fansee_business_get( 'sidebar-position' );
			return $pos;
		}

		if( is_front_page() ){
			return false;
		}
		
		$id = fansee_business_get_page_id();
		$meta_id = 'fansee-business-sidebar-position';
		$pos = get_post_meta( $id, $meta_id, true );
		if( $pos == '' ){
			$pos = 'show';
		}
		return $pos;
	}else{
		$pos = fansee_business_get( 'sidebar-position' );
		return $pos;
	}
}

/**
 * Determines if the page needs sidebar
 * overriding parent function
 * @since Fansee Biz 1.0
 */
function fansee_business_has_sidebar(){
	$pos = fansee_biz_get_sidebar_position();
	if( !$pos ){
		return false;
	}
	return $pos != 'hide';
}

/**
 * add class on body according to sidebar position
 * @since Fansee Biz 1.0
 */
function fansee_biz_body_class( $classes ){

	$pos = fansee_biz_get_sidebar_position();
	if( $pos ){
		if( $pos == 'show' ){
			$pos = 'right';
		}
		$classes[] = $pos . '-sidebar';
	}

	//banner alignment
	$alignment = fansee_business_get( 'banner-content-alignment' );

	$classes[] = 'inner-banner-' . $alignment;

	//darmode
	$darkmode = fansee_business_get( 'enable-dark-mode' );
	if( $darkmode ){
		$classes[] = 'darkmode';
	}

	//sticky header
	$sticky_header = fansee_business_get( 'enable-sticky-header' );
	if( $sticky_header ){
		$classes[] = 'sticky-header';
	}

	$per_row = fansee_business_get( 'blog-list-per-row' );
	$classes[] = 'blog-list-per-row-' . $per_row;

	return $classes;
}
add_filter( 'body_class', 'fansee_biz_body_class' );