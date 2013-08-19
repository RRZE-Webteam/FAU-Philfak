<?php
/**
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

/**
 * Enqueues scripts and styles for front end.
 *
 * @since FAU 1.0
 *
 * @return void
 */
function fau_scripts_styles() {
	
	// Loads our main stylesheet.
	wp_enqueue_style( 'fau-style', get_stylesheet_uri(), array(), '2013-08-19' );

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
