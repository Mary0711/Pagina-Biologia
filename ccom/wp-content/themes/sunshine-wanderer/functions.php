<?php 
add_action( 'wp_enqueue_scripts', 'sunshine_wanderer_enqueue_styles' );
function sunshine_wanderer_enqueue_styles() {
	wp_enqueue_style( 'sunshine-wanderer-parent-style', get_template_directory_uri() . '/style.css' ); 
} 

function sunshine_wanderer_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'postpage', array(
		'title'      => __('Posts & Pages','sunshine-wanderer'),
		'priority'   => 1,
		'capability' => 'edit_theme_options',
	) );

	$wp_customize->add_setting( 'postpage_header', array(
		'default'           => '#1f1f1f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_header', array(
		'label'       => __( 'Headline Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_header',
	) ) );

	$wp_customize->add_setting( 'postpage_meta', array(
		'default'           => '#feb201',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_meta', array(
		'label'       => __( 'Meta Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_meta',
	) ) );

	$wp_customize->add_setting( 'postpage_text', array(
		'default'           => '#1f1f1f',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_text', array(
		'label'       => __( 'Text Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_text',
	) ) );

	$wp_customize->add_setting( 'postpage_link', array(
		'default'           => '#feb201',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_link', array(
		'label'       => __( 'Link Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_link',
	) ) );

	$wp_customize->add_setting( 'postpage_border', array(
		'default'           => '#eee',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_border', array(
		'label'       => __( 'Border Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_border',
	) ) );

	$wp_customize->add_setting( 'postpage_button_bg', array(
		'default'           => '#feb201',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_button_bg', array(
		'label'       => __( 'Button Background Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_button_bg',
	) ) );

	$wp_customize->add_setting( 'postpage_button_text', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_button_text', array(
		'label'       => __( 'Button Text Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_button_text',
	) ) );

	$wp_customize->add_setting( 'postpage_pagination_button_bg', array(
		'default'           => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_pagination_button_bg', array(
		'label'       => __( 'Pagination Text Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_pagination_button_bg',
	) ) );

	$wp_customize->add_setting( 'postpage_pagination_button_text', array(
		'default'           => '#333',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'postpage_pagination_button_text', array(
		'label'       => __( 'Pagination Text Color', 'sunshine-wanderer' ),
		'section'     => 'postpage',
		'priority'   => 1,
		'settings'    => 'postpage_pagination_button_text',
	) ) );

	function sunshine_wanderer_sanitize_checkbox( $input ) {
		return ( ( isset( $input ) && true == $input ) ? true : false );
	}

	
}

add_action( 'customize_register', 'sunshine_wanderer_customize_register' );


if ( ! function_exists( 'sunshine_wanderer_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Read More' link.
 */
function sunshine_wanderer_excerpt_more( $more ) {
	$link = sprintf( '<div class="readmore-wrapper"><a href="%1$s" class="more-link">%2$s</a></div>',
		esc_url( get_permalink( get_the_ID() ) ),
		__( 'Read More', 'sunshine-wanderer' )
	); 
	return '&hellip; ' . $link;
}
add_filter( 'excerpt_more', 'sunshine_wanderer_excerpt_more', 999 );
endif;



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sunshine_wanderer_customize_preview_js() {
	wp_enqueue_script( 'sunshine_wanderer-customizer', get_stylesheet_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'sunshine_wanderer_customize_preview_js' );


if(! function_exists('sunshine_wanderer_customizer_styling' ) ):
	function sunshine_wanderer_customizer_styling(){
		?>
		<style type="text/css">


			<style type="text/css">

			<?php if ( get_theme_mod( 'hide_sidebar' ) == '1' ) : ?>
				aside#secondary.featured-sidebar {
					display:none !important;
				}
				.main-has-sidebar {
					max-width:100%;
				}
				.site-content .inner.main-with-sidebar {
					max-width: 780px;
					display:block;
				}
			<?php endif; ?>


			.site-navigation .menu-wrap{ background: <?php echo esc_attr(get_theme_mod( 'navigation_bg_color')); ?>; }
			.menu-wrap ul li .sub-menu{ background: <?php echo esc_attr(get_theme_mod( 'navigation_bg_color')); ?> !important; }
			.site-title a,.site-description { color: <?php echo esc_attr(get_theme_mod( 'header_title_tagline_color')); ?>; }
			.menu-wrap ul li.menu-item-has-children .sub-menu li, .site-navigation{ border-color: <?php echo esc_attr(get_theme_mod( 'header_border_color')); ?>; }
			#menu-toggle { background-color: <?php echo esc_attr(get_theme_mod( 'header_border_color')); ?>; }
			.site-navigation a,#menu-toggle{ color: <?php echo esc_attr(get_theme_mod( 'header_link_color')); ?>; }
			.archive-list-title, .page-title, .not-found .page-title, .social-title, .comments-title, .tag-links, .parent-post-link, .comment-author .fn, .comment-author .url, .comment-reply-title, .entry-content h1, .entry-content h2, .entry-content h3, .entry-content h4, .entry-content h5, .entry-content h6, .entry-content th, .entry-title, .entry-title a, .entry-title a:hover{ color: <?php echo esc_attr(get_theme_mod( 'postpage_header')); ?>; }
			.entry-meta, .entry-meta *, .entry-meta, .entry-meta *:hover{ color: <?php echo esc_attr(get_theme_mod( 'postpage_meta')); ?>; }
			.entry-summary, .comments-area, .comments-area p, .entry-content, .entry-content address, .entry-content dt, .page-content, .page-content p, .entry-content p, .entry-content span, .entry-content div, .entry-content li, .entry-content ul, .entry-content ol, .entry-content td, .entry-content dd, .entry-content blockquote { color: <?php echo esc_attr(get_theme_mod( 'postpage_text')); ?>; }
			.page-content .search-field, .archive-list-title, .comments-area *, .entry-content *{ border-color: <?php echo esc_attr(get_theme_mod( 'postpage_border')); ?>; }
			.archive-list a, .comments-area a, .page .entry-content a, .single .entry-content a, .error404 .entry-content a { color: <?php echo esc_attr(get_theme_mod( 'postpage_link')); ?>; }
			.tag-links a, button:hover, button:focus, button:active, input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active, input[type="button"]:hover, input[type="button"]:focus, input[type="button"]:active, input[type="reset"]:hover, input[type="reset"]:focus, input[type="reset"]:active, button, input[type="submit"], input[type="button"], input[type="reset"], a.more-link{ background-color: <?php echo esc_attr(get_theme_mod( 'postpage_button_bg')); ?>; }
			button:hover, button:focus, button:active, input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active, input[type="button"]:hover, input[type="button"]:focus, input[type="button"]:active, input[type="reset"]:hover, input[type="reset"]:focus, input[type="reset"]:active, button, input[type="submit"], input[type="button"], input[type="reset"], a.more-link{ border-color: <?php echo esc_attr(get_theme_mod( 'postpage_button_bg')); ?>; }
			.tag-links a, button:hover, button:focus, button:active, input[type="submit"]:hover, input[type="submit"]:focus, input[type="submit"]:active, input[type="button"]:hover, input[type="button"]:focus, input[type="button"]:active, input[type="reset"]:hover, input[type="reset"]:focus, input[type="reset"]:active, button, input[type="submit"], input[type="button"], input[type="reset"], a.more-link{ color: <?php echo esc_attr(get_theme_mod( 'postpage_button_text')); ?>; }
			.nav-previous a, .nav-next a, .nav-previous a:hover, .nav-next a:hover,.pagination .page-numbers, .pagination .page-numbers:hover{ background-color: <?php echo esc_attr(get_theme_mod( 'postpage_pagination_button_bg')); ?>; }
			.nav-previous a, .nav-next a, .nav-previous a:hover, .nav-next a:hover,.pagination .page-numbers,.pagination .page-numbers:hover{ color: <?php echo esc_attr(get_theme_mod( 'postpage_pagination_button_text')); ?>; }
			.featured-sidebar .widget-title{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_header')); ?>; }
			.featured-sidebar *{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_text')); ?>; }
			.featured-sidebar a{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_link')); ?>; }
			.featured-sidebar .tagcloud a, .featured-sidebar .widget-title, .featured-sidebar *{ border-color: <?php echo esc_attr(get_theme_mod( 'sidebar_border')); ?>; }
			.featured-sidebar .widget input[type="submit"]{ background-color: <?php echo esc_attr(get_theme_mod( 'sidebar_button_bg')); ?>; }
			.featured-sidebar .widget input[type="submit"]{ color: <?php echo esc_attr(get_theme_mod( 'sidebar_button_text')); ?>; }
			<?php if ( get_theme_mod( 'hide_sidebar' ) == '1' ) : ?>
				aside#secondary.featured-sidebar {display:none !important;}
				.main-has-sidebar {max-width:100%;}
				.site-content .inner.main-with-sidebar {max-width: 780px;display:block;}
			<?php endif; ?>
			.site-footer{ background-color: <?php echo esc_attr(get_theme_mod( 'footer_bg')); ?>; }
			.site-footer .widget-title{ color: <?php echo esc_attr(get_theme_mod( 'footer_header')); ?>; }
			.site-footer li, .site-footer ol, .site-footer ul, .site-footer p, .site-footer span, .site-footer div, .site-footer { color: <?php echo esc_attr(get_theme_mod( 'footer_text')); ?>; }
			.icon-chevron-up:before, .site-footer a{ color: <?php echo esc_attr(get_theme_mod( 'footer_link')); ?>; }
			.site-footer .tagcloud a, .site-footer *{ border-color: <?php echo esc_attr(get_theme_mod( 'footer_border')); ?>; }
			.site-footer .widget input[type="submit"] { background-color: <?php echo esc_attr(get_theme_mod( 'footer_button_bg')); ?>; }
			.site-footer .widget input[type="submit"] { border-color: <?php echo esc_attr(get_theme_mod( 'footer_button_bg')); ?>; }
			.site-footer .widget input[type="submit"] { color: <?php echo esc_attr(get_theme_mod( 'footer_button_text')); ?>; }
			body{ background: <?php echo esc_attr(get_theme_mod( 'body_bg')); ?>; }
			.site-navigation, .site-header, .site-navigation .menu-wrap{ background: <?php echo esc_attr(get_theme_mod( 'header_bg_color')); ?>; }
			.menu-wrap ul li.menu-item-has-children:hover .sub-menu{ background: <?php echo esc_attr(get_theme_mod( 'header_bg_color')); ?> !important; }
		</style>
	<?php }
	add_action( 'wp_head', 'sunshine_wanderer_customizer_styling' );
endif;


function sunshine_wanderer_google_fonts() {
	wp_enqueue_style( 'sunshine-wanderer-google-fonts', '//fonts.googleapis.com/css2?family=Inter:wght@100;400;600&display=swap', false ); 
}
add_action( 'wp_enqueue_scripts', 'sunshine_wanderer_google_fonts' );


