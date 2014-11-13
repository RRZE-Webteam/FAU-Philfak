<?php
/**
 * Navigation Menu template functions
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */


function add_has_children_to_nav_items( $items ) {
    $parents = wp_list_pluck( $items, 'menu_item_parent');
    $out     = array ();

    foreach ( $items as $item )
    {
        in_array( $item->ID, $parents ) && $item->classes[] = 'has-sub';
        $out[] = $item;
    }
    return $items;
}
add_filter( 'wp_nav_menu_objects', 'add_has_children_to_nav_items' );


function fau_get_menu_name($location){
	if(!has_nav_menu($location)) return false;
	$menus = get_nav_menu_locations();
	$menu_title = wp_get_nav_menu_object($menus[$location])->name;
	return $menu_title;
}



function get_top_parent_page_id($id, $offset = FALSE) {

	if( ! $offset) $offset = 2;
	$parents = get_post_ancestors( $id );
	return ($parents) ? $parents[count($parents)-$offset]: $id;

}

class Walker_Main_Menu extends Walker_Nav_Menu
{
	private $currentID;

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$level = $depth + 2;		
		$output .= $indent.'<div class="nav-flyout"><div class="container"><div class="row"><div class="span4"><ul class="sub-menu level'.$level.'">';
	}
	
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		global $options;
		
		$indent = str_repeat("\t", $depth);
		$output .= $indent.'</ul>';
		$output .= '<a href="'.get_permalink($this->currentID).'" class="button-portal">';
		if (isset($options['menu_pretitle_portal']) && $options['menu_pretitle_portal']) {
		    $output .=  $options['menu_pretitle_portal'].' ';
		}
		$output .= get_the_title($this->currentID);
		if (isset($options['menu_aftertitle_portal']) && $options['menu_aftertitle_portal']) {
		    $output .=  ' '.$options['menu_aftertitle_portal'];
		}
		$output .= '</a>';
		$output .= '</div>';
				
		$output .= '<div class="span4 hide-mobile">';
		    if ( function_exists('get_field') ) {
			$quote = get_field('zitat_text', $this->currentID);
			$author = get_field('zitat_autor', $this->currentID);
			
			if($quote) {
				$output .= '<blockquote>';
					$output .= '<p class="quote">'.$quote.'</p>';
					if($author) $output .= '<p class="author"> &mdash; '.$author.'</p>';
				$output .= '</blockquote>';
			}
		    }

		$output .= '</div>';
		
		$output .= '<div class="span4 hide-mobile">';
			$output .= get_the_post_thumbnail($this->currentID, array(370,185));
		$output .= '</div>';	
		
		$output .= '</div></div></div>';
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

		if($level == 1) $this->currentID = $item->object_id;		
		
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
