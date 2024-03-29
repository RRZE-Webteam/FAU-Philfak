<?php 


$list1 = '';
$list2 = '';
$titleblock1 = '';
$titleblock2 = '';

$linkblock1_number = get_theme_mod('advanced_page_sidebar_linkblock1_number');
if ($linkblock1_number > 0) {	
	    $sidebar_quicklinks = get_post_meta( $post->ID, 'sidebar_quicklinks', true );
	    // Prüfe auch alten ACF Rotz Inhalt
	    // wegen Rückwartscompatibilität bei der Hauptwebsite leider noch 
	    // nicht loschbar.
	    
	    $block_title = get_post_meta( $post->ID, 'fauval_sidebar_title_linkblock1', true );
	    if (strlen(trim($block_title))<1) {
		$oldtitle = get_post_meta( $post->ID, 'sidebar_title_quicklinks', true );
		if (strlen(trim($oldtitle))>0) {
		    $block_title = $oldtitle;
		}
	    }
	    if (strlen(trim($block_title))>1) {
		$titleblock1 .= '<h2>'.$block_title.'</h2>'."\n";
	    }
	    for ($i = 1; $i <= $linkblock1_number; $i++) {
		$name = 'fauval_linkblock1_link'.$i;
		$urlname= $name.'_url';
		$titlename= $name.'_title';
		
		$oldpageid =  get_post_meta( $post->ID, $name, true );
		$oldurl =  get_post_meta( $post->ID, $urlname, true );
		$oldtitle =  get_post_meta( $post->ID, $titlename, true );
		$c = $i-1;
		if (empty($oldpageid) && empty($oldurl) && empty($oldtitle)) {
		    if (isset($sidebar_quicklinks) && (isset($sidebar_quicklinks[$c]))) {
			$oldpageid = $sidebar_quicklinks[$c];
			if (isset($oldpageid) && ($oldpageid>0)) {
			    $oldtitle = get_the_title($oldpageid );
			    $oldurl = get_permalink($oldpageid );
			}
		    }
		} else {
		    if( empty($oldurl) && isset($oldpageid) && is_numeric($oldpageid) && ($oldpageid>0)) {
		    // Hole zur Sicherheit nochmal aktuelle URL
		    //  - deaktiviert, da es interne sprunglinks kaputt macht
			$oldurl = get_permalink($oldpageid);
		    }
		    if (empty(trim($oldtitle))) {
			$oldtitle = get_the_title($oldpageid );
		    }
		}
		if (!empty($oldurl)) {
		    $list1 .= "\t".'<li><a href="'.esc_url($oldurl).'">'.$oldtitle.'</a></li>'."\n";
		}
	    }   
}

$linkblock2_number = get_theme_mod('advanced_page_sidebar_linkblock2_number');
if ($linkblock2_number > 0) {	    
	     $sidebar_quicklinks = get_post_meta( $post->ID, 'sidebar_quicklinks_external', true );
	   	    // Alter ACF Rotz mit SubFields	    
	    
	    $block_title = get_post_meta( $post->ID, 'fauval_sidebar_title_linkblock2', true );
	     if (strlen(trim($block_title))>1) {
		if ($titleblock1) {
		    $titleblock2 = '<h2 class="second">'.$block_title.'</h2>'."\n"; 
		} else {
		    $titleblock2 = '<h2>'.$block_title.'</h2>'."\n"; 
		}
	    }
	   for ($i = 1; $i <= $linkblock2_number; $i++) {
		$name = 'fauval_linkblock2_link'.$i;
		$urlname= $name.'_url';
		$titlename= $name.'_title';
		
		$oldpageid =  get_post_meta( $post->ID, $name, true );
		$oldurl =  get_post_meta( $post->ID, $urlname, true );
		$oldtitle =  get_post_meta( $post->ID, $titlename, true );
		$c = $i-1;
		if (empty($oldpageid) && empty($oldurl) && empty($oldtitle)) {
		    if (!empty($sidebar_quicklinks)) {
			// Schau nach alten ACF Subfields
			$oldlinkname = 'sidebar_quicklinks_external_'.$c.'_sidebar_quicklinks_external_text';
			$oldlinkurl = 'sidebar_quicklinks_external_'.$c.'_sidebar_quicklinks_external_link';
			$oldurl =  get_post_meta( $post->ID, $oldlinkurl, true );
			$oldtitle =  get_post_meta( $post->ID, $oldlinkname, true );
		    }
		} else {
		    if(empty($oldurl) && isset($oldpageid) && is_numeric($oldpageid) && ($oldpageid>0)) {
		    // Hole zur Sicherheit nochmal aktuelle URL
			$oldurl = get_permalink($oldpageid);
		    }
		    if (empty(trim($oldtitle))) {
			$oldtitle = get_the_title($oldpageid );
		    }
		}
		if (!empty($oldurl) && (!empty($oldtitle))) {
		    $list2 .= "\t".'<li><a href="'.esc_url($oldurl).'">'.$oldtitle.'</a></li>'."\n"; 
		}
	    }
}
$output = '';
if ((strlen(trim($list1))>0) || (strlen(trim($list2))>0)) {
    // Es gibt eine Liste
    fau_use_sidebar(true);

    $output .= '<div class="widget quicklinks">'."\n";
   
     if (  (strlen(trim($titleblock2))>0) || (strlen(trim($titleblock1)>0))) {
	// Zwei Listen mit zwei Überschriften

	if (strlen(trim($list1))>0) {
	    $output .= $titleblock1;
	    $output .= '<ul>'."\n";
	    $output .= $list1;
	    $output .= '</ul>'."\n";
	}
	if (strlen(trim($list2))>0) {
	    $output .= $titleblock2;
	    $output .= '<ul>'."\n";
	    $output .= $list2;
	    $output .= '</ul>'."\n"; 
	}	 
	
    } else {
	if (strlen(trim($titleblock1))>0)  {
	    $output .= $titleblock1;
	} else {
	    $output .= $titleblock2;
	}
	 
	// Eine Liste mit einer Überschrift
	$output .= '<ul>'."\n";
	$output .= $list1;
	$output .= $list2;
	$output .= '</ul>'."\n";
    }
    $output .= '</div>'."\n";;
}

 if(function_exists('mimetypes_to_icons')) {
	$output = mimetypes_to_icons($output); 
 }

echo $output;

