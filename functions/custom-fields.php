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
	add_action( 'save_post', 'fau_save_metabox_page_untertitel', 10, 2 );
	add_action( 'save_post', 'fau_save_metabox_page_menu', 10, 2 );
	add_action( 'save_post', 'fau_save_metabox_page_portalmenu', 10, 2 );

	
	add_action( 'save_post', 'fau_save_post_teaser', 10, 2 );
	add_action( 'save_post', 'fau_save_post_topevent', 10, 2 );

}


/* Create one or more meta boxes to be displayed on the post editor screen. */

function fau_add_metabox_page() {
	add_meta_box(
		'fau_metabox_page_untertitel',			
		esc_html__( 'Untertitel', 'fau' ),		
		'fau_do_metabox_page_untertitel',		
		 'page','normal','high'
	);
	add_meta_box(
		'fau_metabox_page_portalmenu',			
		esc_html__( 'Portalmenü einbinden', 'fau' ),		
		'fau_do_metabox_page_portalmenu',		
		 'page','side','high'
	);
	add_meta_box(
		'fau_metabox_page_menu',			
		esc_html__( 'Menüoptionen', 'fau' ),		
		'fau_do_metabox_page_menu',		
		 'page','normal','high'
	);
	

}

function fau_add_metabox_post() {
	add_meta_box(
		'fau_metabox_post_teaser',			
		esc_html__( 'Beitragsoptionen', 'fau' ),		
		'fau_do_metabox_post_teaser',		
		 'post','normal','high'
	);
	add_meta_box(
		'fau_metabox_post_topevent',			
		esc_html__( 'Top-Event', 'fau' ),		
		'fau_do_metabox_post_topevent',		
		 'post','normal','high'
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
	<p>
	   <?php echo __('Bitte beachten: Damit ein Artikel auf der Startseite angezeigt werden soll, muss er das folgende Schlagwort erhalten: ','fau');
	   echo '<b>'.$options['start_prefix_tag_newscontent'].'</b> - '.__('Dies gefolgt von einer Nummer (1-3) für die Reihenfolge.','fau'); 
	   if (isset($options['slider-catid'])) {
	    $category = get_category($options['slider-catid']);	   
	    echo ' '.__('Damit ein Artikel in der Bühne erscheint, muss er folgender Kategorie angehören: ','fau');
	    echo '<b>'.$category->name.'</b>';
	   }
	   ?>
	</p>
	
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_anleser">
			<?php _e( "Anleser", 'fau' ); ?>:
		    </label>
	    </p>
	    <textarea name="fauval_anleser" id="fauval_anleser" class="large-text" rows="4" ><?php echo $abstract; ?></textarea>	
	    <br>
	    <div class="howto"><?php echo __('Kurztext für die Bühne und den Newsindex (Startseite und Indexseiten). Wenn leer, wird der Kurztext automatisch aus dem Inhalt abzüglich der erlaubten Zeichen gebildet. ','fau');
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
	    <div class="howto"><?php echo __('Wenn der Artikel nicht auf der Website liegt, sondern auf eine externe Seite verlinkt werden soll, ist hier eine URL anzugeben.','fau');
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

	
	
	<p>
	   <?php echo __('Bitte beachten: Damit ein Artikel als Top-Event angezeigt wird, muss er das folgende Schlagwort erhalten: ','fau');
	   echo '<b>'.$options['start_topevents_tag'].'</b>'; ?>
	</p>
	<div class="optionseingabe">
	    <p>
		    <label for="fauval_topevent_title">
			<?php _e( "Titel", 'fau' ); ?>:
		    </label>
	    </p>
	    <input type="text" name="fauval_topevent_title" id="fauval_topevent_title" class="large-text" value="<?php echo $topevent_title; ?>">	
	    <br>
	    <div class="howto"><?php echo __('Titel wie er in der Sidebar erscheinen soll. Wenn leer, wird der normale Titel des Beitrags verwendet.','fau');
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
	    <div class="howto"><?php echo __('Kurztext für die Sidebar. Wenn leer, wird der Anleser verwendet.','fau');
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
	    
	    
	    <div class="howto"><?php echo __('Geben Sie hier das Datum des Events ein.','fau'); ?></div>
	    
	    <script type="text/javascript">

jQuery(document).ready(function() {
    jQuery('#fauval_topevent_date').datepicker();
});

</script>
	    
	    
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
	    <br><div class="howto"><?php echo __('Hier können Sie ein Thumbnail auswählen für den Event. Wenn kein Bild gewählt wird, wird ein Ersatzbild angezeigt.','fau'); ?>	      
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
function fau_do_metabox_page_menu( $object, $box ) { 
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_page_menu_nonce' ); 
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
	$menuebene = get_post_meta( $object->ID, 'menu-level', true );
	?>
	
	<p>
		<label for="fau_metabox_page_menuebene">
                    <?php _e( "Menüebene", 'fau' ); ?>:
                </label>
	</p>
	<select name="fau_metabox_page_menuebene" id="fau_metabox_page_menuebene">
	    <option value="1" <?php selected($menuebene,1); ?>>1. Ebene</option>
	    <option value="2" <?php selected($menuebene,2); ?>>2. Ebene</option>
	    <option value="3" <?php selected($menuebene,3); ?>>3. Ebene</option>  
	</select>
	<p class="howto">
	    <?php _e('Die Menüebene definiert bei Seiten bis zur welchen Ebene das Menu auf der linken Seite gezeigt wird. Dies gilt nur für Seiten, die das folgende Template ausgewählt haben:','fau'); ?>
	    <code><?php _e('Inhaltsseite mit Navi','fau');?></code> 
	</p>
	<p>
		<label for="fau_metabox_menuquote_quote">
                    <?php _e( "Zitat", 'fau' ); ?>:
                </label>
	</p>
	
	<textarea name="fau_metabox_menuquote_quote" id="fau_metabox_menuquote_quote" class="large-text" rows="4" ><?php echo $quote; ?></textarea>	
	<p class="howto">
	    <?php _e('Das Zitat und der Autor erscheint bei Portalseiten oder Menüpunkten der ersten Ebene des Hauptmenüs neben der Auflistung der Untermenüpunkte.','fau'); ?>
	</p>
	
	
	
	<p>
		<label for="fau_metabox_menuquote_autor">
                    <?php _e( "Autor", 'fau' ); ?>:
                </label>
		<br />
		<input class="large-text" name="fau_metabox_menuquote_autor" id="fau_metabox_menuquote_autor" value="<?php echo $author; ?>" />			
	</p>
	<p class="howto">
	    <?php _e('Dieser freie Text kann einen Namen enthalten auf den das Zitat zurückzuführen ist oder andere Informationen hierzu.','fau'); ?>
	</p>
	<?php 

 }

/* Save the meta box's post/page metadata. */
function fau_save_metabox_page_menu( $post_id, $post ) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['fau_metabox_page_menu_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_page_menu_nonce'], basename( __FILE__ ) ) )
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
	
	$newval = intval($_POST['fau_metabox_page_menuebene']);
	$oldval = get_post_meta( $post_id, 'menu-level', true );
	
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'menu-level', $newval );
	    } else {
		add_post_meta( $post_id, 'menu-level', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'menu-level', $oldval );	
	} 

	
	// Remove old values from version 2
	// $oldval = get_post_meta( $post_id, 'right_column', true );
	//  if (isset($oldval)) {
	//   delete_post_meta( $post_id, 'right_column', $oldval );	
	// }
	
}


/* Display Options for menuquotes on pages */
function fau_do_metabox_page_untertitel( $object, $box ) { 
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_page_untertitel_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'page' == $post_type ) {
	    if ( !current_user_can( 'edit_page', $object->ID) )
		    // Oder sollten wir nach publish_pages  fragen? 
		    // oder nach der Rolle? vgl. http://docs.appthemes.com/tutorials/wordpress-check-user-role-function/ 
		return;
	} else {
	    return;
	}
	
	$untertitel  = get_post_meta( $object->ID, 'headline', true );	

	?>
	
	<p>
		<label for="fau_metabox_page_untertitel">
                    <?php _e( "Untertitel (Inhaltsüberschrift)", 'fau' ); ?>:
                </label>
		<br />
		<input class="large-text" name="fau_metabox_page_untertitel" id="fau_metabox_page_untertitel" value="<?php echo $untertitel; ?>" />			
	</p>
	<p class="howto">
	    <?php _e('Dieser Untertitel erscheint im Inhaltsbereich, unterhalb des Balkens mit dem eigentlichen Titel.','fau'); ?>
	</p>
	<?php 

 }

/* Save the meta box's post/page metadata. */
function fau_save_metabox_page_untertitel( $post_id, $post ) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['fau_metabox_page_untertitel_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_page_untertitel_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	}

	$newval = ( isset( $_POST['fau_metabox_page_untertitel'] ) ? sanitize_text_field( $_POST['fau_metabox_page_untertitel'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'headline', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'headline', $newval );
	    } else {
		add_post_meta( $post_id, 'headline', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'headline', $oldval );	
	} 
}



/* Display Options for menuquotes on pages */
function fau_do_metabox_page_portalmenu( $object, $box ) { 
    global $options;
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_page_portalmenu_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'page' == $post_type ) {
	    if ( !current_user_can( 'edit_page', $object->ID) )
		 
		return;
	} else {
	    return;
	}
	
	$currentmenu  = get_post_meta( $object->ID, 'portalmenu-slug', true );	
	$currentmenuid = 0;
	if ($currentmenu == sanitize_key($currentmenu)) {
	    $currentmenuid = $currentmenu;
	} else {
	    $thisterm = get_term_by('name', $currentmenu, 'nav_menu');
	    if (!isset($thisterm)) {
		$thisterm = get_term_by('slug', $currentmenu, 'nav_menu');
	    }
	    if (isset($thisterm)) {
		$currentmenuid = $thisterm->term_id;    
	    }
	}
	
 

	?>
	
	<p>
		<label for="fau_metabox_page_portalmenu_id">
                    <?php _e( "Portalmenü", 'fau' ); ?>:
                </label>
	</p>
	
	
	<select name="fau_metabox_page_portalmenu_id" id="fau_metabox_page_portalmenu_id">
	<?php 
	$menuliste = get_terms('nav_menu', array('orderby'=> 'name','hide_empty'=>true));
	foreach($menuliste as $term){
		$term_id = $term->term_id;
		$term_name = $term->name;	
		?>
		<option value="<?php echo $term_id; ?>" <?php selected($term_id,$currentmenuid);?>><?php echo $term_name; ?></option>
	<?php } ?>
	</select>
	

	<p class="howto">
	    <?php _e('Bei einer Portalseite wird unter dem Inhalt ein Menu ausgegeben. Bitte wählen Sie hier das Menü aus der Liste. Sollte das Menü noch nicht existieren, kann ein Administrator es anlegen.','fau'); ?>
	</p>
	

	<?php 
	$nothumbnails  = get_post_meta( $object->ID, 'fauval_portalmenu_thumbnailson', true ); 
	fau_form_onoff('fau_metabox_page_portalmenu_nothumbnails',$nothumbnails,__('Artikelbilder verstecken; Nur Überschriften zeigen.','fau'));
	
	$nofallbackthumbs  = get_post_meta( $object->ID, 'fauval_portalmenu_nofallbackthumb', true );	
	fau_form_onoff('fau_metabox_page_portalmenu_nofallbackthumb',$nofallbackthumbs,__('Keine Ersatzbilder zeigen, wenn Artikelbilder nicht gesetzt sind.','fau'));

	$nosub  = get_post_meta( $object->ID, 'fauval_portalmenu_nosub', true );	
	fau_form_onoff('fau_metabox_page_portalmenu_nosub',$nosub,__('Unterpunkte verbergen.','fau'));

	


 }

/* Save the meta box's post/page metadata. */
function fau_save_metabox_page_portalmenu( $post_id, $post ) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['fau_metabox_page_portalmenu_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_page_portalmenu_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	}

	$newval =$_POST['fau_metabox_page_portalmenu_id'];
	$oldval = get_post_meta( $post_id, 'portalmenu-slug', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'portalmenu-slug', $newval );
	    } else {
		add_post_meta( $post_id, 'portalmenu-slug', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'portalmenu-slug', $oldval );	
	} 
	
	$newval = intval($_POST['fau_metabox_page_portalmenu_nothumbnails']);
	$oldval = get_post_meta( $object->ID, 'fauval_portalmenu_thumbnailson', true );
	
	if ($newval==1) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'fauval_portalmenu_thumbnailson', $newval );
	    } else {
		add_post_meta( $post_id, 'fauval_portalmenu_thumbnailson', $newval, true );
	    }
	} else {
	    delete_post_meta( $post_id, 'fauval_portalmenu_thumbnailson' );	
	} 
	
	$newval = intval($_POST['fau_metabox_page_portalmenu_nofallbackthumb']);
	$oldval = get_post_meta( $object->ID, 'fauval_portalmenu_nofallbackthumb', true );
	
	if ($newval==1) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'fauval_portalmenu_nofallbackthumb', $newval );
	    } else {
		add_post_meta( $post_id, 'fauval_portalmenu_nofallbackthumb', $newval, true );
	    }
	} else {
	    delete_post_meta( $post_id, 'fauval_portalmenu_nofallbackthumb' );	
	} 

	$newval = intval($_POST['fau_metabox_page_portalmenu_nosub']);
	$oldval = get_post_meta( $object->ID, 'fauval_portalmenu_nosub', true );
	
	if ($newval==1) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'fauval_portalmenu_nosub', $newval );
	    } else {
		add_post_meta( $post_id, 'fauval_portalmenu_nosub', $newval, true );
	    }
	} else {
	    delete_post_meta( $post_id, 'fauval_portalmenu_nosub' );	
	} 

}




function fau_form_text($name= '', $prevalue = '', $labeltext = '', $howtotext = '', $placeholder='', $size = 0) {
    $name = fau_san( $name );
    $labeltext = fau_san( $labeltext );
    if (isset($name) &&  isset($labeltext))  {
	echo "<p>\n";
	echo '	<label for="'.$name.'">';
	echo $labeltext;
	echo "</label><br />\n";
	echo '	<input class="large-text" name="'.$name.'" id="'.$name.'" value="'.$prevalue.'"';
	if (strlen(trim($placeholder))) {
	    echo ' placeholder="'.$placeholder.'"';
	}
	if (intval($size)>0) {
	    echo ' length="'.$size.'"';
	}
	echo " />\n";
	echo "</p>\n";
	if (strlen(trim($howtotext))) {
	    echo '<p class="howto">';
	    echo $howtotext;
	    echo "</p>\n";
	}
    } else {
	echo _('Ungültiger Aufruf von fau_form_text() - Name oder Label fehlt.', 'fau');
    }
}
    
function fau_form_onoff($name= '', $prevalue = 0, $labeltext = '',  $howtotext = '' ) {
    $name = fau_san( $name );
    $labeltext = fau_san( $labeltext );
    if (isset($name) &&  isset($labeltext))  { ?>
	<div class="schalter">
	    <select class="onoff" name="<?php echo $name; ?>" id="<?php echo $name; ?>">
		<option value="0" <?php selected(0,$prevalue);?>>Aus</option>
		<option value="1" <?php selected(1,$prevalue);?>>An</option>
	    </select>
	    <label>
		<?php echo $labeltext; ?>
	    </label>
	</div>
	<?php 
	if (strlen(trim($howtotext))) {
	    echo '<p class="howto">';
	    echo $howtotext;
	    echo "</p>\n";
	}
    } else {
	echo _('Ungültiger Aufruf von fau_form_onoff() - Name oder Label fehlt.', 'fau');
    }
}
    
