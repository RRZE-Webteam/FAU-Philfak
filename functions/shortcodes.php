<?php
/**
* @package WordPress
* @subpackage FAU
* @since FAU 1.0
*/

class FAUShortcodes {

	function __construct() {
		remove_filter( 'the_content', 'wpautop' );
		add_filter( 'the_content', 'wpautop' , 12);
		add_action( 'init', array( $this, 'add_shortcodes' ) ); 
	}

	function add_shortcodes() {
		add_shortcode('assistant', array( $this, 'fau_assistant' ));
		add_shortcode('organigram', array( $this, 'fau_organigram'));
		add_shortcode('downloads', array( $this, 'fau_downloads'));
		add_shortcode('hr', array( $this, 'fau_hr'));
	}
	
	function fau_hr ( $atts, $content = null) {
		return '<hr>';
	}
	
	function fau_organigram( $atts, $content = null) {
		extract(shortcode_atts(array(
			"menu" => 'menu'
			), $atts));
			
		return wp_nav_menu( array('menu' => $menu, 'container' => false, 'menu_id' => 'organigram', 'menu_class' => 'organigram', 'echo' => 0));
	}
	
	function fau_downloads( $atts, $content = null) {
		extract(shortcode_atts(array(
			"category" => 'category'
			), $atts));
			
		$category = get_term_by('slug', $category, 'attachment_document');
		
		$return = '';
		
		if($category)
		{
			$return .= $this->fau_downloads_recursive($category->term_id);
			
			$files = get_posts(array('post_type' => 'attachment', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
					 array(
						'taxonomy' => 'attachment_document',
						'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
						'terms' => $category->term_id,
						'include_children' => false
						)
					), 
				'suppress_filters' => true));

			if($files)
			{
				$return .= '<ul class="files">';
					foreach($files as $file)
					{	
						$return .= '<li><a href="'.$file->guid.'">'.$file->post_title.'</a></li>';
					}
				$return .= '</ul>';
			}
		}
		
		return $return;
	}
	
	function fau_downloads_recursive($term_id)
	{
		$categories = get_terms(array('attachment_document'), array('parent' => $term_id, 'hide_empty' => false));
		
		$return = '';
			
		if($categories)
		{
			$return .= '<div class="accordion">';

			$i = 0;

			foreach($categories as $category)
			{
				$return .= '<div class="accordion-group">';
					$return .= '<div class="accordion-heading">';
						$return .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="accordion-" href="#collapse-downloads-'.$category->term_id.'-'.$i.'">'.$category->name.'</a>';
					$return .= '</div>';
					$return .= '<div id="collapse-downloads-'.$category->term_id.'-'.$i.'" class="accordion-body">';
						$return .= '<div class="accordion-inner clearfix">';

							$return .= $this->fau_downloads_recursive($category->term_id);

							$files = get_posts(array('post_type' => 'attachment', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
									 array(
										'taxonomy' => 'attachment_document',
										'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
										'terms' => $category->term_id,
										'include_children' => false
										)
									), 
								'suppress_filters' => true));

							if($files)
							{
								$return .= '<ul class="files">';
									foreach($files as $file)
									{	
										$return .= '<li><a href="'.$file->guid.'">'.$file->post_title.'</a></li>';
									}
								$return .= '</ul>';
							}

						$return .= '</div>';
					$return .= '</div>';
				$return .= '</div>';

				$i++;
			}

			$return .= '</div>';
		}

		return $return;
	}
	
	function fau_subpages( $atts, $content = null ) {
		return '<div class="row">' . do_shortcode( $content ) . '</div>';
	}
		
		
	function fau_assistant( $atts, $content = null) {
		extract(shortcode_atts(array(
			"id" => 'id'
			), $atts));
			
		$return = '';
		
		$return .= '<div class="accordion">';

		$pages = get_pages(array('sort_order' => 'ASC', 'sort_column' => 'menu_order', 'parent' => $id, 'hierarchical' => 0));
		$i = 0;
		foreach($pages as $page)
		{
			$return .= '<div class="accordion-group">';
				$return .= '<div class="accordion-heading">';
					$return .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="accordion-" href="#collapse-'.$page->ID.'-'.$i.'">'.$page->post_title.'</a>';
				$return .= '</div>';
				$return .= '<div id="collapse-'.$page->ID.'-'.$i.'" class="accordion-body">';
					$return .= '<div class="accordion-inner clearfix">';
						
						$subpages = get_pages(array('sort_order' => 'ASC', 'sort_column' => 'menu_order', 'parent' => $page->ID, 'hierarchical' => 0));
						
						if(count($subpages) > 0)
						{
							$return .= '<div class="assistant-tabs">';

								$return .= '<ul class="assistant-tabs-nav">';

								$j = 0;
								foreach($subpages as $subpage)
								{
									if($j == 0) $class = 'active';
									else $class = '';

									$return .= '<li><a href="#accordion-'.$page->ID.'-'.$i.'-tab-'.$j.'" class="accordion-tabs-nav-toggle '.$class.'">'.$subpage->post_title.'</a></li>';
									$j++;
								}

								$return .= '</ul>';

								$j = 0;
								foreach($subpages as $subpage)
								{
									if($j == 0) $class = 'assistant-tab-pane-active';
									else $class = '';

									$return .= '<div class="assistant-tab-pane '.$class.'" id="accordion-'.$page->ID.'-'.$i.'-tab-'.$j.'">';
										$return .= '<p>'.do_shortcode($subpage->post_content).'</p>';
									$return .= '</div>';

									$j++;
								}

							$return .= '</div>';
						}
						else
						{
							$return .= '<p>'.do_shortcode($page->post_content).'</p>';
						}
						
						
					$return .= '</div>';
				$return .= '</div>';
			$return .= '</div>';
			
			$i++;
		}
		
		
		$return .= '</div>';
		
		return $return;
	}
	
}
new FAUShortcodes();

if ( ! function_exists( 'fau_glossary' ) ) :  
    function fau_glossary( $atts, $content = null ) {
            extract(shortcode_atts(array(
                    "category" => 'category',
		    "id"    => 'id',
		    "color" => 'color'
                    ), $atts));

	    
	    if (isset($id) && intval($id)>0) {
		
		 
		$title = get_the_title($id);
		$letter = get_the_title($id);
		$letter = mb_substr($letter, 0, 1);
		$letter = mb_strtoupper($letter, 'UTF-8');
		$content = apply_filters( 'the_content',  get_post_field('post_content',$id) );
		$content = str_replace( ']]>', ']]&gt;', $content );
		if ( isset($content) && (mb_strlen($content) > 1)) {
		    $desc = $content;
		} else {
		    $desc = get_post_meta( $id, 'description', true );
		}
		
		$result = '<article class="accordionbox glossary" id="letter-'.$letter.'">'."\n";
		
		if (isset($color) && strlen(fau_san($color))>0) {
		    $addclass= fau_san($color);
		     $result .= '<header class="'.$addclass.'"><h2>'.$title.'</h2></header>'."\n";
		} else {		
		    $result .= '<header><h2>'.$title.'</h2></header>'."\n";
		}
		$result .= '<div class="body">'."\n";
		$result .= $desc."\n";
		$result .= '</div>'."\n";
		$result .= '</article>'."\n";
		return $result;
		
	    } else {
		$category = get_term_by('slug', $category, 'glossary_category');

		if ($category) {
		    $catid = $category->term_id;
		    $posts = get_posts(array('post_type' => 'glossary', 'post_status' => 'publish', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
			array(
				'taxonomy' => 'glossary_category',
				'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
				'terms' => $catid
				)
			), 'suppress_filters' => false));
		} else {
		    $posts = get_posts(array('post_type' => 'glossary', 'post_status' => 'publish', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'suppress_filters' => false));
		}
		$return = '';

		$current = "A";
		$letters = array();


		$accordion = '<div class="accordion">'."\n";

		$i = 0;
		foreach($posts as $post) {
			$letter = get_the_title($post->ID);
			$letter = mb_substr($letter, 0, 1);
			$letter = mb_strtoupper($letter, 'UTF-8');

			if($i == 0 || $letter != $current) {
				$accordion .= '<h2 id="letter-'.$letter.'">'.$letter.'</h2>'."\n";
				$current = $letter;
				$letters[] = $letter;
			}

			$accordion .= '<div class="accordion-group white">'."\n";
			$accordion .= '  <div class="accordion-heading">'."\n";
			$accordion .= '     <a name="'.$post->post_name.'" class="accordion-toggle" data-toggle="collapse" data-parent="accordion-" href="#collapse-'.$post->ID.'-'.$i.'">'.get_the_title($post->ID).'</a>'."\n";
			$accordion .= '  </div>'."\n";
			$accordion .= '  <div id="collapse-'.$post->ID.'-'.$i.'" class="accordion-body">'."\n";
			$accordion .= '    <div class="accordion-inner">'."\n";

			$content = apply_filters( 'the_content',  get_post_field('post_content',$post->ID) );
			$content = str_replace( ']]>', ']]&gt;', $content );
			if ( isset($content) && (mb_strlen($content) > 1)) {
			    $desc = $content;
			} else {
			    $desc = get_post_meta( $post->ID, 'description', true );
			}
			$accordion .= $desc;

			$accordion .= '    </div>'."\n";
			$accordion .= '  </div>'."\n";
			$accordion .= '</div>'."\n";

			$i++;
		}

		$accordion .= '</div>'."\n";

		$return .= '<ul class="letters">'."\n";

		$alphabet = range('A', 'Z');
		foreach($alphabet as $a)  {
			if(in_array($a, $letters)) {
				$return .= '<li><a href="#letter-'.$a.'">'.$a.'</a></li>';
			}  else {
				$return .= '<li>'.$a.'</li>';
			}
		}

		$return .= '</ul>'."\n";

		$return .= $accordion;

		return $return;
	    }
    }
endif;  
add_shortcode('glossary', 'fau_glossary' );

 
if ( ! function_exists( 'fau_synonym' ) ) :  
    function fau_synonym( $atts, $content = null) {
            extract(shortcode_atts(array(
                    "slug" => 'slug',
		    "id" => 'id'
                    ), $atts));
	     $return = '';
	    if (isset($id) && intval($id) && $id>0) {
		// $post = get_posts(array('id' => $id, 'post_type' => 'synonym', 'post_status' => 'publish'));	
		 $return = get_post_meta( $id, 'synonym', true );
	    } else {
		$post = get_posts(array('name' => $slug, 'post_type' => 'synonym', 'post_status' => 'publish', 'numberposts' => 1));
		 if ($post)  {
			$id = $post[0]->ID;		
			$return = get_post_meta( $id, 'synonym', true );
		 }
	    }
	    return $return;
           
    }
endif;
 add_shortcode('synonym', 'fau_synonym' );


class FAUShortcodesRTE
{
    public function __construct()
    {
        add_action('admin_init', array($this, 'fau_shortcodes_rte_button'));
    }

    public function fau_shortcodes_rte_button()
    {
        if( current_user_can('edit_posts') &&  current_user_can('edit_pages') ) {
            add_filter( 'mce_external_plugins', array($this, 'fau_rte_add_buttons' ));
            add_filter( 'mce_buttons', array($this, 'fau_rte_register_buttons' ));
        }
    }

    public function fau_rte_add_buttons( $plugin_array )
    {
        $plugin_array['faurteshortcodes'] = get_template_directory_uri().'/js/tinymce-shortcodes.js';

        return $plugin_array;
    }

    public function fau_rte_register_buttons( $buttons )
    {
        array_push( $buttons, 'separator', 'faurteshortcodes' );
        return $buttons;
    }

}

new FAUShortcodesRTE();



?>