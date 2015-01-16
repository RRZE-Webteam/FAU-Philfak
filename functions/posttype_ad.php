<?php

/* 
 * Code fuer den Custom Type "ad" / Werbebanner
 */


function ads_taxonomy() {
	register_taxonomy(
		'ads_category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'ad',   		 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 		=> __('Werbe-Kategorien', 'fau'),  //Display name
			'query_var' 		=> true,
			'rewrite'		=> array(
					'slug' 		=> 'ads', // This controls the base slug that will display before each term
					'with_front' 	=> false // Don't display the category base before
					)
			)
		);
}
if ( current_user_can('publish_pages') ) {
    add_action( 'init', 'ads_taxonomy');
}

// Register Custom Post Type
function ad_post_type() {
	
	$labels = array(
		'name'                => _x( 'Werbebanner2', 'Post Type General Name', 'fau' ),
		'singular_name'       => _x( 'Werbebanner', 'Post Type Singular Name', 'fau' ),
		'menu_name'           => __( 'Werbebanner', 'fau' ),
		'parent_item_colon'   => __( 'Übergeordneter Werbebanner', 'fau' ),
		'all_items'           => __( 'Alle Werbebanner', 'fau' ),
		'view_item'           => __( 'Werbebanner anzeigen', 'fau' ),
		'add_new_item'        => __( 'Neues Werbebanner einfügen', 'fau' ),
		'add_new'             => __( 'Neues Werbebanner', 'fau' ),
		'edit_item'           => __( 'Werbebanner bearbeiten', 'fau' ),
		'update_item'         => __( 'Werbebanner aktualisieren', 'fau' ),
		'search_items'        => __( 'Werbebanner suchen', 'fau' ),
		'not_found'           => __( 'Keine Werbebanner gefunden', 'fau' ),
		'not_found_in_trash'  => __( 'Keine Werbebanner im Papierkorb gefunden', 'fau' ),
	);
	$rewrite = array(
		'slug'                => 'ad',
		'with_front'          => true,
		'pages'               => false,
		'feeds'               => false,
	);
	$args = array(
		'label'               => __( 'werbebanner2', 'fau' ),
		'description'         => __( 'Werbebanner', 'fau' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', ),
		'taxonomies'          => array( 'ads_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'query_var'           => 'ad',
		'rewrite'             => $rewrite,
		'capability_type'     => 'ad',
		'capabilities' => array(
		    'edit_post' => 'edit_ad',
		    'read_post' => 'read_ad',
		    'delete_post' => 'delete_ad',
		    'edit_posts' => 'edit_ads',
		    'edit_others_posts' => 'edit_others_ads',
		    'publish_posts' => 'publish_ads',
		    'read_private_posts' => 'read_private_ads',
		    'delete_posts' => 'delete_ads',
		    'delete_private_posts' => 'delete_private_ads',
		    'delete_published_posts' => 'delete_published_ads',
		    'delete_others_posts' => 'delete_others_ads',
		    'edit_private_posts' => 'edit_private_ads',
		    'edit_published_posts' => 'edit_published_ads'
		),
		'map_meta_cap' => true
	);
	register_post_type( 'ad', $args );

}

// Hook into the 'init' action
if ( current_user_can('publish_pages') ) {
    add_action( 'init', 'ad_post_type', 0 );
}

function ad_restrict_manage_posts() {
	global $typenow;

	if( $typenow == "ad" ){
		$filters = get_object_taxonomies($typenow);
		
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			wp_dropdown_categories(array(
                'show_option_all' => sprintf(__('Alle %s anzeigen', 'fau'), $tax_obj->label),
                'taxonomy' => $tax_slug,
                'name' => $tax_obj->name,
                'orderby' => 'name',
                'selected' => isset($_GET[$tax_slug]) ? $_GET[$tax_slug] : '',
                'hierarchical' => $tax_obj->hierarchical,
                'show_count' => true,
                'hide_if_empty' => true
            ));
		}

	}
}
add_action( 'restrict_manage_posts', 'ad_restrict_manage_posts' );


function ad_post_types_admin_order( $wp_query ) {
	if (is_admin()) {

		$post_type = $wp_query->query['post_type'];

		if ( $post_type == 'ad') {
		    if( ! isset($wp_query->query['orderby']))	{
				$wp_query->set('orderby', 'title');
				$wp_query->set('order', 'ASC');
			}

		}
	}
}
add_filter('pre_get_posts', 'ad_post_types_admin_order');



function fau_get_ad($type, $withhr = true) {
    global $options;
    global $post;
    
    // werbebanner_seitlich   oder     werbebanner_unten
   $list = get_post_meta( $post->ID, $type, true );
   $class = '';  
   
   if ($type == 'werbebanner_unten') {
	$class = 'banner-ad-footer';
   } else {
        $class = 'banner-ad-right';
   }
   $out = '';
   
   if ((isset($list)) && (!empty($list))) {
       if (!is_array($list)) {
	    $val = $list;
	    $list = array();
	    $list[0] = $val;
       } 
       
       if ($withhr) {
	   $out .= "<hr>\n";
       }
       
       $out .= '<div class="'.$class.'">';
       foreach ($list as $id) {

	    $out .= '<div class="banner-ad">';	    
	    if (isset($options['url_banner-ad-notice'])) {
		$out .= '<a class="banner-ad-notice" href="'.$options['url_banner-ad-notice'].'">';
	    }
	    $out .= $options['title_banner-ad-notice'];
	    if (isset($options['url_banner-ad-notice'])) {
		  $out .= '</a>';
	    }
   		
	    $scriptcode = get_post_meta( $id, 'ad_script', true );
	    
	    if(isset($scriptcode)) {
		$out .=  html_entity_decode($scriptcode);
	    } else  {
		$link =    get_post_meta( $id, 'link', true ); 
		if($link) {
		    $out .=  '<a href="'.get_field('link', $id).'">';
		}
		$out .=  get_the_post_thumbnail($id, 'full');
		if($link) {
		    $out .=  '</a>';
		}
				
	    }
	    $out .= '</div>';

       }
       $out .= '</div>';
       return $out;

   }
   
}
