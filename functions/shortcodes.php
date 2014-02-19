<?php
/**
* @package WordPress
* @subpackage FAU
* @since FAU 1.0
*/

class FAUShortcodes {

	function __construct() {
		remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'wpautop' , 12);
		add_action( 'init', array( $this, 'add_shortcodes' ) ); 
	}

	function add_shortcodes() {
		add_shortcode('synonym', array( $this, 'fau_synonym' ));    
	}

	function fau_subpages( $atts, $content = null ) {
		return '<div class="row">' . do_shortcode( $content ) . '</div>';
	}
	
	function fau_synonym( $atts, $content = null) {
		extract(shortcode_atts(array(
			"slug" => 'slug'
			), $atts));
			
		$post = get_posts(array('name' => $slug, 'post_type' => 'synonym', 'post_status' => 'publish', 'numberposts' => 1));
		$id = $post[0]->ID;
		
		$return = get_field('synonym', $id);
		
		return $return;
	}
}

new FAUShortcodes();

?>