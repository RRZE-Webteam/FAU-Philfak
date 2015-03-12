<?php



/*
 * Hilfereiche Funktionen für die Custom Fields
 */

if ( ! function_exists( 'fau_form_textarea' ) ) :
    function fau_form_textarea($name= '', $prevalue = '', $labeltext = '', $cols=60, $rows=5, $howtotext = '') {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	if (isset($name) &&  isset($labeltext))  {
	    echo "<p>\n";
	    echo '	<label for="'.$name.'">';
	    echo $labeltext;
	    echo "</label></p>\n";
	    echo '	<textarea name="'.$name.'" id="'.$name.'" rows="'.$rows.'" cols="'.$cols.'">'.$prevalue.'</textarea>';

	    if (strlen(trim($howtotext))) {
		echo '<p class="howto">';
		echo $howtotext;
		echo "</p>\n";
	    }
	} else {
	    echo _('Ungültiger Aufruf von fau_form_textarea() - Name oder Label fehlt.', 'fau');
	}
    }
endif;
if ( ! function_exists( 'fau_form_wpeditor' ) ) :
    function fau_form_wpeditor($name= '', $prevalue = '', $labeltext = '', $howtotext = '', $small = true) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	if (isset($name) &&  isset($labeltext))  {
	    echo "<p>\n";
	    echo '	<label for="'.$name.'">';
	    echo $labeltext;
	    echo "</label></p>\n";
	    if ($small==true) {
		wp_editor( $prevalue, $name, array('teeny' => true, 'textarea_rows' => 5, 'media_buttons' => false) );
	    } else {
		wp_editor( $prevalue, $name );
	    }
	    if (strlen(trim($howtotext))) {
		echo '<p class="howto">';
		echo $howtotext;
		echo "</p>\n";
	    }
	} else {
	    echo _('Ungültiger Aufruf von fau_form_wpeditor() - Name oder Label fehlt.', 'fau');
	}
    }
endif;
if ( ! function_exists( 'fau_form_text' ) ) :
    function fau_form_text($name= '', $prevalue = '', $labeltext = '', $howtotext = '', $placeholder='', $size = 0) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	if (isset($name) &&  isset($labeltext))  {
	    echo "<p>\n";
	    echo '	<label for="'.$name.'">';
	    echo $labeltext;
	    echo "</label><br />\n";
	    echo '	<input type="text" class="large-text" name="'.$name.'" id="'.$name.'" value="'.$prevalue.'"';
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
endif;

if ( ! function_exists( 'fau_form_url' ) ) :
    function fau_form_url($name= '', $prevalue = '', $labeltext = '', $howtotext = '', $placeholder='http://', $size = 0) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	if (isset($name) &&  isset($labeltext))  {
	    echo "<p>\n";
	    echo '	<label for="'.$name.'">';
	    echo $labeltext;
	    echo "</label><br />\n";
	    echo '	<input type="url" class="large-text" name="'.$name.'" id="'.$name.'" value="'.$prevalue.'"';
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
	    echo _('Ungültiger Aufruf von fau_form_url() - Name oder Label fehlt.', 'fau');
	}
    }
endif;    

if ( ! function_exists( 'fau_form_onoff' ) ) :
    function fau_form_onoff($name= '', $prevalue = 0, $labeltext = '',  $howtotext = '' ) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	if (isset($name) &&  isset($labeltext))  { ?>
	    <div class="schalter">
		<select class="onoff" name="<?php echo $name; ?>" id="<?php echo $name; ?>">
		    <option value="0" <?php selected(0,$prevalue);?>>Aus</option>
		    <option value="1" <?php selected(1,$prevalue);?>>An</option>
		</select>
		<label for="<?php echo $name; ?>">
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
endif;    
    
if ( ! function_exists( 'fau_form_select' ) ) :
    function fau_form_select($name= '', $liste = array(), $prevalue, $labeltext = '',  $howtotext = '', $showempty=1, $emptytext = '' ) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	$emptytext = fau_san( $emptytext );

	if (is_array($liste) && isset($name) &&  isset($labeltext))  { ?>
	    <div class="liste">
		<p><label for="<?php echo $name; ?>">
		    <?php echo $labeltext; ?>
		    </label></p>
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
		<?php 
		if ($showempty==1) { 
		    echo '<option value="">';
		    if (!empty($emptytext)) {
			echo $emptytext;
		    } else {
			_e('Keine Auswahl','fau');
		    }
		    echo '</option>';
		}

		foreach($liste as $entry => $value){  ?>
		    <option value="<?php echo $entry; ?>" <?php selected($entry,$prevalue);?>><?php echo $value; ?></option>
		<?php } ?>	
		</select>

	    </div>
	    <?php 
	    if (strlen(trim($howtotext))) {
		echo '<p class="howto">';
		echo $howtotext;
		echo "</p>\n";
	    }
	} else {
	    echo _('Ungültiger Aufruf von fau_form_select() - Array, Name oder Label fehlt.', 'fau');
	}
    }
endif;    
    
if ( ! function_exists( 'fau_form_multiselect' ) ) :  
    function fau_form_multiselect($name= '', $liste = array(), $prevalues = array(), $labeltext = '',  $howtotext = '', $showempty=1, $emptytext = '' ) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	$emptytext = fau_san( $emptytext );

	if (is_array($liste) && isset($name) &&  isset($labeltext))  { ?>
	    <div class="liste">
		<p><label for="<?php echo $name; ?>">
		    <?php echo $labeltext; ?>
		    </label></p>
		    <select class="fullsize" size="5" multiple="1" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>">
		<?php 
		if ($showempty==1) { 
		    echo '<option value="">';
		    if (!empty($emptytext)) {
			echo $emptytext;
		    } else {
			_e('Keine Auswahl','fau');
		    }
		    echo '</option>';
		}

		foreach($liste as $entry => $value){  
		    echo '<option value="'.$entry.'"';
		    if (is_array($prevalues)) {
			foreach($prevalues as $pnum){
			    if ($entry==$pnum)
				echo ' selected="selected"';
			}
		    }
		    echo '>';		
		    echo $value;
		    echo '</option>';

		} ?>	
		</select>

	    </div>
	    <?php 
	    if (strlen(trim($howtotext))) {
		echo '<p class="howto">';
		echo $howtotext;
		echo "</p>\n";
	    }
	} else {
	    echo _('Ungültiger Aufruf von fau_form_multiselect() - Array, Name oder Label fehlt.', 'fau');
	}
    }
endif;    
   


if ( ! function_exists( 'fau_form_image' ) ) :
    function fau_form_image($name= '', $preimageid = 0, $labeltext = '',  $howtotext = '', $width=300, $height=200 ) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	if (isset($name) &&  isset($labeltext))  {
	    echo '<p><label for="'.$name.'">';
	    echo $labeltext;
	    echo "</label></p>\n";

	    echo '<div class="uploader">';
	    
	    $image = '';
	    $imagehtml = '';
	    if (isset($preimageid) && ($preimageid>0)) {
		$image = wp_get_attachment_image_src($preimageid, 'full'); 
		if (isset($image)) {
		    $imagehtml = '<img class="image_show_'.$name.'" src="'.$image[0].'" width="'.$width.'" height="'.$height.'" alt="">';
		}
	    }

	    echo '<div class="previewimage showimg_'.$name.'">';
	    if (!empty($imagehtml)) {  
		echo $imagehtml;
	    } 
	    echo "</div>\n"; ?>		

	    <input type="hidden" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo sanitize_key( $preimageid ) ; ?>" />
	    

	    <input class="button" name="image_button_<?php echo $name; ?>" id="image_button_<?php echo $name; ?>" value="<?php _e('Bild auswählen', 'fau'); ?>" />
	    <small><a href="#" class="image_remove_<?php echo $name; ?>"><?php _e( "Entfernen", 'fau' );?></a></small>
	    <br><p class="howto"><?php echo $howtotext; ?>	      
	    </p><script>
	    jQuery(document).ready(function() {
		jQuery('#image_button_<?php echo $name; ?>').click(function()  {
		    wp.media.editor.send.attachment = function(props, attachment) {
			jQuery('#<?php echo $name; ?>').val(attachment.id);
			htmlshow = "<img src=\""+attachment.url + "\" width=\"<?php echo $width;?>\" height=\"<?php echo $height;?>\">";  					   
			jQuery('.showimg_<?php echo $name; ?>').html(htmlshow);

		    }
		    wp.media.editor.open(this);
		    return false;
		});
	    });
	    jQuery(document).ready(function() {
		jQuery('.image_remove_<?php echo $name; ?>').click(function()   {
			jQuery('#<?php echo $name; ?>').val('');
			jQuery('.showimg_<?php echo $name; ?>').html('<?php _e('Kein Bild ausgewählt.', 'fau'); ?>');
			return false;
		});
	    });
	   </script> 		    	    

	   <?php 

	
	} else {
	    echo _('Ungültiger Aufruf von fau_form_image() - Name oder Label fehlt.', 'fau');
	}
    }
 endif;
    




if ( ! function_exists( 'fau_form_link' ) ) :
    function fau_form_link($name= '', $pretitle ='', $preurl ='' , $labeltext = '',  $howtotext = '' ) {
	$name = fau_san( $name );
	$labeltext = fau_san( $labeltext );
	if (isset($name) &&  isset($labeltext))  {	    
	    wp_enqueue_script( 'wp-link' );
	    echo '<div class="linkeingabe">';
	    $rand = rand();
	    echo '<h2>'.$labeltext.'</h2>';
	     if (strlen(trim($howtotext))) {
		echo '<p class="howto">';
		echo $howtotext;
		echo "</p>\n";
	    }
	     echo '<div class="linkauswahl" id="container_'.$rand.'">';
	    echo "<p>\n";
	    echo '<label for="title_'.$rand.'_'.$name.'">'.__('Titel','fau');   
	    echo "</label><br />\n";
	    echo '<input type="text" class="large-text" name="title_'.$name.'" id="title_'.$rand.'_'.$name.'" value="'.$pretitle.'">';
	    echo "</p>\n";
	    
	    echo "<p>\n";
	    echo '<label for="url_'.$rand.'_'.$name.'">'.__('URL','fau');  
	    echo "</label><br />\n";
	    echo '<input type="url" class="large-text" name="url_'.$name.'" id="url_'.$rand.'_'.$name.'" value="'.$preurl.'" placeholder="https://">';
	    echo '<input class="button link_button_'.$name.'" name="link_button_'.$name.'" id="link_button_'.$name.'" type="button" value="'.__('Wähle Link','fau').'">';

	    echo "</p>";
	   
	   
	    ?>
	   <script>
		var _link_sideload = false; 
		var link_btn_<?php echo $name?> = (function($){
		    var _link_sideload = false; 
		    function _init() {
			$('.link_button_<?php echo $name?>').on('click', function(event) {
			    _addLinkListeners();
			    _link_sideload = false;
			    var link_val_container = $('#url_<?php echo $rand?>_<?php echo $name?>');
			    window.wpActiveEditor = true;
			    _link_sideload = true;
			    wpLink.open();
			    wpLink.textarea = $(link_val_container);
			    return false;
			});
		    }
		    function _addLinkListeners() {
			$('body').on('click', '#wp-link-submit', function(event) {
			    var linkAtts = wpLink.getAttrs();
			    $('#url_<?php echo $rand?>_<?php echo $name?>').val(linkAtts.href);
			    $('#title_<?php echo $rand?>_<?php echo $name?>').val(linkAtts.title);
			    _removeLinkListeners();
			    return false;
			});
			$('body').on('click', '#wp-link-cancel', function(event) {
			    _removeLinkListeners();
			    return false;
			});
		    }

		    function _removeLinkListeners() {
			if(_link_sideload){
			    if ( typeof wpActiveEditor != 'undefined') {
				wpActiveEditor = undefined;
			    }
			}
			wpLink.close();
			wpLink.textarea = $('html');//focus on document
			$('body').off('click', '#wp-link-submit');
			$('body').off('click', '#wp-link-cancel');
		    }
		    return {
			init:       _init,
		    };
		    })(jQuery);
	   
	    jQuery(document).ready(function($) {	 
		 link_btn_<?php echo $name?>.init();
	    });
	  
	   </script> 		    	    
	   <?php 
         echo "</div>\n";
	 echo "</div>\n";
	
	} else {
	    echo _('Ungültiger Aufruf von fau_form_link() - Name oder Label fehlt.', 'fau');
	}
    }
 endif;
    



if ( ! function_exists( 'fau_san' ) ) :  
    function fau_san($s){
	return filter_var(trim($s), FILTER_SANITIZE_STRING);
    }
endif;    
