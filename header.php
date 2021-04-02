<?php
/**
 * Header file for the spielgarten theme.
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

?><!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<head>

		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >
		<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/images/favicon.ico" />

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>

		<header id="site-header" role="banner">

			<div class="header-inner section-inner">

			<?php $header = get_field('header','options');

			$logo = isset($header['logo']) ? $header['logo'] : false;
			$logoSVG = isset($header['logo_svg']) ? $header['logo_svg'] : false;
			$altLogo = isset($header['alternatives_logo']) ? $header['alternatives_logo'] : false;
			$altLogoSVG = isset($header['alternatives_logo_svg']) ? $header['alternatives_logo_svg'] : false;
			$icons = isset($header['icons']) ? $header['icons'] : false;
			$untertitel = isset($header['untertitel_rechts']) ? $header['untertitel_rechts'] : false;

			?>

			<a href="<?php echo home_url();?>" class="logo">
				<?php if($logoSVG) {
					echo wp_kses( $logoSVG, get_kses_extended_ruleset() );
				} else if($logo) {
					echo '<img src="'. esc_url($logo) .'" alt="" />';
				} else {
					echo get_bloginfo('name');
				}?>
			</a>

			<?php if ( has_nav_menu( 'primary' ) ) { ?>
				<div id="nav-toggle" class="" aria-expanded="false">
		             <span></span>
		        </div>

				<nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e( 'Horizontal', 'wpblank' ); ?>" role="navigation">
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'primary',  ) ); ?>
				</nav>
			<?php } ?>

			</div><!-- .header-inner -->

		</header><!-- #site-header -->

<div class="wrapper">
