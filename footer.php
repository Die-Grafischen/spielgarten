<?php
/**
 * The template for displaying the footer
 *
 * Contains the opening of the #site-footer div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage WPBlank
 * @since WPBlank 1.0
 */

 // Exit if accessed directly.
 if ( ! defined( 'ABSPATH' ) ) {
 	exit;
 }

?>
</div><!-- .wrapper -->
<footer id="site-footer" role="contentinfo">

	<div class="section-inner">

		<?php $footer = get_field('footer', 'options');
		$widgetLinks = !empty($footer['text-widget-links']) ? $footer['text-widget-links'] : false;
		$widgetMitte = !empty($footer['text-widget-mitte']) ? $footer['text-widget-mitte'] : false;
		$widgetRechts = !empty($footer['text-widget-rechts']) ? $footer['text-widget-rechts'] : false;
		?>

		<?php if($widgetLinks) {
			echo '<div class="text-widget twl">'. wp_kses_post($widgetLinks) .'</div>';
		}

		if($widgetMitte) {
			echo '<div class="text-widget twm">'. wp_kses_post($widgetMitte) .'</div>';
		}

		if($widgetRechts) {
			echo '<div class="text-widget twr">'. wp_kses_post($widgetRechts) .'</div>';
		}

		 ?>

		<div class="footer-credits">

			<p class="footer-copyright">&copy;
				<?php
						echo date_i18n(
							/* translators: Copyright date format, see https://www.php.net/date */
							_x( 'Y', 'Copyright', 'wpblank' )
						);
						?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			</p><!-- .footer-copyright -->

		</div><!-- .footer-credits -->

	</div><!-- .section-inner -->

</footer><!-- #site-footer -->

<?php wp_footer(); ?>

</body>

</html>
