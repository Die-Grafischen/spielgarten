<?php
/* Template name: Projekte */

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
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<?php $mobileTitle = get_field('titel', $id) ?: false;
        if($mobileTitle) {
            echo '<h2 id="mobile-team-title">'. esc_html($mobileTitle) .'</h2>';
        } ?>

		<div id="the-content" class="projekte grid-view">

			<div class="projekte-nav">
				<svg xmlns="http://www.w3.org/2000/svg" width="19.382" height="18.429" viewBox="0 0 19.382 18.429"
					id="grid-view" class="active-icon">
					<g id="views" transform="translate(-3.368 -2.763)">
						<path id="Path_309" data-name="Path 309"
							d="M10.51,4.24V9.494H4.845V4.24H10.51m.54-1.477H4.305a.937.937,0,0,0-.937.938v6.334a.937.937,0,0,0,.937.937H11.05a.937.937,0,0,0,.937-.937V3.7a.937.937,0,0,0-.937-.938Z"
							fill="#437a29" />
						<path id="Path_310" data-name="Path 310"
							d="M39.651,4.24V9.494H33.985V4.24h5.665m.54-1.477H33.446a.937.937,0,0,0-.938.938v6.334a.937.937,0,0,0,.938.937H40.19a.937.937,0,0,0,.938-.937V3.7a.937.937,0,0,0-.938-.938Z"
							transform="translate(-18.378)" fill="#437a29" />
						<path id="Path_311" data-name="Path 311"
							d="M10.51,31.914v5.254H4.845V31.914H10.51m.54-1.477H4.305a.937.937,0,0,0-.937.938v6.333a.937.937,0,0,0,.937.938H11.05a.937.937,0,0,0,.937-.938V31.375a.937.937,0,0,0-.937-.938Z"
							transform="translate(0 -17.453)" fill="#437a29" />
						<path id="Path_312" data-name="Path 312"
							d="M39.651,31.914v5.254H33.985V31.914h5.665m.54-1.477H33.446a.937.937,0,0,0-.938.938v6.333a.937.937,0,0,0,.938.938H40.19a.937.937,0,0,0,.938-.938V31.375a.937.937,0,0,0-.938-.938Z"
							transform="translate(-18.378 -17.453)" fill="#437a29" />
					</g>
				</svg>

				<svg xmlns="http://www.w3.org/2000/svg" width="16.823" height="17.954" viewBox="0 0 16.823 17.954"
					id="text-view">
					<g id="cats" transform="translate(-63.9 -14)">
						<g id="Group_87" data-name="Group 87" transform="translate(63.9 14)">
							<path id="Path_317" data-name="Path 317"
								d="M79.968,15.615H64.654a.809.809,0,0,1,0-1.615H79.968a.809.809,0,0,1,0,1.615Z"
								transform="translate(-63.9 -14)" />
						</g>
						<g id="Group_88" data-name="Group 88" transform="translate(63.9 19.446)">
							<path id="Path_318" data-name="Path 318"
								d="M79.968,30.148H64.654a.809.809,0,0,1,0-1.615H79.968a.809.809,0,0,1,0,1.615Z"
								transform="translate(-63.9 -28.533)" />
						</g>
						<g id="Group_89" data-name="Group 89" transform="translate(63.9 24.893)">
							<path id="Path_319" data-name="Path 319"
								d="M79.968,44.682H64.654a.809.809,0,0,1,0-1.615H79.968a.809.809,0,0,1,0,1.615Z"
								transform="translate(-63.9 -43.067)" />
						</g>
						<g id="Group_90" data-name="Group 90" transform="translate(63.9 30.339)">
							<path id="Path_320" data-name="Path 320"
								d="M79.968,59.215H64.654a.809.809,0,0,1,0-1.615H79.968a.809.809,0,0,1,0,1.615Z"
								transform="translate(-63.9 -57.6)" />
						</g>
					</g>
				</svg>

				<svg xmlns="http://www.w3.org/2000/svg" width="17.542" height="18.43" viewBox="0 0 17.542 18.43"
					id="projekte-filter">
					<g id="filter" transform="translate(-112.601 -11.8)">
						<path id="Path_333" data-name="Path 333"
							d="M123.829,30.23h-4.912V24.263l-5.808-8.8a2.447,2.447,0,0,1-.263-2.531,2.463,2.463,0,0,1,2.3-1.129H127.6a2.463,2.463,0,0,1,2.3,1.129,2.464,2.464,0,0,1-.276,2.552l-5.8,8.781Zm-3.435-1.477h1.957V23.861l6.011-9.148c.284-.45.37-.842.244-1.071s-.5-.365-1.01-.365H115.149c-.506,0-.884.136-1.01.365a1.143,1.143,0,0,0,.231,1.05l6.023,9.169Z" />
					</g>
				</svg>

				<div id="projekte-current-cat"></div>

				<?php $terms = get_terms('kategorie');
                    if ( !empty( $terms ) && !is_wp_error( $terms ) ){
                        echo '<div id="projekte-cats">
                            <ul>';
								echo '<li>Alle Projekte </li>';
                                foreach ( $terms as $term ) {
                                echo '<li>' . $term->name .  '</li>';
                                }
                            echo '</ul>
							<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="16px" viewBox="0 0 24 20" class="close-icon">	
								<path class="st0"
									d="M19.7,15.8c0,0-0.1-0.1-0.1-0.1L13.9,10l5.7-5.7c0,0,0,0,0,0l1.1-1.1l-1.9-1.9l-1,1c0,0,0,0-0.1,0 c0,0-0.1,0.1-0.1,0.1L12,8.1L6.3,2.4c0,0,0,0,0,0L5.2,1.3L3.3,3.2l1,1c0,0,0,0,0,0.1c0,0,0.1,0,0.1,0.1l5.7,5.7l-6.8,6.8l1.9,1.9 l1-1c0,0,0,0,0.1,0c0,0,0-0.1,0.1-0.1l5.7-5.7l5.7,5.7c0,0,0,0,0,0l1.1,1.1l1.9-1.9L19.7,15.8C19.7,15.8,19.7,15.8,19.7,15.8z" />
							</svg>
                        </div>';
                    }?>

			</div>

			<div class="projekte-wrapper">
				<?php
                $args = array(
                    'post_type'      => 'projekt',
                    'posts_per_page' => '-1',
                    'order'          => 'ASC'
                );

                $the_query = new WP_Query( $args );

                // The Loop
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();

                    get_template_part( 'template-parts/projekt', get_post_type() );

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
