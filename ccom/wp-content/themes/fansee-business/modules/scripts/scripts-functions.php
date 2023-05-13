<?php
/**
 * Enqueue scripts and styles
 * @since Fansee Business 1.0
 */
if( !function_exists( 'fansee_business_enqueue_scripts' ) ){

	function fansee_business_enqueue_scripts( $scripts, $base, $dir = true ){
		
		$type = WP_DEBUG ? '' : 'min.'; //min.

		foreach( $scripts as $h => $script ){
			$v = $script[ 'version' ];
			
			$style_path =  $dir ? "{$base}/{$h}/{$h}.{$type}" : "{$base}/{$h}.{$type}";
			$style_path = get_theme_file_uri( $style_path . "css" );

			if( !isset( $script[ 'no-style' ] ) ){
				wp_enqueue_style( $h, $style_path, array(), $v );
			}

			if( !isset( $script[ 'no-script' ] ) ){
				if( isset( $script[ 'file' ] ) ){
					$js_path = $script[ 'file' ];
				}else{
					$js_path =  $dir ? "{$base}/{$h}/{$h}.{$type}" : "{$base}/{$h}.{$type}";
					$js_path = get_theme_file_uri( $js_path . "js" );
				}
				wp_enqueue_script( $h, $js_path, array( 'jquery' ), $v );
			}
		}
	}
}
/**
 * Add scripts and styles
 * @since Fansee Business 1.0
 */
function fansee_business_scripts(){

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'fansee-business-style', get_stylesheet_uri(), array(), $theme_version );

	$scripts = array( 
		'bootstrap' => array(
			'no-script' => true,
			'version' => '5.0.0'
		),
		'font-awesome' => array(
			'version' => '1.0.0',
			'no-script' => true
		),
		'slick' => array(
			'version' => '1.8.0'
		),
		'sticky' => array(
			'no-style' => true,
			'version' => '1.0.4'
		)
	);

	fansee_business_enqueue_scripts( $scripts, "assets/vendors" );

	$scripts = array(
 		'fst-mmenu' => array(
 			'version' => '1.0'
 		),
 		'fst-popup-search' => array(
 			'version' => '1.0'
 		),
 		'fst-show-nav-on-screen' => array(
 			'version' => '1.0',
 			'no-style' => true
 		)
	);

	fansee_business_enqueue_scripts( $scripts, "assets/plugins" );
	
	$scripts = array(
		'blocks' => array(
			'version' => '1.0',
			'no-script' => true
		),
		'base' => array(
			'version' => '1.0',
			'no-script' => true
		),
		'theme' => array(
			'version' => '1.0',
			'no-script' => true
		)
	);

	fansee_business_enqueue_scripts( $scripts, "assets/css", false );

	$scripts = array(
		'theme' => array(
			'version' => '1.0',
			'no-style' => true
		)
	);

	fansee_business_enqueue_scripts( $scripts, "assets/js", false );
	wp_localize_script( 'theme', 'FANSEE', array(
		'search_label' => esc_html__( 'What are you looking for?', 'fansee-business' ),
		'home_url'     => esc_url( home_url( '/' ) ),
	));
	
	#fonts
	wp_enqueue_style( 'fansee-business-fonts', fansee_business_generate_font_url() );
	# enqueue comment-reply.js in single page only
	if( ( is_single() || is_page() ) && comments_open() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}

	# load rtl.css if site is RTL
	if( is_rtl() ){	
		wp_enqueue_style( 'fansee-business-rtl', get_theme_file_uri( 'rtl.css' ), array(), $theme_version );
	}
}
add_action( 'wp_enqueue_scripts', 'fansee_business_scripts' ); 

/**
 * Add block assets
 * @since Fansee Business 1.0
 */
function fansee_business_editor_assets(){
	$theme_version = wp_get_theme()->get( 'Version' );
	$type = WP_DEBUG ? '' : 'min.'; //min.
	wp_enqueue_style( 'fansee-business-editor-style', get_theme_file_uri( "assets/build/css/block-editor-styles.{$type}css" ), array(), $theme_version );
}
add_action( 'enqueue_block_editor_assets', 'fansee_business_editor_assets' );

/**
 * Add css for backend
 * @since Fansee Business 1.0
 */
function fansee_business_admin_scripts(){
	$theme_version = wp_get_theme()->get( 'Version' );
	$type = WP_DEBUG ? '' : 'min.'; //min.
	wp_enqueue_style( 'fansee-business-admin-style', get_theme_file_uri( "assets/build/css/admin.{$type}css" ), array(), $theme_version );
}
add_action( 'admin_enqueue_scripts', 'fansee_business_admin_scripts' );