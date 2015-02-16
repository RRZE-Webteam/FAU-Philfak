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
		    <select class="fullsize" multiple="1" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>">
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
   

if ( ! function_exists( 'fau_san' ) ) :  
    function fau_san($s){
	return filter_var(trim($s), FILTER_SANITIZE_STRING);
    }
endif;    
