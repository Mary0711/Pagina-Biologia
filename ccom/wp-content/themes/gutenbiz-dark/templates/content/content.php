<?php
/**
 * Template part for displaying page content in index.php and archive.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @since 1.0.0
 * @package Gutenbiz WordPress Theme
 */
?>
<article <?php Gutenbiz_Helper::schema_body( 'article' ); ?> id="post-<?php the_ID(); ?>" <?php post_class( Gutenbiz_Helper::with_prefix( 'post' ) ); ?> >
	<a href="<?php the_permalink() ?>">		
		<div class="image-full post-image" style="<?php Gutenbiz_Dark_Theme::the_default_image( get_the_ID() ); ?>">
			<?php Gutenbiz_Helper::post_format_icon() ?>
		</div>	
	</a>
	
	<div class="post-content-wrap">		
		<?php 
			Gutenbiz_Helper::get_title();
			get_template_part( 'templates/meta', 'info' );
			the_excerpt();	
			Gutenbiz_Helper::get_comment_number();
		?>
	</div>
</article>