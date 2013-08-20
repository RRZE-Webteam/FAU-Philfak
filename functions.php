<?php
/**
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function fau_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
//	load_theme_textdomain( 'fau', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
//	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
//	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
//	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
//	add_theme_support( 'post-formats', array(
//		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
//	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'meta', __( 'Meta', 'fau' ) );
	register_nav_menu( 'main-menu', __( 'Main Menu', 'fau' ) );
	
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
//	add_theme_support( 'post-thumbnails' );
//	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
//	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'fau_setup' );


/**
 * Enqueues scripts and styles for front end.
 *
 * @since FAU 1.0
 *
 * @return void
 */
function fau_scripts_styles() {
	
	wp_enqueue_style( 'fau-style', get_stylesheet_uri(), array(), '2013-08-19' );
	
	wp_enqueue_script( 'fau-libs-jquery', get_template_directory_uri() . '/js/libs/jquery-1.8.2.min.js', array(), '1.0', true );
	wp_enqueue_script( 'fau-libs-plugins', get_template_directory_uri() . '/js/libs/plugins.js', array(), '1.0', true );
	wp_enqueue_script( 'fau-scripts', get_template_directory_uri() . '/js/scripts.js', array(), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'fau_scripts_styles' );


/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since FAU 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function fau_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'fau' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'fau_wp_title', 10, 2 );


/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses twentythirteen_header_style() to style front-end.
 * @uses register_default_headers() to set up the bundled header images.
 *
 * @since FAU 1.0
 */
function fau_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-image'          => '%s/images/headers/circle.png',

		// Set height and width, with a maximum value for the width.
		'height'                 => 85,
		'width'                  => 315,

		// Callbacks for styling the header and the admin preview.
	'admin-head-callback'    => 'fau_admin_header_style',
	);

	add_theme_support( 'custom-header', $args );

	/*
	 * Default custom headers packaged with the theme.
	 * %s is a placeholder for the theme template directory URI.
	 */
	register_default_headers( array(
		'fau' => array(
			'url'           => '%s/img/logo-fau.png',
			'thumbnail_url' => '%s/img/logo-fau.png',
			'description'   => _x( 'FAU', 'header image description', 'fau' )
		),
		'fak-med' => array(
			'url'           => '%s/img/logo-fak-med.png',
			'thumbnail_url' => '%s/img/logo-fak-med.png',
			'description'   => _x( 'FAKMED', 'header image description', 'fau' )
		),
		'fak-nat' => array(
			'url'           => '%s/img/logo-fak-nat.png',
			'thumbnail_url' => '%s/img/logo-fak-nat.png',
			'description'   => _x( 'FAKNAT', 'header image description', 'fau' )
		),
		'fak-phil' => array(
			'url'           => '%s/img/logo-fak-phil.png',
			'thumbnail_url' => '%s/img/logo-fak-phil.png',
			'description'   => _x( 'FAKPHIL', 'header image description', 'fau' )
		),
		'fak-rechtswiwi' => array(
			'url'           => '%s/img/logo-fak-rechtswiwi.png',
			'thumbnail_url' => '%s/img/logo-fak-rechtswiwi.png',
			'description'   => _x( 'FAKRECHTSWIWI', 'header image description', 'fau' )
		),
		'fak-tech' => array(
			'url'           => '%s/img/logo-fak-tech.png',
			'thumbnail_url' => '%s/img/logo-fak-tech.png',
			'description'   => _x( 'FAKTECH', 'header image description', 'fau' )
		),
	) );
}
add_action( 'after_setup_theme', 'fau_custom_header_setup' );


/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since Twenty Thirteen 1.0
 */
function fau_admin_header_style() {
	$header_image = get_header_image();
?>
	<style type="text/css" id="twentythirteen-admin-header-css">
	#headimg .home-link {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 1040px;
		<?php
		if ( ! empty( $header_image ) || display_header_text() ) {
			echo 'min-height: 230px;';
		} ?>
		width: 100%;
	}
	#headimg h1,
	#headimg h2,
	.displaying-header-text {
		display: none
	}
	
	</style>
<?php
}



/**
 * Navigation Menu template functions
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

class Walker_Main_Menu extends Walker_Nav_Menu
{

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$level = $depth + 2;
		$output .= "\n$indent<div class=\"nav-flyout\"><div class=\"container\"><div class=\"row\"><div class=\"span4\"><ul class=\"sub-menu level".$level."\">\n";
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul></div></div></div></div>\n";
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$level = $depth + 1;

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'level' . $level;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

