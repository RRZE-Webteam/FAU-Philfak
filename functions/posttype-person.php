<?php

if ( ! function_exists( 'persons_taxonomy' ) ) :
function persons_taxonomy() {
	register_taxonomy(
		'persons_category',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
		'person',   		 //post type name
		array(
			'hierarchical' 		=> true,
			'label' 		=> __('Personen-Kategorien', 'fau'),  //Display name
			'query_var' 		=> true,
			'rewrite'		=> array(
			    'slug' 			=> 'persons', // This controls the base slug that will display before each term
			    'with_front' 	=> false // Don't display the category base before
			    )
			)
		);
}
endif;
add_action( 'init', 'persons_taxonomy');


// Register Custom Post Type
if ( ! function_exists( 'person_post_type' ) ) :
function person_post_type() {	
	
	$labels = array(
		'name'                => _x( 'Personen', 'Post Type General Name', 'fau' ),
		'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'fau' ),
		'menu_name'           => __( 'Personen', 'fau' ),
		'parent_item_colon'   => __( 'Übergeordnete Person', 'fau' ),
		'all_items'           => __( 'Alle Personen', 'fau' ),
		'view_item'           => __( 'Person ansehen', 'fau' ),
		'add_new_item'        => __( 'Person hinzufügen', 'fau' ),
		'add_new'             => __( 'Neue Person', 'fau' ),
		'edit_item'           => __( 'Person bearbeiten', 'fau' ),
		'update_item'         => __( 'Person aktualisieren', 'fau' ),
		'search_items'        => __( 'Personen suchen', 'fau' ),
		'not_found'           => __( 'Keine Personen gefunden', 'fau' ),
		'not_found_in_trash'  => __( 'Keine Personen in Papierkorb gefunden', 'fau' ),
	);
	$rewrite = array(
		'slug'                => 'person',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'person', 'fau' ),
		'description'         => __( 'Personeninformationen', 'fau' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'taxonomies'          => array( 'persons_category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_icon'		=> 'dashicons-id-alt',

		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'person',
		'rewrite'             => $rewrite,
		/* 'capability_type'     => 'person',
		'capabilities' => array(
            'edit_post' => 'edit_person',
            'read_post' => 'read_person',
            'delete_post' => 'delete_person',
            'edit_posts' => 'edit_persons',
            'edit_others_posts' => 'edit_others_persons',
            'publish_posts' => 'publish_persons',
            'read_private_posts' => 'read_private_persons',
            'delete_posts' => 'delete_persons',
            'delete_private_posts' => 'delete_private_persons',
            'delete_published_posts' => 'delete_published_persons',
            'delete_others_posts' => 'delete_others_persons',
            'edit_private_posts' => 'edit_private_persons',
            'edit_published_posts' => 'edit_published_persons'
		),
		'map_meta_cap' => true
		  */

	);
	register_post_type( 'person', $args );

}
endif;
// Hook into the 'init' action
add_action( 'init', 'person_post_type', 0 );

if ( ! function_exists( 'person_restrict_manage_posts' ) ) :
function person_restrict_manage_posts() {
	global $typenow;

	if( $typenow == "person" ){
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
add_action( 'restrict_manage_posts', 'person_restrict_manage_posts' );


if ( ! function_exists( 'person_post_types_admin_order' ) ) :
function person_post_types_admin_order( $wp_query ) {
	if (is_admin()) {

		$post_type = $wp_query->query['post_type'];

		if ( $post_type == 'person') {

			if( ! isset($wp_query->query['orderby']))
			{
				$wp_query->set('orderby', 'title');
				$wp_query->set('order', 'ASC');
			}

		}
	}
}
endif;
add_filter('pre_get_posts', 'person_post_types_admin_order');

if ( ! function_exists( 'fau_person_metabox' ) ) :
function fau_person_metabox() {
    add_meta_box(
        'fau_person_metabox',
        __( 'Eigenschaften', 'fau' ),
        'fau_person_metabox_content',
        'person',
        'normal',
        'high'
    );
}
endif;
if ( ! function_exists( 'fau_person_metabox_content' ) ) :
function fau_person_metabox_content( $object, $box ) { 
    global $defaultoptions;
    global $post;

	
    wp_nonce_field( basename( __FILE__ ), 'fau_person_metabox_content_nonce' ); 

    if ( !current_user_can( 'edit_page', $object->ID) )
	    // Oder sollten wir nach publish_pages  fragen? 
	    // oder nach der Rolle? vgl. http://docs.appthemes.com/tutorials/wordpress-check-user-role-function/ 
	return;

    
	
        $institution  = get_post_meta( $object->ID, 'institution', true );			
	fau_form_text('institution', $institution, __('Institution oder Abteilung','fau'), __('Geben Sie hier den Namen der Abteilung oder der Institution an, zu der die Person gehört.','fau'));
	
        $title  = get_post_meta( $object->ID, 'title', true );		
	fau_form_text('title', $title, __('Akademischer Titel','fau'), __('Akademischer Titel, der vor den Namen geführt wird.','fau'),'',10);

        $title_suffix  = get_post_meta( $object->ID, 'title_suffix', true );
	fau_form_text('title_suffix', $title_suffix, __('Titel nach Namen','fau'), __('Ergänzung oder Titel der nach dem Namen geführt wird.','fau'),'',10);

        $firstname  = get_post_meta( $object->ID, 'firstname', true );		
	fau_form_text('firstname', $firstname, __('Vorname','fau'), __('Der Vorname der Person.','fau'),'',20);

        $lastname  = get_post_meta( $object->ID, 'lastname', true );		
	fau_form_text('lastname', $lastname, __('Nachname','fau'), __('Geben Sie hier den Nachnamen ein.','fau'),'',20);		
	
	$position  = get_post_meta( $object->ID, 'position', true );		
	fau_form_text('position', $position, __('Position','fau'), __('Hier kann eine Bezeichnung für die Tätigkeit der Person oder des Kontaktes eingefügt werden.','fau'),'',40);	
	
        $phone  = get_post_meta( $object->ID, 'phone', true );		
	fau_form_text('phone', $phone, __('Telefon','fau'), __('Angabe der Telefonnummer. Bitte verwenden Sie bei Nummern aus der Uni das gerbäuchliche Format mit Leerzeichen: <br><code>09131 85-<em>nnnnn</em></code> bzw. <code>0911 5302-<em>nnn</em></code>.','fau'),'09131 85-2',14);	
	
        $fax  = get_post_meta( $object->ID, 'fax', true );		
	fau_form_text('fax', $fax, __('Telefon','fau'), __('Angabe der Faxnummer. Bitte verwenden Sie bei Nummern aus der Uni das gerbäuchliche Format mit Leerzeichen: <br><code>09131 85-<em>nnnnn</em></code> bzw. <code>0911 5302-<em>nnn</em></code>.','fau'),'09131 85-2',14);	
	
        $email  = get_post_meta( $object->ID, 'email', true );		
	fau_form_email('email', $email, __('E-Mail-Adresse','fau'), __('E-Mail-Adresse zum Kontakt.','fau'),'',40);	

        $webseite  = get_post_meta( $object->ID, 'webseite', true );		
	fau_form_url('webseite', $webseite, __('Webseite','fau'), __('URL für eine eigene Webseite.','fau'));	
	
	
        $adresse  = get_post_meta( $object->ID, 'adresse', true );		
	fau_form_textarea('adresse', $adresse, __('Post-Adresse','fau'), 60, 5, __('Geben Sie hier die Postadresse ein.','fau'));
	
	
	$raum  = get_post_meta( $object->ID, 'raum', true );		
	fau_form_text('raum', $raum, __('Raum','fau'), __('Raumnummer oder Büro.','fau'),'',20);		

        $freitext  = get_post_meta( $object->ID, 'freitext', true );	
	fau_form_wpeditor('freitext', $freitext,__('Freitext','fau'),__('Informationen oder Text zur Person bzw. zum Kontakt.'), true);

	
        $linkid  = get_post_meta( $object->ID, 'link', true );	
        $linktitle  = get_post_meta( $object->ID, 'link_title', true );	
        $linkurl  = get_post_meta( $object->ID, 'link_url', true );	
	
	if (!isset($linkid)) {
	     $linkid = url_to_postid( $linkurl );  
	} else {
	    if (empty($linktitle)) { 
		$linktitle = get_the_title($linkid );		
		if (!isset($linktitle)) { 
		    $linktitle = $linkid;
		}
	    }
	     if (empty($linkurl)) {
		$linkurl = get_permalink($linkid );
	    }
	}
	fau_form_link('link', $linktitle, $linkurl,  __('Interner Link','fau'), __('Verlinkung zu einer internen Seite mit weiteren Informationen.','fau')); 
	
	
	 
    if ($post->ID >0) {
	$helpuse = __('<p>Einbindung in Seiten und Beiträgen via: </p>','fau');
	$helpuse .= '<pre> [person id="'.$post->ID.'"] </pre>';
	if ($post->post_name) {
	    $helpuse .= ' oder <br> <pre> [person slug="'.$post->post_name.'"] </pre>';
	}
	echo $helpuse;
    }

    return;

}
endif;
add_action( 'add_meta_boxes', 'fau_person_metabox' );

if ( ! function_exists( 'fau_person_metabox_content_save' ) ) :
function fau_person_metabox_content_save( $post_id ) {
    global $options;
    if (  'person'!= get_post_type()  ) {
	return;
    }


    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;


    if ( !isset( $_POST['fau_person_metabox_content_nonce'] ) || !wp_verify_nonce( $_POST['fau_person_metabox_content_nonce'], basename( __FILE__ ) ) )
	    return $post_id;


    if ( !current_user_can( 'edit_page', $post_id ) )
    return;

    
    fau_save_standard('institution', $_POST['institution'],$post_id, 'person','text');
    fau_save_standard('title', $_POST['title'],$post_id, 'person','text');
    fau_save_standard('title_suffix', $_POST['title_suffix'],$post_id, 'person','text');
    fau_save_standard('firstname', $_POST['firstname'],$post_id, 'person','text');
    fau_save_standard('lastname', $_POST['lastname'],$post_id, 'person','text');
    fau_save_standard('position', $_POST['position'],$post_id, 'person','text');
    fau_save_standard('phone', $_POST['phone'],$post_id, 'person','text');
    fau_save_standard('fax', $_POST['fax'],$post_id, 'person','text');
    fau_save_standard('email', $_POST['email'],$post_id, 'person','email');
    fau_save_standard('webseite', $_POST['webseite'],$post_id, 'person','url');
    fau_save_standard('adresse', $_POST['adresse'],$post_id, 'person','textarea');
    fau_save_standard('raum', $_POST['raum'],$post_id, 'person','text');
    fau_save_standard('freitext', $_POST['freitext'],$post_id, 'person','wpeditor');
   

	
        $link  = get_post_meta( $post_id, 'link', true );		
        $linkurl  = get_post_meta( $post_id, 'link_url', true );		
        $linktitle  = get_post_meta( $post_id, 'link_title', true );		


    	$newurl = ( isset( $_POST['link_url'] ) ? esc_url( $_POST['link_url'] ) : 0 );
	$newid = ( isset( $_POST['link'] ) ? sanitize_key( $_POST['link'] ) : 0 );
	$newtitle = ( isset( $_POST['link_title'] ) ? sanitize_text_field( $_POST['link_title'] ) : 0 );
		
		if (!isset($newid) || ($newid <=0)) {
		    // Versuche aus der URL die ID zu ermitteln	
		    $newid = url_to_postid( $newurl );  
		} 
 

		    update_post_meta( $post_id, 'link_url', $newurl );
		    update_post_meta( $post_id, 'link_title', $newtitle );
		    update_post_meta( $post_id, 'link', $newid );	

}
endif;
add_action( 'save_post', 'fau_person_metabox_content_save' );

