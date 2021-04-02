<?php
/**
 * blanky Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage blanky
 * @since blanky Theme 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blanky_theme_support() {


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on blanky Theme, use a find and replace
	 * to change 'blanky' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'blanky' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );


	/*
	 * Adds `async` and `defer` support for scripts registered or enqueued
	 * by the theme.
	 */
	$loader = new blanky_Script_Loader();
	add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );

}

add_action( 'after_setup_theme', 'blanky_theme_support' );

/**
 * REQUIRED FILES
 * Include required files.
 */

require get_template_directory() . '/inc/template-tags.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-blanky-script-loader.php';


/**
 * Register and Enqueue Styles.
 */
function blanky_register_styles() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'spielgarten-style', get_template_directory_uri() . '/assets/css/style.min.css', array(), $theme_version );
	wp_style_add_data( 'spielgarten-style', 'rtl', 'replace' );


}

add_action( 'wp_enqueue_scripts', 'blanky_register_styles' );

/**
 * Register and Enqueue Scripts.
 */
function blanky_register_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	//Include WP jQuery
    wp_enqueue_script('jquery');

	wp_enqueue_script( 'spielgarten-js', get_template_directory_uri() . '/assets/js/main.min.js', array(), $theme_version, false );
	wp_script_add_data( 'spielgarten-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'blanky_register_scripts' );


/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function blanky_menus() {

	$locations = array(
		'primary'  => __( 'Primary Menu', 'blanky' ),
		'secondary'   => __( 'Secondary Menu', 'blanky' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'blanky_menus' );


/**
 * Enqueue supplemental block editor styles.
 */
function blanky_block_editor_styles() {

	// Enqueue the editor styles.
	wp_enqueue_style( 'blanky-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );
	wp_style_add_data( 'blanky-block-editor-styles', 'rtl', 'replace' );

	// Enqueue the editor script.
	wp_enqueue_script( 'blanky-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'blanky_block_editor_styles', 1, 1 );


// Allow the Editor Role to change Theme Settings and use Customizer
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );


// Advanced Custom Fields
if (class_exists('ACF')) {
	require get_template_directory() . '/inc/acf.php';
}

//Extend wp_kses to escpae svg code
//usage echo wp_kses( $svg_code, get_kses_extended_ruleset() );

function get_kses_extended_ruleset() {
    $kses_defaults = wp_kses_allowed_html( 'post' );

    $svg_args = array(
        'svg'   => array(
            'class'           => true,
            'aria-hidden'     => true,
            'aria-labelledby' => true,
            'role'            => true,
            'xmlns'           => true,
            'width'           => true,
            'height'          => true,
            'viewbox'         => true, // <= Must be lower case!
        ),
        'g'     => array( 'fill' => true ),
        'title' => array( 'title' => true ),
        'path'  => array(
            'd'    => true,
            'fill' => true,
        ),
    );
    return array_merge( $kses_defaults, $svg_args );
}
