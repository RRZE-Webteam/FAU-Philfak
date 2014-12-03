<?php

/*
 * Metaboxes and adjustments for generell custom fields 
 */


add_action( 'load-post.php', 'fau_metabox_cf_setup' );
add_action( 'load-post-new.php', 'fau_metabox_cf_setup' );



/* Meta box setup function. */
function fau_metabox_cf_setup() {

	/* Display sidecontent */
	add_action( 'add_meta_boxes', 'fau_add_metabox_menuquote' );	
	/* Save sidecontent */
	add_action( 'save_post', 'fau_save_metabox_menuquote', 10, 2 );
}


/* Create one or more meta boxes to be displayed on the post editor screen. */

function fau_add_metabox_menuquote() {
	add_meta_box(
		'fau_metabox_menuquote',			
		esc_html__( 'Zitat für Hauptmenü', 'fau' ),		
		'fau_do_metabox_menuquote',		
		 'page','advanced','default'
	);
}

/* Display Options for posts and pages */
function fau_do_metabox_menuquote( $object, $box ) { 
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_menuquote_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'page' == $post_type ) {
	    if ( !current_user_can( 'edit_page', $object->ID) )
		    // Oder sollten wir nach publish_pages  fragen? 
		    // oder nach der Rolle? vgl. http://docs.appthemes.com/tutorials/wordpress-check-user-role-function/ 
		return;
	} else {
	    return;
	}
	
	$quote  = get_post_meta( $object->ID, 'zitat_text', true );
		// $quote = get_field('zitat_text', $this->currentID);
		
	$author =  get_post_meta( $object->ID, 'zitat_autor', true );
		//get_field('zitat_autor', $this->currentID);
		
	?>
	<p>
		<label for="fau_metabox_menuquote_quote">
                    <?php _e( "Zitat", 'fau' ); ?>
                </label>
		<br />
		<textarea name="fau_metabox_menuquote_quote" id="fau_metabox_menuquote_quote" class="large-text" rows="4" ><?php echo $quote; ?></textarea>			
	</p>
	<p>
		<label for="fau_metabox_menuquote_autor">
                    <?php _e( "Autor", 'fau' ); ?>
                </label>
		<br />
		<input class="large-text" name="fau_metabox_menuquote_autor" id="fau_metabox_menuquote_autor"><?php echo $author; ?></textarea>			
	</p>
	<?php 

 }

/* Save the meta box's post/page metadata. */
function fau_save_metabox_menuquote( $post_id, $post ) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['fau_metabox_menuquote_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_menuquote_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	}

	$newval = ( isset( $_POST['fau_metabox_menuquote_quote'] ) ? sanitize_text_field( $_POST['fau_metabox_menuquote_quote'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'zitat_text', true );
	
	if ( $newval && '' == $oldval )
		add_post_meta( $post_id, 'zitat_text', $newval, true );
	elseif ( $newval && $newval != $oldval )
		update_post_meta( $post_id, 'zitat_text', $newval );
	elseif ( '' == $newval && $oldval )
		delete_post_meta( $post_id, 'zitat_text', $oldval );	
	
	$newval = ( isset( $_POST['fau_metabox_menuquote_autor'] ) ? sanitize_text_field( $_POST['fau_metabox_menuquote_autor'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'zitat_autor', true );
	
	if ( $newval && '' == $oldval )
		add_post_meta( $post_id, 'zitat_autor', $newval, true );
	elseif ( $newval && $newval != $oldval )
		update_post_meta( $post_id, 'zitat_autor', $newval );
	elseif ( '' == $newval && $oldval )
		delete_post_meta( $post_id, 'zitat_autor', $oldval );	
	
	
	// Remove old values from version 2
	// $oldval = get_post_meta( $post_id, 'right_column', true );
	//  if (isset($oldval)) {
	//   delete_post_meta( $post_id, 'right_column', $oldval );	
	// }
	
}

