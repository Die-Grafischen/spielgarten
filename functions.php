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
	load_theme_textdomain( 'spielgarten' );

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

	wp_enqueue_script( 'spielgarten', get_template_directory_uri() . '/assets/js/main.js',
	array(),
	$theme_version, false );
	wp_script_add_data( 'spielgarten', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'blanky_register_scripts' );



/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function blanky_menus() {

	$locations = array(
		'primary'  => __( 'Primary Menu', 'blanky' ),
		'secondary'   => __( 'Secondary Menu', 'blanky' ),
		'mobile-menu' => __( 'Mobile Menu', 'blanky' ),
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

//add_action( 'enqueue_block_editor_assets', 'blanky_block_editor_styles', 1, 1 );


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

function enqueue_shuffle(){
if(is_singular()){
$theme_version = wp_get_theme()->get( 'Version' );
//load only if the block is on the page
if(is_page_template(array('template-team.php', 'template-projekte.php'))){

wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js',
array(), $theme_version,
false );

wp_enqueue_script( 'packery', get_template_directory_uri() . '/assets/js/packery.js',
array('isotope'), $theme_version,
false );

}
}
}
add_action('wp_enqueue_scripts','enqueue_shuffle');

// Register Custom Post Type Teammitglied
function create_teammitglied_cpt() {

$labels = array(
'name' => _x( 'Team', 'Post Type General Name', 'spielgarten' ),
'singular_name' => _x( 'Teammitglied', 'Post Type Singular Name', 'spielgarten' ),
'menu_name' => _x( 'Team', 'Admin Menu text', 'spielgarten' ),
'name_admin_bar' => _x( 'Teammitglied', 'Add New on Toolbar', 'spielgarten' ),
'archives' => __( 'Teammitglied Archive', 'spielgarten' ),
'attributes' => __( 'Teammitglied Attribute', 'spielgarten' ),
'parent_item_colon' => __( 'Eltern Teammitglied:', 'spielgarten' ),
'all_items' => __( 'Alle Team', 'spielgarten' ),
'add_new_item' => __( 'Teammitglied erstellen', 'spielgarten' ),
'add_new' => __( 'Erstellen', 'spielgarten' ),
'new_item' => __( 'Teammitglied erstellen', 'spielgarten' ),
'edit_item' => __( 'Bearbeite Teammitglied', 'spielgarten' ),
'update_item' => __( 'Aktualisiere Teammitglied', 'spielgarten' ),
'view_item' => __( 'Teammitglied anschauen', 'spielgarten' ),
'view_items' => __( 'Team anschauen', 'spielgarten' ),
'search_items' => __( 'Suche Teammitglied', 'spielgarten' ),
'not_found' => __( 'Keine Team gefunden.', 'spielgarten' ),
'not_found_in_trash' => __( 'Keine Team im Papierkorb gefunden.', 'spielgarten' ),
'featured_image' => __( 'Beitragsbild', 'spielgarten' ),
'set_featured_image' => __( 'Beitragsbild festlegen', 'spielgarten' ),
'remove_featured_image' => __( 'Beitragsbild entfernen', 'spielgarten' ),
'use_featured_image' => __( 'Als Beitragsbild verwenden', 'spielgarten' ),
'insert_into_item' => __( 'In Teammitglied einfügen', 'spielgarten' ),
'uploaded_to_this_item' => __( 'Zu diesem Teammitglied hochgeladen', 'spielgarten' ),
'items_list' => __( 'Team Liste', 'spielgarten' ),
'items_list_navigation' => __( 'Team Liste Navigation', 'spielgarten' ),
'filter_items_list' => __( 'Filter Team Liste', 'spielgarten' ),
'item_published' => __( 'Teammitglied veröffentlicht', 'spielgarten' ),
'item_published_privately' => __( 'Teammitglied privat veröffentlicht', 'spielgarten' ),
'item_reverted_to_draft' => __( 'Teammitglied als Entwurf gespeichert', 'spielgarten' ),
'item_scheduled' => __( 'Teammitglied geplant', 'spielgarten' ),
'item_updated' => __( 'Teammitglied aktualisiert', 'spielgarten' ),
);
$args = array(
'label' => __( 'Teammitglied', 'spielgarten' ),
'description' => __( '', 'spielgarten' ),
'labels' => $labels,
'menu_icon' => 'dashicons-businessman',
'supports' => array('title', 'page-attributes', 'custom-fields'),
'taxonomies' => array(),
'public' => false,
'show_ui' => true,
'show_in_menu' => true,
'menu_position' => 20,
'show_in_admin_bar' => true,
'show_in_nav_menus' => true,
'can_export' => true,
'has_archive' => false,
'hierarchical' => false,
'exclude_from_search' => false,
'show_in_rest' => true,
'publicly_queryable' => false,
'capability_type' => 'page',
);
register_post_type( 'team', $args );

}
add_action( 'init', 'create_teammitglied_cpt', 0 );

//Projekt CPT
// Register Custom Post Type Projekt
function create_projekt_cpt() {

$labels = array(
'name' => _x( 'Projekte', 'Post Type General Name', 'spielgarten' ),
'singular_name' => _x( 'Projekt', 'Post Type Singular Name', 'spielgarten' ),
'menu_name' => _x( 'Projekte', 'Admin Menu text', 'spielgarten' ),
'name_admin_bar' => _x( 'Projekt', 'Add New on Toolbar', 'spielgarten' ),
'archives' => __( 'Projekt Archive', 'spielgarten' ),
'attributes' => __( 'Projekt Attribute', 'spielgarten' ),
'parent_item_colon' => __( 'Eltern Projekt:', 'spielgarten' ),
'all_items' => __( 'Alle Projekte', 'spielgarten' ),
'add_new_item' => __( 'Projekt erstellen', 'spielgarten' ),
'add_new' => __( 'Erstellen', 'spielgarten' ),
'new_item' => __( 'Projekt erstellen', 'spielgarten' ),
'edit_item' => __( 'Bearbeite Projekt', 'spielgarten' ),
'update_item' => __( 'Aktualisiere Projekt', 'spielgarten' ),
'view_item' => __( 'Projekt anschauen', 'spielgarten' ),
'view_items' => __( 'Projekte anschauen', 'spielgarten' ),
'search_items' => __( 'Suche Projekt', 'spielgarten' ),
'not_found' => __( 'Keine Projekte gefunden.', 'spielgarten' ),
'not_found_in_trash' => __( 'Keine Projekte im Papierkorb gefunden.', 'spielgarten' ),
'featured_image' => __( 'Beitragsbild', 'spielgarten' ),
'set_featured_image' => __( 'Beitragsbild festlegen', 'spielgarten' ),
'remove_featured_image' => __( 'Beitragsbild entfernen', 'spielgarten' ),
'use_featured_image' => __( 'Als Beitragsbild verwenden', 'spielgarten' ),
'insert_into_item' => __( 'In Projekt einfügen', 'spielgarten' ),
'uploaded_to_this_item' => __( 'Zu diesem Projekt hochgeladen', 'spielgarten' ),
'items_list' => __( 'Projekte Liste', 'spielgarten' ),
'items_list_navigation' => __( 'Projekte Liste Navigation', 'spielgarten' ),
'filter_items_list' => __( 'Filter Projekte Liste', 'spielgarten' ),
'item_published' => __( 'Projekt veröffentlicht', 'spielgarten' ),
'item_published_privately' => __( 'Projekt privat veröffentlicht', 'spielgarten' ),
'item_reverted_to_draft' => __( 'Projekt als Entwurf gespeichert', 'spielgarten' ),
'item_scheduled' => __( 'Projekt geplant', 'spielgarten' ),
'item_updated' => __( 'Projekt aktualisiert', 'spielgarten' ),
);
$args = array(
'label' => __( 'Projekt', 'spielgarten' ),
'description' => __( '', 'spielgarten' ),
'labels' => $labels,
'menu_icon' => 'dashicons-index-card',
'supports' => array('title', 'custom-fields'),
'taxonomies' => array(),
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'menu_position' => 5,
'show_in_admin_bar' => true,
'show_in_nav_menus' => true,
'can_export' => true,
'has_archive' => false,
'hierarchical' => false,
'exclude_from_search' => false,
'show_in_rest' => true,
'publicly_queryable' => false,
'capability_type' => 'post',
);
register_post_type( 'projekt', $args );

}
add_action( 'init', 'create_projekt_cpt', 0 );

// Register Taxonomy Kategorie
function create_kategorie_tax() {

$labels = array(
'name' => _x( 'Kategorien', 'taxonomy general name', 'spielgarten' ),
'singular_name' => _x( 'Kategorie', 'taxonomy singular name', 'spielgarten' ),
'search_items' => __( 'Suche Kategorien', 'spielgarten' ),
'all_items' => __( 'Alle Kategorien', 'spielgarten' ),
'parent_item' => __( 'Eltern Kategorie', 'spielgarten' ),
'parent_item_colon' => __( 'Eltern Kategorie:', 'spielgarten' ),
'edit_item' => __( 'Bearbeite Kategorie', 'spielgarten' ),
'update_item' => __( 'Aktualisiere Kategorie', 'spielgarten' ),
'add_new_item' => __( 'Kategorie hinzufügen', 'spielgarten' ),
'new_item_name' => __( 'Neuer Kategorie Name', 'spielgarten' ),
'menu_name' => __( 'Kategorie', 'spielgarten' ),
);
$args = array(
'labels' => $labels,
'description' => __( '', 'spielgarten' ),
'hierarchical' => true,
'public' => true,
'publicly_queryable' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'show_tagcloud' => true,
'show_in_quick_edit' => true,
'show_admin_column' => false,
'show_in_rest' => true,
'meta_box_cb' => 'drop_cat',
);
register_taxonomy( 'kategorie', array('projekt'), $args );

}
add_action( 'init', 'create_kategorie_tax' );

 function drop_cat( $post, $box ) {
 $defaults = array('taxonomy' => 'category');
 if ( !isset($box['args']) || !is_array($box['args']) )
 $args = array();
 else
 $args = $box['args'];
 extract( wp_parse_args($args, $defaults), EXTR_SKIP );
 $tax = get_taxonomy($taxonomy);
 ?>
<div id="taxonomy-<?php echo $taxonomy; ?>" class="acf-taxonomy-field categorydiv">

	<?php 
	$name = ( $taxonomy == 'category' ) ? 'post_category' : 'tax_input[' . $taxonomy . ']';
	echo "<input type='hidden' name='{$name}[]' value='0' />"; // Allows for an empty term set to be sent. 0 is an invalid Term ID and will be ignored by empty() checks.
	?>
	<? $term_obj = wp_get_object_terms($post->ID, $taxonomy ); //_log($term_obj[0]->term_id)?>
	<ul id="<?php echo $taxonomy; ?>checklist" data-wp-lists="list:<?php echo $taxonomy?>"
		class="categorychecklist form-no-clear">
		<?php //wp_terms_checklist($post->ID, array( 'taxonomy' => $taxonomy) ) ?>
	</ul>

	<?php wp_dropdown_categories( array( 'taxonomy' => $taxonomy, 'hide_empty' => 0, 'name' => "{$name}[]", 'selected' => $term_obj[0]->term_id, 'orderby' => 'name', 'hierarchical' => 0, 'show_option_none' => '&mdash;' ) ); ?>

</div>
<?php
    }
