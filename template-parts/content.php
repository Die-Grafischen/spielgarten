<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WPBlank
 * @since WPBlank 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php get_template_part( 'template-parts/sidebar', get_post_type() ); ?>
	<?php $mobileTitle = get_field('titel', $id) ?: false;
		if($mobileTitle) {
			echo '<h2 id="mobile-team-title">'. esc_html($mobileTitle) .'</h2>';
		}
	?>
	<div id="the-content">
		<?php the_content(); ?>
	</div>
</article><!-- .post -->
