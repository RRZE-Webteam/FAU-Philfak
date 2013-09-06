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
		add_shortcode('subpages', array( $this, 'fau_subpages' ));    
		add_shortcode('subpages_item', array( $this, 'fau_subpages_item' ));
	}

	function fau_subpages( $atts, $content = null ) {
		return '<div class="row">' . do_shortcode( $content ) . '</div>';
	}
	
	function fau_subpages_item( $atts, $content = null) {
		extract(shortcode_atts(array(
			"id" => 'id'
			), $atts));
			
		$post = get_post($id);
		
		$return = '';
		
		$return .= '<div class="span3">';
			$return .= '<a class="subpage-item" href="'.get_permalink($id).'">';
			
				if(has_post_thumbnail($id))
				{
					$return .= get_the_post_thumbnail($id, array(300,150));
				}
				
				$return .= '<h3>'.$post->post_title.'</h3>';
				
			$return .= '</a>';
		$return .= '</div>';

		return $return;
	}
}

new FAUShortcodes();

?>