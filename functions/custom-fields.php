<?php

/*
 * Metaboxes and adjustments for generell custom fields 
 */


add_action( 'load-post.php', 'fau_metabox_cf_setup' );
add_action( 'load-post-new.php', 'fau_metabox_cf_setup' );



/* Meta box setup function. */
function fau_metabox_cf_setup() {

	/* Display Metabox */
	add_action( 'add_meta_boxes_page', 'fau_add_metabox_page' );
	add_action( 'add_meta_boxes_post', 'fau_add_metabox_post' );
	/* Save sidecontent */
	add_action( 'save_post', 'fau_save_metabox_menuquote', 10, 2 );
	add_action( 'save_post', 'fau_save_post_teaser', 10, 2 );
	add_action( 'save_post', 'fau_save_post_topevent', 10, 2 );
	
}


/* Create one or more meta boxes to be displayed on the post editor screen. */

function fau_add_metabox_page() {
	add_meta_box(
		'fau_metabox_menuquote',			
		esc_html__( 'Zitat für Hauptmenü', 'fau' ),		
		'fau_do_metabox_menuquote',		
		 'page','advanced','default'
	);

}

function fau_add_metabox_post() {
	add_meta_box(
		'fau_metabox_post_teaser',			
		esc_html__( 'Teaser- und Bühnenoptionen', 'fau' ),		
		'fau_do_metabox_post_teaser',		
		 'post','advanced','default'
	);
	add_meta_box(
		'fau_metabox_post_topevent',			
		esc_html__( 'Top-Event', 'fau' ),		
		'fau_do_metabox_post_topevent',		
		 'post','advanced','default'
	);
	
}





/* Display Options for posts */
function fau_do_metabox_post_teaser( $object, $box ) { 
	global $options;
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_post_teaser_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'post' == $post_type ) {
	    if ( !current_user_can( 'edit_post', $object->ID) )
		return;
	} else {
	    return;
	}
	
	$abstract  = get_post_meta( $object->ID, 'abstract', true );	
	$external_link =  get_post_meta( $object->ID, 'external_link', true );
	

	?>

	
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_anleser">
			<?php _e( "Anleser", 'fau' ); ?>:
		    </label>
	    </p>
	    <textarea name="fauval_anleser" id="fauval_anleser" class="large-text" rows="4" ><?php echo $abstract; ?></textarea>	
	    <br>
	    <div class="description"><?php echo __('Kurztext für die Bühne und den Newsindex (Startseite und Indexseiten). Wenn leer, wird der Kurztext automatisch aus dem Inhalt abzuglich der erlaubten Zeichen gebildet. ','fau');
	    echo __('Erlaubte Anzahl an Zeichen:','fau');
	    echo ' <span class="fauval_anleser_signs">'.$options['default_anleser_excerpt_length'].'</span>';
	    ?></div>
	</div>
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_external_link">
			<?php _e( "Externer Link", 'fau' ); ?>:
		    </label>
	    </p>
	    <input type="url" name="fauval_external_link" id="fauval_external_link" class="large-text" placeholder="http://" value="<?php echo $external_link; ?>">	
	    <br>
	    <div class="description"><?php echo __('Wenn der Artikel nicht auf der Website liegt, sondern auf eine externe Seite verlinkt werden soll, ist hier eine URL anzugeben.','fau');
	    ?></div>
	</div>
	
	
	<?php 

 }

 /* Save the meta box's post/page metadata. */
function fau_save_post_teaser( $post_id, $post ) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['fau_metabox_post_teaser_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_post_teaser_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}

	$newval = ( isset( $_POST['fauval_anleser'] ) ? wp_filter_nohtml_kses( $_POST['fauval_anleser'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'abstract', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'abstract', $newval );
	    } else {
		add_post_meta( $post_id, 'abstract', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'abstract', $oldval );	
	} 

	if (filter_var($_POST['fauval_external_link'], FILTER_VALIDATE_URL)) {
	    $newval =  $_POST['fauval_external_link']  ; 
	} else {
	    $newval = '';
	}
	$oldval = get_post_meta( $post_id, 'external_link', true );
	
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'external_link', $newval );
	    } else {
		add_post_meta( $post_id, 'external_link', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'external_link', $oldval );	
	} 
	
}

 
 
/* Display Options for posts */
function fau_do_metabox_post_topevent( $object, $box ) { 
	global $options;
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_post_topevent_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'post' == $post_type ) {
	    if ( !current_user_can( 'edit_post', $object->ID) )
		return;
	} else {
	    return;
	}
	
	
	$topevent_title  = get_post_meta( $object->ID, 'topevent_title', true );
	$topevent_desc  = get_post_meta( $object->ID, 'topevent_description', true );
	$topevent_date  = get_post_meta( $object->ID, 'topevent_date', true );
	$topevent_image  = get_post_meta( $object->ID, 'topevent_image', true );
		
	?>

	
	
	<p class="hinweis">
	   <?php echo __('Bitte beachten: Damit ein Artikel als Top-Event angezeigt wird, muss er das folgende Schlagwort erhalten: ','fau');
	   echo '<code>'.$options['start_topevents_tag'].'</code>'; ?>
	</p>
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_topevent_title">
			<?php _e( "Titel", 'fau' ); ?>:
		    </label>
	    </p>
	    <input type="text" name="fauval_topevent_title" id="fauval_topevent_title" class="large-text" value="<?php echo $topevent_title; ?>">	
	    <br>
	    <div class="description"><?php echo __('Titel wie er in der Sidebar erscheinen soll. Wenn leer, wird der normale Titel des Beitrags verwendet.','fau');
	    ?></div>
	</div>
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_topevent_desc">
			<?php _e( "Kurzbeschreibung", 'fau' ); ?>:
		    </label>
	    </p>
	    <textarea name="fauval_topevent_desc" id="fauval_topevent_desc" class="large-text" rows="3" ><?php echo $topevent_desc; ?></textarea>	
	    <br>
	    <div class="description"><?php echo __('Kurztext für die Sidebar. Wenn leer, wird der Anleser verwendet.','fau');
	    echo ' '. __('Erlaubte Anzahl an Zeichen:','fau');
	    echo ' <span class="fauval_topevent_desc_signs">'.$options['default_topevent_excerpt_length'].'</span>';
	    ?></div>
	</div>
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_topevent_date">
			<?php _e( "Datum", 'fau' ); ?>:
		    </label>
	    </p>
	    <input type="date" name="fauval_topevent_date" id="fauval_topevent_date" class="text" value="<?php echo $topevent_date; ?>">		
	    <br>
	    <div class="description"><?php echo __('Geben Sie hier das Datum des Events ein.','fau'); ?>	  
	   </div>
	</div>
	
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_topevent_image">
			<?php _e( "Symbolbild", 'fau' ); ?>:
		    </label>
	    </p>

	    <?php 
	    echo '<div class="uploader">';
	    
				    $image = '';
				    $imagehtml = '';
				    if (isset($topevent_image) && ($topevent_image>0)) {
					$image = wp_get_attachment_image_src($topevent_image, 'topevent-thumb'); 
					if (isset($image)) {
					    $imagehtml = '<img class="image_show_topevent_image" src="'.$image[0].'" width="'.$options['default_topevent_thumb_width'].'" height="'.$options['default_topevent_thumb_height'].'" alt="">';
					}
				    }
				   
				    echo '<div class="previewimage showimg_topevent_image">';
				    if (!empty($imagehtml)) {  
					echo $imagehtml;
				    } else {
					 $imagehtml = '<img src="'.fau_esc_url($options['default_topevent_thumb_src']).'" width="'.$options['default_topevent_thumb_width'].'" height="'.$options['default_topevent_thumb_height'].'" alt="">';			    
					 echo $imagehtml;
					 echo "<br>";
					 _e('Kein Bild ausgewählt. Ersatzbild wird gezeigt.', 'fau');
				    } 
				    echo "</div>\n"; ?>		
				    
				    <input type="hidden" name="fauval_topevent_image" id="fauval_topevent_image" 
					     value="<?php echo sanitize_key( $topevent_image ) ; ?>" />
				    
				    <input class="button" name="image_button_topevent_image" id="image_button_topevent_image" value="<?php _e('Bild auswählen', 'fau'); ?>" />
				    <small><a href="#" class="image_remove_topevent_image"><?php _e( "Entfernen", 'fau' );?></a></small>
				    <br><div class="description"><?php echo __('Hier können Sie ein Thumbnail auswählen für den Event. Wenn kein Bild gewählt wird, wird ein Ersatzbild angezeigt.','fau'); ?>	      
				    </div><script>
				    jQuery(document).ready(function() {
					jQuery('#image_button_topevent_image').click(function()  {
					    wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('#fauval_topevent_image').val(attachment.id);
						htmlshow = "<img src=\""+attachment.url + "\" width=\"<?php echo $options['default_topevent_thumb_width'];?>\" height=\"<?php echo $options['default_topevent_thumb_height'];?>\">";  					   
						jQuery('.showimg_topevent_image').html(htmlshow);

					    }
					    wp.media.editor.open(this);
					    return false;
					});
				    });
				    jQuery(document).ready(function() {
					jQuery('.image_remove_topevent_image').click(function()   {
						jQuery('#fauval_topevent_image').val('');
						jQuery('.showimg_topevent_image').html('<?php _e('Kein Bild ausgewählt.', 'fau'); ?>');
						return false;
					});
				    });
				   </script> 		    	    
	    
	    

	    
	   </div>
	</div>
	
	
	<?php 

 }

 
 /* Save the meta box's post/page metadata. */
function fau_save_post_topevent( $post_id, $post ) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['fau_metabox_post_topevent_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_post_topevent_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'post' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_post', $post_id ) )
		return;
	}

	$newval = ( isset( $_POST['fauval_topevent_title'] ) ? sanitize_title( $_POST['fauval_topevent_title'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'topevent_title', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'topevent_title', $newval );
	    } else {
		add_post_meta( $post_id, 'topevent_title', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'topevent_title', $oldval );	
	} 
	
	$newval = ( isset( $_POST['fauval_topevent_desc'] ) ?  wp_filter_nohtml_kses( $_POST['fauval_topevent_desc'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'topevent_description', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'topevent_description', $newval );
	    } else {
		add_post_meta( $post_id, 'topevent_description', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'topevent_description', $oldval );	
	} 

	
	$newval = ( isset( $_POST['fauval_topevent_date'] ) ?  sanitize_option( 'date_format', $_POST['fauval_topevent_date'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'topevent_date', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'topevent_date', $newval );
	    } else {
		add_post_meta( $post_id, 'topevent_date', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'topevent_date', $oldval );	
	} 
	
	$newval = ( isset( $_POST['fauval_topevent_image'] ) ?  intval( $_POST['fauval_topevent_image'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'topevent_image', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'topevent_image', $newval );
	    } else {
		add_post_meta( $post_id, 'topevent_image', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'topevent_image', $oldval );	
	} 
		


	
}

 
 


/* Display Options for menuquotes on pages */
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
	$author =  get_post_meta( $object->ID, 'zitat_autor', true );
		
	?>
	<p class="description">
	    <?php _e('Das Zitat und der Autor erscheint bei Portalseiten oder Menüpunkten der ersten Ebene des Hauptmenüs neben der Auflistung der Untermenüpunkte.','fau'); ?>
	</p>
	<p>
		<label for="fau_metabox_menuquote_quote">
                    <?php _e( "Zitat", 'fau' ); ?>:
                </label>
	</p>
	<textarea name="fau_metabox_menuquote_quote" id="fau_metabox_menuquote_quote" class="large-text" rows="4" ><?php echo $quote; ?></textarea>	
	
	<p>
		<label for="fau_metabox_menuquote_autor">
                    <?php _e( "Autor", 'fau' ); ?>:
                </label>
		<br />
		<input class="large-text" name="fau_metabox_menuquote_autor" id="fau_metabox_menuquote_autor" value="<?php echo $author; ?>" />			
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
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'zitat_text', $newval );
	    } else {
		add_post_meta( $post_id, 'zitat_text', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'zitat_text', $oldval );	
	} 

	
	$newval = ( isset( $_POST['fau_metabox_menuquote_autor'] ) ? sanitize_text_field( $_POST['fau_metabox_menuquote_autor'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'zitat_autor', true );
	
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'zitat_autor', $newval );
	    } else {
		add_post_meta( $post_id, 'zitat_autor', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'zitat_autor', $oldval );	
	} 

	
	// Remove old values from version 2
	// $oldval = get_post_meta( $post_id, 'right_column', true );
	//  if (isset($oldval)) {
	//   delete_post_meta( $post_id, 'right_column', $oldval );	
	// }
	
}

