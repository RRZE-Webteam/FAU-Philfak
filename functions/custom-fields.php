<?php

/*
 * Metaboxes and adjustments for generell custom fields 
 */


add_action( 'load-post.php', 'fau_metabox_cf_setup' );
add_action( 'load-post-new.php', 'fau_metabox_cf_setup' );



/* Meta box setup function. */
function fau_metabox_cf_setup() {
    global $options;
	/* Display Metabox */
	add_action( 'add_meta_boxes_page', 'fau_add_metabox_page' );
	add_action( 'add_meta_boxes_post', 'fau_add_metabox_post' );


	/* Save sidecontent */
	add_action( 'save_post', 'fau_save_metabox_page_untertitel', 10, 2 );
	add_action( 'save_post', 'fau_save_metabox_page_menu', 10, 2 );
	add_action( 'save_post', 'fau_save_metabox_page_portalmenu', 10, 2 );
	add_action( 'save_post', 'fau_save_metabox_page_imagelinks', 10, 2 );
	if ($options['advanced_activateads'] == true) {
	    add_action( 'save_post', 'fau_save_metabox_page_ad', 10, 2 );
	}
	if ($options['advanced_beitragsoptionen']==true) {
	    add_action( 'save_post', 'fau_save_post_teaser', 10, 2 );
	}
	if ($options['advanced_topevent']==true) {
	    add_action( 'save_post', 'fau_save_post_topevent', 10, 2 );
	}

}


/* Create one or more meta boxes to be displayed on the post editor screen. */

function fau_add_metabox_page() {
    global $options;
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
		 'page','side','core'
	);
	add_meta_box(
		'fau_metabox_page_menu',			
		esc_html__( 'Menüoptionen', 'fau' ),		
		'fau_do_metabox_page_menu',		
		 'page','normal','high'
	);
	add_meta_box(
		'fau_metabox_page_imagelinks',			
		esc_html__( 'Logos (Bildlinks) anzeigen', 'fau' ),		
		'fau_do_metabox_page_imagelinks',		
		 'page','side','core'
	);
	if ($options['advanced_activateads'] == true) {
	    add_meta_box(
		    'fau_metabox_page_ad',			
		    esc_html__( 'Werbung aktivieren', 'fau' ),		
		    'fau_do_metabox_page_ad',		
		     'page','side','core'
	    );
	}

	add_meta_box(
		'fau_metabox_page_sidebar',			
		esc_html__( 'Sidebar (BETA!!!)', 'fau' ),		
		'fau_do_metabox_page_sidebar',		
		 'page','normal','core'
	);
  
 
}

function fau_add_metabox_post() {
	global $options;
	add_meta_box(
		'fau_metabox_post_teaser',			
		esc_html__( 'Beitragsoptionen', 'fau' ),		
		'fau_do_metabox_post_teaser',		
		 'post','normal','high'
	);
	if ($options['advanced_topevent']==true) {
	    add_meta_box(
		    'fau_metabox_post_topevent',			
		    esc_html__( 'Top-Event', 'fau' ),		
		    'fau_do_metabox_post_topevent',		
		     'post','normal','high'
	    );
	}
	
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
	

	
	<?php
	
	if ($options['advanced_beitragsoptionen']==true) {	
	    $howto = __('Kurztext für die Bühne und den Newsindex (Startseite und Indexseiten). Wenn leer, wird der Kurztext automatisch aus dem Inhalt abzüglich der erlaubten Zeichen gebildet. ','fau');
	    $howto .= '<br>'.__('Erlaubte Anzahl an Zeichen:','fau');
	    $howto .= '<span class="fauval_anleser_signs">'.$options['default_anleser_excerpt_length'].'</span>';	
	    $abstract  = get_post_meta( $object->ID, 'abstract', true );	
	    fau_form_textarea('fauval_anleser', $abstract, __('Anleser','fau'), 80, 5, $howto);

	    $external_link =  get_post_meta( $object->ID, 'external_link', true );
	    fau_form_url('fauval_external_link', $external_link, __( "Externer Link", 'fau' ), __('Wenn der Artikel nicht auf der Website liegt, sondern auf eine externe Seite verlinkt werden soll, ist hier eine URL anzugeben.','fau'), $placeholder='http://', $size = 0);

	    $override_thumbdesc =  get_post_meta( $object->ID, 'fauval_overwrite_thumbdesc', true );
	    fau_form_text('fauval_overwrite_thumbdesc', $override_thumbdesc, __('Ersetze Bildbeschreibung','fau'), __('Mit diesem optionalen Text kann die Bildunterschrift des verwendeten Beitragsbildes durch einen eigenen Text ersetzt werden, der nur für diesen Beitrag gilt.','fau'));

	    $sliderimage =  get_post_meta( $object->ID, 'fauval_slider_image', true );
	    fau_form_image('fauval_slider_image', $sliderimage, __('Bühnenbild','fau'), __('An dieser Stelle kann optional ein alternatives Bild für die Bühne der Startseite ausgewählt werden, falls das normale Beitragsbild hierzu nicht verwendet werden soll.','fau'),540,150);
	}
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
	
	$newval = ( isset( $_POST['fauval_overwrite_thumbdesc'] ) ? wp_filter_nohtml_kses( $_POST['fauval_overwrite_thumbdesc'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'fauval_overwrite_thumbdesc', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'fauval_overwrite_thumbdesc', $newval );
	    } else {
		add_post_meta( $post_id, 'fauval_overwrite_thumbdesc', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'fauval_overwrite_thumbdesc', $oldval );	
	} 
	
	
	$newval = ( isset( $_POST['fauval_slider_image'] ) ? intval( $_POST['fauval_slider_image'] ) : 0 );
	$oldval = get_post_meta( $post_id, 'fauval_slider_image', true );
	
	if (!empty(trim($newval))) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'fauval_slider_image', $newval );
	    } else {
		add_post_meta( $post_id, 'fauval_slider_image', $newval, true );
	    }
	} elseif ($oldval) {
	    delete_post_meta( $post_id, 'fauval_slider_image', $oldval );	
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
	
 
	$thislist = array();
	$menuliste = get_terms('nav_menu', array('orderby'=> 'name','hide_empty'=>true));
	foreach($menuliste as $term){
		$term_id = $term->term_id;
		$term_name = $term->name;	
		$thislist[$term->term_id] =  $term->name;
	}
	fau_form_select('fau_metabox_page_portalmenu_id',$thislist,$currentmenuid,__('Portalmenü','fau'),
		__('Bei einer Portalseite wird unter dem Inhalt ein Menu ausgegeben. Bitte wählen Sie hier das Menü aus der Liste. Sollte das Menü noch nicht existieren, kann ein Administrator es anlegen.','fau'),
		1, __('Kein Portalmenu zeigen','fau'));

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
	$oldval = get_post_meta( $post_id, 'fauval_portalmenu_thumbnailson', true );
	
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
	$oldval = get_post_meta( $post_id, 'fauval_portalmenu_nofallbackthumb', true );
	
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
	$oldval = get_post_meta( $post_id, 'fauval_portalmenu_nosub', true );
	
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

/* 
 * Imagelinks einbinden 
 */

/* Display Options for menuquotes on pages */
function fau_do_metabox_page_imagelinks( $object, $box ) { 
    global $options;
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_page_imagelinks_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'page' == $post_type ) {
	    if ( !current_user_can( 'edit_page', $object->ID) )
		 
		return;
	} else {
	    return;
	}

 
	$categories = get_categories( array('type' => 'imagelink', 'taxonomy' => 'imagelinks_category', 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => 1 ) ); 
	foreach($categories as $category) {
	    if (!is_wp_error( $category )) {
		if ($category->count > 1) {
		    $thislist[$category->cat_ID] = $category->name.' ('.$category->count.' '.__('Bilder','fau').')';
		} else {
		    $thislist[$category->cat_ID] = $category->name.' ('.$category->count.' '.__('Bild','fau').')';
		}
	    }	
	}	
	

	$currentcat  = get_post_meta( $object->ID, 'fauval_imagelink_catid', true );
	fau_form_select('fau_metabox_page_imagelinks_catid',$thislist,$currentcat,__('Kategorie','fau'),
		__('Wählen Sie hier die Kategorie aus aus der Logos (Bildlinks) verwendet werden sollen. Die Bilder aus der gewählten Kategorie werden dann angezeigt.','fau'),
		1, __('Keine Logos zeigen','fau'));
	
	return;


 }

/* Save the meta box's post/page metadata. */
function fau_save_metabox_page_imagelinks( $post_id, $post ) {
	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['fau_metabox_page_imagelinks_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_page_imagelinks_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	}

	$newval = intval($_POST['fau_metabox_page_imagelinks_catid']);
	$oldval = get_post_meta( $post_id, 'fauval_imagelink_catid', true );
	
	if ($newval>0) {
	    if (isset($oldval)  && ($oldval != $newval)) {
		update_post_meta( $post_id, 'fauval_imagelink_catid', $newval );
	    } else {
		add_post_meta( $post_id, 'fauval_imagelink_catid', $newval, true );
	    }
	} else {
	    delete_post_meta( $post_id, 'fauval_imagelink_catid', $oldval );	
	} 

}




/* 
 * Werbung aktivieren 
 */

/* Display Options for menuquotes on pages */
function fau_do_metabox_page_ad( $object, $box ) { 
    global $options;
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_page_ad_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'page' == $post_type ) {
	    if ( !current_user_can( 'edit_page', $object->ID) )
		 
		return;
	} else {
	    return;
	}
	
	
	$allads = get_posts( array('post_type' => 'ad', 'posts_per_page' => -1));
	if ($allads) {
	    $sidebarads = array('-1' => __('Keine (Deaktivieren)','fau'));
	    $bottomads = array('-1' => __('Keine (Deaktivieren)','fau'));
	    
	    foreach ($allads as $ad) {
		$title = get_the_title($ad->ID);
		$position = get_post_meta( $ad->ID, 'fauval_ad_position', true );
		if ($position==1) {
		    // Nur in der Sidebar
		    $sidebarads[$ad->ID] = $title;
	        } elseif ($position==2) {		    
		    // Nur Unten
		    $bottomads[$ad->ID] = $title;
		} else {
		    // Beide Bereiceh oder unedefiniert
		    $sidebarads[$ad->ID] = $title;
		    $bottomads[$ad->ID] = $title;
		}
	    }
	    wp_reset_postdata();
	    $listseite = get_post_meta( $object->ID, 'werbebanner_seitlich', true );
	    $listunten = get_post_meta( $object->ID, 'werbebanner_unten', true );
	    
	    
	    fau_form_multiselect('werbebanner_seitlich', $sidebarads, $listseite, __('Sidebar','fau'),  __('Wählen Sie die Werbung, die in der Sidebar erscheinen soll.','fau'), 0 );	    
	    fau_form_multiselect('werbebanner_unten', $bottomads, $listunten, __('Inhaltsbereich','fau'),  __('Wählen Sie die Werbung, die unterhalb des Inhalts erscheinen soll.','fau'), 0);
	    
	    
	} else {
	    _e('Es wurde noch keine Werbung definiert, die angezeigt werden kann.', 'fau');
	}
	return;
 }

/* Save the meta box's post/page metadata. */
function fau_save_metabox_page_ad( $post_id, $post ) {
	if ( !isset( $_POST['fau_metabox_page_ad_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_page_ad_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	}

	
	$newval = $_POST['werbebanner_seitlich'];
	$oldval = get_post_meta( $post_id, 'werbebanner_seitlich', true );
	$remove = 0;
	$found =0;
	if (isset($newval)) {
	    foreach ($newval as $i) {
		if ($i == -1) {
		    $remove = 1;
		} elseif ($i >0) {
		    $found = 1;
		}
	    }
	}
	
	if (($remove==1) || ($found==0)) {
	     delete_post_meta( $post_id, 'werbebanner_seitlich' );	 
	} else {
		if (isset($oldval))  {
		    update_post_meta( $post_id, 'werbebanner_seitlich', $newval );
		} else {
		    add_post_meta( $post_id, 'werbebanner_seitlich', $newval, true );
		}
	}
	
	
	$newval = $_POST['werbebanner_unten'];
	$oldval = get_post_meta( $post_id, 'werbebanner_unten', true );
	$remove = 0;
	$found =0;
	if (isset($newval)) {
	    foreach ($newval as $i) {
		if ($i == -1) {
		    $remove = 1;
		} elseif ($i >0) {
		    $found = 1;
		}
	    }
	}
	
	if (($remove==1) || ($found==0)) {
	     delete_post_meta( $post_id, 'werbebanner_unten' );	 
	} else {
		if (isset($oldval))  {
		    update_post_meta( $post_id, 'werbebanner_unten', $newval );
		} else {
		    add_post_meta( $post_id, 'werbebanner_unten', $newval, true );
		}
	}

	
}




/* 
 * Sidebar der Seiten  
 */

/* Display Options for menuquotes on pages */
function fau_do_metabox_page_sidebar( $object, $box ) { 
    global $options;
	wp_nonce_field( basename( __FILE__ ), 'fau_metabox_page_sidebar_nonce' ); 
	$post_type = get_post_type( $object->ID); 
	
	if ( 'page' == $post_type ) {
	    if ( !current_user_can( 'edit_page', $object->ID) )
		 
		return;
	} else {
	    return;
	}
	
	
	$sidebar_title_above = get_post_meta( $object->ID, 'sidebar_title_above', true );
	$sidebar_text_above = get_post_meta( $object->ID, 'sidebar_text_above', true );
	
	
	$sidebar_title_personen = get_post_meta( $object->ID, 'sidebar_title_personen', true );	 
	$sidebar_personen = get_post_meta( $object->ID, 'sidebar_personen', true );
	
	// Verlinkung auf Post Type personen, kann mehr als ein sein
	
	$sidebar_title_quicklinks = get_post_meta( $object->ID, 'sidebar_title_quicklinks', true );
	$sidebar_quicklinks = get_post_meta( $object->ID, 'sidebar_quicklinks', true );
	    // Verlinkung auf vorhandenen Seiten, kann mehr als ein sein
	$sidebar_quicklinks_external = get_post_meta( $object->ID, 'sidebar_quicklinks_external', true );
	    // Verlinkung auf externe Seiten, ggf. wie Ads verwalten, kann mehr als ein sein
	  
	 

	$sidebar_title_below = get_post_meta( $object->ID, 'sidebar_title_below', true );
	$sidebar_text_below = get_post_meta( $object->ID, 'sidebar_text_below', true );


	
	
        
	
	
		   
	fau_form_text('sidebar_title_above', $sidebar_title_above, __('Titel oben','fau'), __('Titel am Anfang der Sidebar','fau'));
 	fau_form_wpeditor('sidebar_text_above', $sidebar_text_above, __('Textbereich oben','fau'), __('Text am Anfang der Sidebar','fau'),true);
   
	fau_form_text('sidebar_title_personen', $sidebar_title_personen, __('Titel Ansprechpartner','fau'), __('Titel über Ansprechpartner','fau'));
	$personen = get_posts(array('post_type' => 'person', 'post_status' => 'publish', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'suppress_filters' => false));
	if ($personen) {
	    $auswahl = array('-1' => __('Keine (Deaktivieren)','fau'));
	    
	    foreach ($personen as $current) {
		$title = get_the_title($current->ID);
		$auswahl[$current->ID] = $title;
	    }
	    wp_reset_postdata();
	    
	    fau_form_multiselect('sidebar_personen', $auswahl, $sidebar_personen, __('Auswahl Ansprechpartner','fau'),  __('Wählen Sie die Personen oder Ansprechpartner, die in der Sidebar erscheinen sollen. Es kann mehr als ein Eintrag gewählt werden.','fau'), 0 );	    
	}
	
/*
	fau_form_text('sidebar_title_quicklinks', $sidebar_title_personen, __('Titel Quicklinks','fau'), __('Titel über Liste von Quicklinks','fau'));
	$links = get_posts(array('post_type' => 'page', 'post_status' => 'publish', 'orderby' => 'title'));
	if ($links) {
	    $auswahl = array('-1' => __('Keine (Deaktivieren)','fau'));
	    
	    foreach ($links as $current) {
		$title = get_the_title($current->ID);
		$auswahl[$current->ID] = $title;
	    }
	    wp_reset_postdata();
	    
	    fau_form_multiselect('sidebar_quicklinks', $auswahl, $sidebar_quicklinks, __('Auswahl Seitenlinks','fau'),  __('Wählen Sie die Links auf Seiten innerhalb des Webauftritts, die in der Sidebar erscheinen sollen. Es kann mehr als ein Eintrag gewählt werden.','fau'), 0 );	    
	}
	
	
	
	*/
	
	fau_form_text('sidebar_title_below', $sidebar_title_below, __('Titel unten','fau'), __('Titel am Ende der Sidebar','fau'));
 	fau_form_wpeditor('sidebar_text_below', $sidebar_text_below, __('Textbereich unten','fau'), __('Text am Ende der Sidebar','fau'),true);	    
	    
	    

	return;
 }

/* Save the meta box's post/page metadata. */
function fau_save_metabox_page_sidebar( $post_id, $post ) {
	if ( !isset( $_POST['fau_metabox_page_sidebar_nonce'] ) || !wp_verify_nonce( $_POST['fau_metabox_page_sidebar_nonce'], basename( __FILE__ ) ) )
		return $post_id;


	/* Check if the current user has permission to edit the post. */
	if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		return;
	}

	
}

