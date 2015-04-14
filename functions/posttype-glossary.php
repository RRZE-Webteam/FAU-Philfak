<?php
if ( ! function_exists( 'glossary_taxonomy' ) ) :
function glossary_taxonomy() {
	register_taxonomy(
		'glossary_category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'glossary',   		 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 			=> __('Glossar-Kategorien', 'fau'),  //Display name
			'query_var' 		=> true,
			'rewrite'			=> array(
					'slug' 			=> 'glossaries', // This controls the base slug that will display before each term
					'with_front' 	=> false // Don't display the category base before
					)
			)
		);
}
endif;
add_action( 'init', 'glossary_taxonomy');



// Register Custom Post Type
if ( ! function_exists( 'glossary_post_type' ) ) :

function glossary_post_type() {	
	
	$labels = array(
		'name'                => _x( 'Glossar-Einträge', 'Post Type General Name', 'fau' ),
		'singular_name'       => _x( 'Glossar-Eintrag', 'Post Type Singular Name', 'fau' ),
		'menu_name'           => __( 'Glossar', 'fau' ),
		'parent_item_colon'   => __( 'Übergeordneter Glossar-Eintrag', 'fau' ),
		'all_items'           => __( 'Alle Glossar-Einträge', 'fau' ),
		'view_item'           => __( 'Eintrag anzeigen', 'fau' ),
		'add_new_item'        => __( 'Glossar-Eintrag hinzufügen', 'fau' ),
		'add_new'             => __( 'Neuer Glossar-Eintrag', 'fau' ),
		'edit_item'           => __( 'Eintrag bearbeiten', 'fau' ),
		'update_item'         => __( 'Eintrag aktualisieren', 'fau' ),
		'search_items'        => __( 'Glossar-Eintrag suchen', 'fau' ),
		'not_found'           => __( 'Keine Glossar-Einträge gefunden', 'fau' ),
		'not_found_in_trash'  => __( 'Keine Glossar-Einträge im Papierkorb gefunden', 'fau' ),
	);
	$rewrite = array(
		'slug'                => 'glossary',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'glossar', 'fau' ),
		'description'         => __( 'Glossar-Informationen', 'fau' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor' ),
		'taxonomies'          => array( 'glossary_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_icon'		=> 'dashicons-editor-help',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'query_var'           => 'glossary',
		'rewrite'             => $rewrite,
		/* 'capability_type'     => 'glossary',
		'capabilities' => array(
		    'edit_post' => 'edit_glossary',
		    'read_post' => 'read_glossary',
		    'delete_post' => 'delete_glossary',
		    'edit_posts' => 'edit_glossarys',
		    'edit_others_posts' => 'edit_others_glossarys',
		    'publish_posts' => 'publish_glossarys',
		    'read_private_posts' => 'read_private_glossarys',
		    'delete_posts' => 'delete_glossarys',
		    'delete_private_posts' => 'delete_private_glossarys',
		    'delete_published_posts' => 'delete_published_glossarys',
		    'delete_others_posts' => 'delete_others_glossarys',
		    'edit_private_posts' => 'edit_private_glossarys',
		    'edit_published_posts' => 'edit_published_glossarys'
		),
		'map_meta_cap' => true */
	);
	register_post_type( 'glossary', $args );

}
endif;
// Hook into the 'init' action
add_action( 'init', 'glossary_post_type', 0 );

if ( ! function_exists( 'glossary_restrict_manage_posts' ) ) :

function glossary_restrict_manage_posts() {
	global $typenow;

	if( $typenow == "glossary" ){
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
endif;
add_action( 'restrict_manage_posts', 'glossary_restrict_manage_posts' );

if ( ! function_exists( 'glossary_post_types_admin_order' ) ) :

function glossary_post_types_admin_order( $wp_query ) {
	if (is_admin()) {

		$post_type = $wp_query->query['post_type'];

		if ( $post_type == 'glossary') {

			if( ! isset($wp_query->query['orderby']))
			{
				$wp_query->set('orderby', 'title');
				$wp_query->set('order', 'ASC');
			}

		}
	}
}
endif;
add_filter('pre_get_posts', 'glossary_post_types_admin_order');


/* Moving old ACF-Field "description" to normal content, if still in use */
if ( ! function_exists( 'prefill_desc_byoldversion' ) ) :

function prefill_desc_byoldversion($content) {
    global $post;

    if ( empty( $content ) && ($post && $post->post_type == "glossary" )) {
	   $default_content = get_post_meta( $post->ID, 'description', true );
	   return $default_content;
    }
    return $content;
}
endif;
add_filter('the_editor_content', 'prefill_desc_byoldversion');



if ( ! function_exists( 'fau_glossar_metabox' ) ) :

function fau_glossar_metabox() {
    add_meta_box(
        'fau_glossar_metabox',
        __( 'Nutzungshinweise', 'fau' ),
        'fau_glossar_metabox_content',
        'glossary',
        'normal',
        'high'
    );
}
endif;

if ( ! function_exists( 'fau_glossar_metabox_content' ) ) :
function fau_glossar_metabox_content( $object, $box ) { 
    global $post;

   
    if ($post->ID >0) {
	$helpuse = __('<p>Einbindung in Seiten und Beiträgen via: </p>','fau');
	
	$helpuse .= '<ul><li>Einzelbeiträge:';
	$helpuse .= '<pre> [glossary id="'.$post->ID.'"] </pre>';
	$helpuse .= 'Inklusive der optionalen Parameter: color="<i>Fakultät</i>", wobei <i>Fakultät</i> folgende Werte haben kann: techfak, natfak, rwfak, medfak, philfak.';
	$helpuse .= '</li>';
	$helpuse .= '<li>Accordion mit Kategory:';
	$helpuse .= '<pre> [glossary category="<i>Kategoryname</i>"] </pre>';
	$helpuse .= '</li>';	
	$helpuse .= '<li>Accordion mit allen Beiträgen:';
	$helpuse .= '<pre> [glossary] </pre>';
	$helpuse .= '</li></ul>';	
	
	echo $helpuse;
    }

    return;

}
endif;

add_action( 'add_meta_boxes', 'fau_glossar_metabox' );