<?php

/* 
 * Code fuer den Custom Type "ad" / Werbebanner
 */

function fau_get_ad($type, $withhr = true) {
    global $options;
    global $post;
    
    // werbebanner_seitlich   oder     werbebanner_unten
   $list = get_post_meta( $post->ID, $type, true );
   $class = '';  
   
   if ($type == 'werbebanner_unten') {
	$class = 'banner-ad-footer';
   } else {
        $class = 'banner-ad-right';
   }
   $out = '';
   
   if ((isset($list)) && (!empty($list))) {
       if (!is_array($list)) {
	    $val = $list;
	    $list = array();
	    $list[0] = $val;
       } 
       
       if ($withhr) {
	   $out .= "<hr>\n";
       }
       
       $out .= '<div class="'.$class.'">';
       foreach ($list as $id) {

	    $out .= '<div class="banner-ad">';	    
	    if (isset($options['url_banner-ad-notice'])) {
		$out .= '<a class="banner-ad-notice" href="'.$options['url_banner-ad-notice'].'">';
	    }
	    $out .= $options['title_banner-ad-notice'];
	    if (isset($options['url_banner-ad-notice'])) {
		  $out .= '</a>';
	    }
   		
	    $scriptcode = get_post_meta( $id, 'ad_script', true );
	    
	    if(isset($scriptcode)) {
		$out .=  html_entity_decode($scriptcode);
	    } else  {
		$link =    get_post_meta( $id, 'link', true ); 
		if($link) {
		    $out .=  '<a href="'.get_field('link', $id).'">';
		}
		$out .=  get_the_post_thumbnail($id, 'full');
		if($link) {
		    $out .=  '</a>';
		}
				
	    }
	    $out .= '</div>';

       }
       $out .= '</div>';
       return $out;

   }
   
}
