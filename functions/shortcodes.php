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
		add_shortcode('assistant', array( $this, 'fau_assistant' ));
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
	
	function fau_assistant( $atts, $content = null) {
		extract(shortcode_atts(array(
			"id" => 'id'
			), $atts));
			
		$return = '';
		
		$return .= '<div class="accordion">';

		$pages = get_pages(array('sort_order' => 'ASC', 'sort_column' => 'menu_order', 'parent' => $id, 'hierarchical' => 0));
		$i = 0;
		foreach($pages as $page)
		{
			$return .= '<div class="accordion-group">';
				$return .= '<div class="accordion-heading">';
					$return .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="accordion-" href="#collapse-'.$i.'">'.$page->post_title.'</a>';
				$return .= '</div>';
				$return .= '<div id="collapse-'.$i.'" class="accordion-body">';
					$return .= '<div class="accordion-inner">';
						
						$return .= '<div class="assistant-tabs">';
						
							$subpages = get_pages(array('sort_order' => 'ASC', 'sort_column' => 'menu_order', 'parent' => $page->ID, 'hierarchical' => 0));
							
							$return .= '<ul class="assistant-tabs-nav">';
						
							$j = 0;
							foreach($subpages as $subpage)
							{
								if($j == 0) $class = 'active';
								else $class = '';
								
								$return .= '<li><a href="#accordion-'.$i.'-tab-'.$j.'" class="'.$class.'">'.$subpage->post_title.'</a></li>';
								$j++;
							}
						
							$return .= '</ul>';
						
							$j = 0;
							foreach($subpages as $subpage)
							{
								if($j == 0) $class = 'assistant-tab-pane-active';
								else $class = '';
								
								$return .= '<div class="assistant-tab-pane '.$class.'" id="accordion-'.$i.'-tab-'.$j.'">';
									$return .= '<p>'.$subpage->post_content.'</p>';
								$return .= '</div>';
								
								$j++;
							}
							
						$return .= '</div>';
						
					$return .= '</div>';
				$return .= '</div>';
			$return .= '</div>';
			
			$i++;
		}
		
		
		$return .= '</div>';
		
		return $return;
	}
}

new FAUShortcodes();

?>