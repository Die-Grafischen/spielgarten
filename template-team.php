<?php
/* Template name: Team */

/**
 * 
 * The template for displaying team
 *
 *
 * @package WordPress
 * @subpackage WPBlank
 * @since WPBlank 1.0
 */

get_header();
?>

<main id="site-content" role="main">
	<article <?php post_class(); ?> id="post-<?php the_ID(); $id = get_the_ID();?>">

		<?php get_template_part( 'template-parts/sidebar', get_post_type() ); ?>

		<div id="the-content" class="team-members">

			<?php if ( has_post_thumbnail(get_the_ID()) ) {
                the_post_thumbnail(get_the_ID());
            }?>

			<div class="team-wrapper">

				<?php
                    $args = array(
                    'post_type'      => 'team',
                    'posts_per_page' => '-1',
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC'
                );

                $the_query = new WP_Query( $args );

                // The Loop
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                    
                    get_template_part( 'template-parts/team', get_post_type() );

                    endwhile;
                    echo '<div class="sizer"></div>';
                endif;

                // Reset Post Data
                wp_reset_postdata();

                ?>
			</div>
		</div>
	</article>
</main><!-- #site-content -->

<?php get_footer(); ?>
