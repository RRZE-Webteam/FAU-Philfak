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
		add_shortcode('synonym', array( $this, 'fau_synonym' ));
		add_shortcode('assistant', array( $this, 'fau_assistant' ));
		add_shortcode('glossary', array( $this, 'fau_glossary' ));
		add_shortcode('person', array( $this, 'fau_person' ));
		add_shortcode('persons', array( $this, 'fau_persons'));
		add_shortcode('organigram', array( $this, 'fau_organigram'));
		add_shortcode('downloads', array( $this, 'fau_downloads'));
		add_shortcode('hr', array( $this, 'fau_hr'));
	}
	
	function fau_hr ( $atts, $content = null) {
		return '<div class="hr"><hr></div>';
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
		
		if($category)
		{
			return $this->fau_downloads_recursive($category->term_id);
		}
		
		return;
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
						$return .= '<div class="accordion-inner">';

							$return .= $this->fau_downloads_recursive($category->term_id);

							$files = get_posts(array('post_type' => 'attachment', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
								array(
									'taxonomy' => 'attachment_document',
									'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
									'terms' => $category->term_id,
									'include_children' => false
									)
								), 'suppress_filters' => false));

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
	
	function fau_glossary( $atts, $content = null ) {
		extract(shortcode_atts(array(
			"category" => 'category'
			), $atts));
		
		$category = get_term_by('slug', $category, 'glossary_category');

		$posts = get_posts(array('post_type' => 'glossary', 'post_status' => 'publish', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
			array(
				'taxonomy' => 'glossary_category',
				'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
				'terms' => $category->term_id
				)
			), 'suppress_filters' => false));

		$return = '';
		
		$current = "A";
		$letters = array();
		
		
		$accordion = '<div class="accordion">';

		$i = 0;
		foreach($posts as $post)
		{
			$letter = get_the_title($post->ID);
			$letter = mb_substr($letter, 0, 1);
			$letter = mb_strtoupper($letter, 'UTF-8');

			if($i == 0 || $letter != $current)
			{
				$accordion .= '<h2 id="letter-'.$letter.'">'.$letter.'</h2>';
				$current = $letter;
				
				$letters[] = $letter;
			}
			
			$accordion .= '<div class="accordion-group white">';
				$accordion .= '<div class="accordion-heading">';
					$accordion .= '<a class="accordion-toggle" data-toggle="collapse" data-parent="accordion-" href="#collapse-'.$post->ID.'-'.$i.'">'.get_the_title($post->ID).'</a>';
				$accordion .= '</div>';
				$accordion .= '<div id="collapse-'.$post->ID.'-'.$i.'" class="accordion-body">';
					$accordion .= '<div class="accordion-inner">';
						
						$accordion .= get_field('description', $post->ID);
						
					$accordion .= '</div>';
				$accordion .= '</div>';
			$accordion .= '</div>';
			
			$i++;
		}
	
		$accordion .= '</div>';
		
		$return .= '<ul class="letters">';
		foreach($letters as $l)
		{
			$return .= '<li><a href="#letter-'.$l.'">'.$l.'</a></li>';
		}
		$return .= '</ul>';

		$return .= $accordion;

		return $return;
	}

	function fau_subpages( $atts, $content = null ) {
		return '<div class="row">' . do_shortcode( $content ) . '</div>';
	}
	
	function fau_synonym( $atts, $content = null) {
		extract(shortcode_atts(array(
			"slug" => 'slug'
			), $atts));
			
		$post = get_posts(array('name' => $slug, 'post_type' => 'synonym', 'post_status' => 'publish', 'numberposts' => 1));
		$id = $post[0]->ID;
		
		$return = get_field('synonym', $id);
		
		return $return;
	}
	
	function fau_person( $atts, $content = null) {
		extract(shortcode_atts(array(
			"slug" => 'slug',
			"showlink" => FALSE
			), $atts));
			
		$posts = get_posts(array('name' => $slug, 'post_type' => 'person', 'post_status' => 'publish'));
		$post = $posts[0];
		$id = $post->ID;

		return $this->fau_person_markup($id, $showlink);
	}
	
	function fau_persons( $atts, $content = null) {
		extract(shortcode_atts(array(
			"category" => 'category',
			"showlink" => FALSE
			), $atts));
			
		$category = get_term_by('slug', $category, 'persons_category');

		$posts = get_posts(array('post_type' => 'person', 'post_status' => 'publish', 'numberposts' => 1000, 'orderby' => 'title', 'order' => 'ASC', 'tax_query' => array(
			array(
				'taxonomy' => 'persons_category',
				'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
				'terms' => $category->term_id
				)
			), 'suppress_filters' => false));
					
		$content = '';
		
		foreach($posts as $post)
		{
			$content .= $this->fau_person_markup($post->ID, $showlink);
		}
			
		return $content;
	}
	
	function fau_person_markup($id, $showlink)
	{
		$content = '<div class="person content-person">';			
			$content .= '<div class="row">';
			
				if(has_post_thumbnail($id))
				{
					$content .= '<div class="span1 span-small">';
						$content .= get_the_post_thumbnail($id, 'person-thumb-bigger');
					$content .= '</div>';
				}
				
				$content .= '<div class="span3">';
					$content .= '<h3>';
						if(get_field('title', $id)) 	$content .= get_field('title', $id).' ';
						if(get_field('firstname', $id)) 	$content .= get_field('firstname', $id).' ';
						if(get_field('lastname', $id)) 		$content .= get_field('lastname', $id);
						if(get_field('title_suffix', $id)) 	$content .= ' '.get_field('title_suffix', $id);
					$content .= '</h3>';
					if(get_field('position', $id)) 		$content .= '<h4>'.get_field('position', $id).'</h4>';
					if(get_field('institution', $id))			$content .= '<div class="person-info person-info-institution">'.get_field('institution', $id).'</div>';
					if(get_field('phone', $id))			$content .= '<div class="person-info person-info-phone">'.get_field('phone', $id).'</div>';
					if(get_field('fax', $id))			$content .= '<div class="person-info person-info-fax">'.get_field('fax', $id).'</div>';
					if(get_field('email', $id))			$content .= '<div class="person-info person-info-email"><a href="mailto:'.get_field('email', $id).'">'.get_field('email', $id).'</a></div>';
					if(get_field('webseite', $id))		$content .= '<div class="person-info person-info-www"><a href="http://'.get_field('webseite', $id).'">'.get_field('webseite', $id).'</a></div>';
					if(get_field('adresse', $id))		$content .= '<div class="person-info person-info-address">'.get_field('adresse', $id).'</div>';
					if(get_field('raum', $id))			$content .= '<div class="person-info person-info-room">Raum '.get_field('raum', $id).'</div>';
					
					
				$content .= '</div>';
				$content .= '<div class="span3">';
					if(get_field('freitext', $id))		$content .= '<div class="person-info person-info-description">'.get_field('freitext', $id).'</div>';
					
					if($showlink && get_field('link', $id))			$content .= '<div class="person-info person-info-more"><a class="person-read-more" href="'.get_field('link', $id).'">Mehr ›</a></div>';
					
				$content .= '</div>';
			$content .= '</div>';
		
		$content .= '</div>';
		
		return $content;
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
					$return .= '<div class="accordion-inner">';
						
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




class FAUShortcodesRTE
{
    public function __construct()
    {
        add_action('admin_init', array($this, 'fau_shortcodes_rte_button'));
    }

    public function fau_shortcodes_rte_button()
    {
        if( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
        {
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