<?php
/**
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

require_once('functions/bootstrap.php');
require_once('functions/shortcodes.php');
require_once('functions/menu-helpers.php');
require_once('functions/menu-main.php');


/**
 * Sets up theme defaults and registers the various WordPress features that
 * FAU supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since FAU 1.0
 *
 * @return void
 */

/**
 * Sets up the content width value based on the theme's design.
 */
if ( ! isset( $content_width ) )
	$content_width = 770;

function fau_setup() {
	/*
	 * Makes FAU available for translation.
	 *
	 */
	load_theme_textdomain( 'fau', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
//	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

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
	register_nav_menu( 'meta', __( 'Meta-Navigation oben', 'fau' ) );
	register_nav_menu( 'meta-footer', __( 'Meta-Navigation unten', 'fau' ) );
	register_nav_menu( 'main-menu', __( 'Haupt-Navigation', 'fau' ) );
	register_nav_menu( 'quicklinks-1', __( 'Quicklinks 1', 'fau' ) );
	register_nav_menu( 'quicklinks-2', __( 'Quicklinks 2', 'fau' ) );
	register_nav_menu( 'quicklinks-3', __( 'Quicklinks 3', 'fau' ) );
	register_nav_menu( 'quicklinks-4', __( 'Quicklinks 4', 'fau' ) );
	
	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 150, false );

	add_image_size( 'hero', 1260, 350, true);
	add_image_size( 'page-thumb', 220, 110, true);
	add_image_size( 'post-thumb', 220, 110, true);
	add_image_size( 'person-thumb', 300, 150, true);
	add_image_size( 'topevent-thumb', 140, 90, true); 
	add_image_size( 'logo-thumb', 140, 110, true);
	
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
 * Add theme options page
 *
 * @since FAU 1.0
 *
 * @return void
 */ 
function theme_options_init() {
	register_setting('fau_options', 'fau_theme_options', 'fau_validate_options');
}
add_action( 'admin_init', 'theme_options_init');

function theme_options_add_page() {
	add_theme_page('Optionen', 'Optionen', 'edit_theme_options', 'theme-optionen', 'fau_theme_options_page' );
}
add_action( 'admin_menu', 'theme_options_add_page');

function fau_theme_options_page() {
	global $select_options, $radio_options;
	
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false; ?>

	<div class="wrap"> 
	<?php screen_icon(); ?><h2>Theme-Optionen für <?php bloginfo('name'); ?></h2> 

	<?php if ( false !== $_REQUEST['settings-updated'] ) : ?> 
		<div class="updated fade">
		<p><strong>Einstellungen gespeichert!</strong></p>
		</div>
	<?php endif; ?>

	<form method="post" action="options.php">
		<?php settings_fields( 'fau_options' ); ?>
	<?php $options = get_option( 'fau_theme_options' ); ?>

	<table class="form-table">
		<tr valign="top">
			<th scope="row">Startseite: Anzahl der Slides im Header</th>
			<td><input id="fau_theme_options[start_header_count]" class="regular-text" type="text" name="fau_theme_options[start_header_count]" value="<?php esc_attr_e( $options['start_header_count'] ); ?>" /></td>
		</tr>  
		<tr valign="top">
			<th scope="row">Startseite: Anzahl der News</th>
			<td><input id="fau_theme_options[start_news_count]" class="regular-text" type="text" name="fau_theme_options[start_news_count]" value="<?php esc_attr_e( $options['start_news_count'] ); ?>" /></td>
		</tr>
	</table>

	<!-- submit -->
	<p class="submit"><input type="submit" class="button-primary" value="Einstellungen speichern" /></p>
	</form>
	</div>
	<?php
}

function fau_validate_options($input) {
	return $input;
}



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
 * Registers our main widget area and the front page widget areas.
 *
 * @since FAU 1.0
 */
function fau_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar rechts', 'fau' ),
		'id' => 'sidebar-right',
		'description' => __( 'Erscheint allen Seiten rechts', 'fau' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h2 class="small">',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Portal-Menü der Unterseiten', 'fau' ),
		'id' => 'menu-subpages',
		'description' => __( 'Das bebilderte Menü der Unterseiten', 'fau' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => __( 'Subnavigation links', 'fau' ),
		'id' => 'menu-subnav',
		'description' => __( 'Die Subnavigation im linken Bereich der Seite', 'fau' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => __( 'Bannerbereich', 'fau' ),
		'id' => 'banner-area',
		'description' => __( 'Der Bannerbereich unterhalb des Portal-Menüs auf der Startseite', 'fau' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => __( 'Social-Media', 'fau' ),
		'id' => 'social-media',
		'description' => __( 'Der Social-Media-Bereich', 'fau' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => __( 'Bannerwerbung rechts', 'fau' ),
		'id' => 'banner-ad-right',
		'description' => __( 'Das Werbebanner rechts', 'fau' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	));
	
	register_sidebar( array(
		'name' => __( 'Sprachwechsler', 'fau' ),
		'id' => 'language-switcher',
		'description' => __( 'Sprachwechsler im Header der Seite', 'fau' ),
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );

}
add_action( 'widgets_init', 'fau_widgets_init' );


