<?php

/* 
 * Default Constants and values for FAU THeme
 */
$defaultoptions = array(
    'js-version'		=> '1.1',
    'optionpage-tab-default'	=> 'startseite',
    'content-width'		=> 770,
    'src-fallback-slider-image' => get_template_directory_uri().'/img/slider-fallback.jpg',
    'slider-category'		=> 'header',
    'slider-catid'		=> 0,
    'slider-image-width'	=> 1260,
    'slider-image-height'	=> 350,    
    'start_header_count'	=> 5,
    'start_news_count'		=> 3,
    'breadcrumb_root'		=> 'fau.de',
    'socialmedia'		=> 1,
    'menu_pretitle_portal'	=> __('Portal', 'fau'),
    'menu_aftertitle_portal'	=> '',
    
   'contact_address_name'	=> __('Friedrich-Alexander-Universität', 'fau'),
   'contact_address_name2'	=> __('Erlangen-Nürnberg', 'fau'),
   'contact_address_street'	=> __('Schlossplatz 4', 'fau'),
   'contact_address_plz'	=> __('91054', 'fau'),
   'contact_address_ort'	=> __('Erlangen', 'fau'),
   
    'contact_address_country'	=> '',
    'display_nojs_notice'	=> 0,
    'display_nojs_note'		=> __('JavaScript wurde deaktiviert oder Ihr Browser unterstützt kein JavaScript. Alle Inhalte sind erreichbar, jedoch ist die Bedienung teilweise umständlicher.','fau'),
    'google-site-verification'	=> '',
    
); 


/*
 * Social Media 
 */
$default_socialmedia_liste = array(
    'delicious' => array(
	'name' => 'Delicious',
	'content'  => '',
	'active' => 0,
    ),
    'diaspora' => array(
	'name' => 'Diaspora',
	'content'  => '',
	'active' => 0,
    ),
    'facebook' => array(
	'name' => 'Facebook',
	'content'  => 'https://de-de.facebook.com/Uni.Erlangen.Nuernberg',
	'active' => 1,
    ),
    'twitter' => array(
	'name' => 'Twitter',
	'content'  => 'https://twitter.com/UniFAU',
	'active' => 1,
    ),
    'gplus' => array(
	'name' => 'Google Plus',
	'content'  => '',
	'active' => 0,
    ),
    'flattr' => array(
	'name' => 'Flattr',
	'content'  => '',
	'active' => 0,
    ),
    'flickr' => array(
	'name' => 'Flickr',
	'content'  => '',
	'active' => 0,
    ),
  
    'identica' => array(
	'name' => 'Identica',
	'content'  => '',
	'active' => 0,
    ),
    'itunes' => array(
	'name' => 'iTunes',
	'content'  => '',
	'active' => 0,
    ),
    'skype' => array(
	'name' => 'Skype',
	'content'  => '',
	'active' => 0,
    ),
    
    'youtube' => array(
	'name' => 'YouTube',
	'content'  => '',
	'active' => 0,
    ),
    'xing' => array(
	'name' => 'Xing',
	'content'  => 'https://www.xing.com/net/alumnifau',
	'active' => 1,
    ),
    'tumblr' => array(
	'name' => 'Tumblr',
	'content'  => '',
	'active' => 0,
    ),
    'github' => array(
	'name' => 'GitHub',
	'content'  => '',
	'active' => 0,
    ),
    'appnet' => array(
	'name' => 'App.Net',
	'content'  => '',
	'active' => 0,
    ),
    'feed' => array(
	'name' => 'RSS Feed',
	'content'  => get_bloginfo( 'rss2_url' ),
	'active' => 1,
    ),
    'friendica' => array(
	'name' => 'Friendica',
	'content'  => '',
	'active' => 0,
    ),
    'pinterest' => array(
	'name' => 'Pinterest',
	'content'  => 'http://www.pinterest.com/unifau/',
	'active' => 1,
    ),
); 

/* 
 * Default Links for Topmenu , can be overwritten bei menu  
 */
$default_toplink_liste = array(    
    'link1'  => array(
	'name'	    => __('UnivIS', 'fau' ),
	'content'  => 'http://univis.fau.de/',
	'active'    => 1,
    ),
    'link2'  => array(
	'name'	    => __('Lageplan', 'fau' ),
	'content'  => 'https://karte.fau.de/',
	'active'    => 0,
    ),
    'link3'  => array(
	'name'	    => __('Universitätsklinikum', 'fau' ),
	'content'  => 'http://www.uk-erlangen.de/',
	'active'    => 1,
    ),
  
);

/* 
 * Default Faculty List for Submenu , can be overwritten bei menu  
 */
$default_faculty_liste = array(    
    'link1'  => array(
	'name'	    => __('Philosophische Fakultät und Fachbereich Theologie', 'fau' ),
	'content'  => 'http://www.phil.fau.de/',
	'active'    => 1,
    ),
    'link2'  => array(
	'name'	    => __('Rechts- und Wirtschaftswissenschaftliche Fakultät', 'fau' ),
	'content'  => 'https://www.rw.fau.de/',
	'active'    => 0,
    ),
    'link3'  => array(
	'name'	    => __('Medizinische Fakultät', 'fau' ),
	'content'  => 'http://www.dekanat.med.uni-erlangen.de/',
	'active'    => 1,
    ),
    'link4'  => array(
	'name'	    => __('Naturwissenschaftliche Fakultät', 'fau' ),
	'content'  => 'https://www.nat.fau.de/',
	'active'    => 0,
    ),
    'link5'  => array(
	'name'	    => __('Technische Fakultät', 'fau' ),
	'content'  => 'https://www.tf.fau.de/',
	'active'    => 0,
    ),
);


 $categories=get_categories(array('orderby' => 'name','order' => 'ASC'));
 foreach($categories as $category) {
     if (!is_wp_error( $category )) {
	$currentcatliste[$category->cat_ID] = $category->name.' ('.$category->count.' '.__('Einträge','fau').')';
     }
 }        

$setoptions = array(
   'fau_theme_options'   => array(
       
       
        'startseite'   => array(
           'tabtitle'   => __('Startseite', 'fau'),
           'fields' => array(
                            

	       'start_news_count'=> array(
                  'type'    => 'select',
                  'title'   => __( 'Zahl der News', 'fau' ),
                  'label'   => __( 'Anzahl der News auf der Startseite unterhalb des Sliders', 'fau' ),
		   'liste'   => array(2 => 2,3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7),
                  'default' => $defaultoptions['start_news_count'],
              ),  
	       
              'sliderpars'  => array(
                  'type'    => 'section',
                  'title'   => __( 'Slider', 'fau' ),                      
              ),
              
	     'start_header_count'=> array(
                  'type'    => 'select',
                  'title'   => __( 'Zahl der Slides', 'fau' ),
                  'label'   => __( 'Anzahl der Slides von verlinkten Top-Artikeln', 'fau' ),
		  'liste'   => array(2 => 2,3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7),
                  'default' => $defaultoptions['start_header_count'],
                   'parent'  => 'sliderpars'
              ), 

               
              'slider-catid' => array(
                  'type'    => 'select',
                  'title'   => __( 'Kategorie', 'fau' ),
                  'label'   => __( 'Bitte wählen Sie die Kategorie der Artikel aus die im Slider erscheinen sollen.', 'fau' ),
                  'liste'   => $currentcatliste,
                  'default' => $defaultoptions['slider-catid'],
                   'parent'  => 'sliderpars'
              ), 
              

               
               
          )
       ), 
       'socialmedia'   => array(
           'tabtitle'   => __('Social Media', 'fau'),
           'fields' => array(
              
              'socialmedia' => array(
                  'type'    => 'bool',
                  'title'   => __( 'Buttons anzeigen', 'fau' ),
                  'label'   => __( 'Welche Social Media Buttons sollen auf der Startseite angezeigt werden.', 'fau' ),
                 
                  'default' => $defaultoptions['socialmedia'],
              ),  
	      'sm-list'  => array(
		  'type'    => 'urlchecklist',
		  'title'   => __( 'Social Media Portale', 'fau' ),
		  'liste'   => $default_socialmedia_liste,
	      ), 
	                      
          )
       ),
       'allgemeines'   => array(
           'tabtitle'   => __('Allgemeine Einstellungen', 'fau'),
           'fields' => array(
              
              'menu_pretitle_portal' => array(
                  'type'    => 'text',
                  'title'   => __( 'Menü Portal-Button (Vortitel)', 'fau' ),
                  'label'   => __( 'Begriff vor dem Titel des gewählten Menüs', 'fau' ),               
                  'default' => $defaultoptions['menu_pretitle_portal'],
              ),  
	        'menu_aftertitle_portal' => array(
                  'type'    => 'text',
                  'title'   => __( 'Menü Portal-Button (Nachtitel)', 'fau' ),
                  'label'   => __( 'Begriff nach dem Titel des gewählten Menüs', 'fau' ),               
                  'default' => $defaultoptions['menu_aftertitle_portal'],
              ),  
	     'google-site-verification' => array(
                  'type'    => 'text',
                  'title'   => __( 'Google Site Verification', 'fau' ),
                  'label'   => __( 'Meta-Tag zur Identifikation der Inhaberschaft gegenüber Google. geben Sie hier den Content-Bestand an für die Identifikation mittels Meta-Tag.', 'fau' ),               
                  'default' => $defaultoptions['google-site-verification'],
              ),  
   
          )
       ),
       'contact'   => array(
           'tabtitle'   => __('Kontaktdaten', 'fau'),
           'fields' => array(
               'pubadresse'  => array(
                  'type'    => 'section',
                  'title'   => __( 'Öffemtliche Adresse im Fußteil', 'fau' ),                      
              ),
              'contact_address_name' => array(
                  'type'    => 'text',
                  'title'   => __( 'Adressat', 'fau' ),
                  'label'   => __( 'Erste Zeile der Adresse', 'fau' ),               
                  'default' => $defaultoptions['contact_address_name'],
		  'parent'  => 'pubadresse'
              ),  
	       'contact_address_name2' => array(
                  'type'    => 'text',
                  'title'   => __( 'Adressat (Zusatz)', 'fau' ),
                  'label'   => __( 'Zweite Zeile der Adresse', 'fau' ),               
                  'default' => $defaultoptions['contact_address_name2'],
		    'parent'  => 'pubadresse'
              ),  
	      'contact_address_strasse' => array(
                  'type'    => 'text',
                  'title'   => __( 'Strasse', 'fau' ),
                  'label'   => __( 'Strasse inkl. Hausnummer', 'fau' ),               
                  'default' => $defaultoptions['contact_address_street'],
		   'parent'  => 'pubadresse'
              ),  
	       'contact_address_plz' => array(
                  'type'    => 'text',
                  'title'   => __( 'PLZ', 'fau' ),
                  'label'   => __( 'Postleitzahl', 'fau' ),               
                  'default' => $defaultoptions['contact_address_plz'],
		    'parent'  => 'pubadresse'
              ),  
	       'contact_address_ort' => array(
                  'type'    => 'text',
                  'title'   => __( 'Ort', 'fau' ),
                  'label'   => __( 'Ortsname', 'fau' ),               
                  'default' => $defaultoptions['contact_address_ort'],
		    'parent'  => 'pubadresse'
              ),  
	       'contact_address_country' => array(
                  'type'    => 'text',
                  'title'   => __( 'Land', 'fau' ),
                  'label'   => __( 'Optionale Landesangabe', 'fau' ),               
                  'default' => $defaultoptions['contact_address_country'],
		  'parent'  => 'pubadresse'
              ),  
	     
   
          )
       ),
    )
);
	       