<?php
/**
* @package WordPress
* @subpackage FAU
* @since FAU 1.0
*/


/**
 * Navigation Menu template functions
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */


function add_has_children_to_nav_items( $items )
{
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
	return ($parents) ? $parents[count($parents)-$offset]: $id;
/*
	$parents = get_post_ancestors( $id );
	if ($parents)  {	    
	    return $parents;  
	} else {
	    return $id;
	}
	*/
	
	
/*
    $post = get_post($id);
 
    $ancestors = $post->ancestors;
 
    // Check if page is a child page (any level)
    if ($ancestors) {
 
		array_pop($ancestors);

        //  Grab the ID of top-level page from the tree
        return end($ancestors);
 
    } else {
 
        // Page is the top level, so use  it's own id
        return $post->ID;
 
    }
 */
}

?>