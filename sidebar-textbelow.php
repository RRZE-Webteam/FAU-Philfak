<?php 

	$output = '';
	$title = get_post_meta( $post->ID, 'sidebar_title_below', true );
	if (strlen(trim($title))>1) {
	    $output .= '<h2 class="small">'.$title.'</h2>'."\n";
	}
	$text = get_post_meta( $post->ID, 'sidebar_text_below', true );
	if (!empty($text)) {
    	    $text = do_shortcode($text);

	    if(function_exists('mimetypes_to_icons')) {
		$output .= mimetypes_to_icons($text); 
	    } else 	{
		$output .= $text;
	    }
	}

	if (!empty($output)) {
	    echo '<aside class="widget">'."\n";
	    echo $output;
	    echo "</aside>\n";
	}

