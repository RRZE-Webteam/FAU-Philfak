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
 * Default Link List for Submenus , can be overwritten bei Menu  
 */
$default_link_liste = array( 
	'faculty' => array(    
	    '_title'	=> __('Fakultäten','fau'),
	    'link1'  => array(
		'name'	    => __('Philosophische Fakultät und Fachbereich Theologie', 'fau' ),
		'content'  => 'http://www.phil.fau.de/',
		'class'	    => 'philfak',
	    ),
	    'link2'  => array(
		'name'	    => __('Rechts- und Wirtschaftswissenschaftliche Fakultät', 'fau' ),
		'content'  => 'https://www.rw.fau.de/',
		'class'	    => 'rwfak',
	    ),
	    'link3'  => array(
		'name'	    => __('Medizinische Fakultät', 'fau' ),
		'content'  => 'http://www.dekanat.med.uni-erlangen.de/',
		'class'	    => 'medfak',
	    ),
	    'link4'  => array(
		'name'	    => __('Naturwissenschaftliche Fakultät', 'fau' ),
		'content'  => 'https://www.nat.fau.de/',
		'class'	    => 'natfak',
	    ),
	    'link5'  => array(
		'name'	    => __('Technische Fakultät', 'fau' ),
		'content'  => 'https://www.tf.fau.de/',
		'class'	    => 'techfak',
	    ),
	),
	'centers' => array(    
	    '_title'	=> __('Einrichtungen','fau'),
	    'link1'  => array(
		'name'	    => __('Universitätsbibliothek', 'fau' ),
		'content'  => 'http://www.ub.fau.de/',
	    ),
	    'link2'  => array(
		'name'	    => __('Rechenzentrum', 'fau' ),
		'content'  => 'https://www.rrze.fau.de/',
		'class'	    => 'rwfak',
	    ),
	    'link3'  => array(
		'name'	    => __('Sprachenzentrum', 'fau' ),
		'content'  => 'http://www.sz.uni-erlangen.de/',
		'class'	    => 'medfak',
	    ),
	    'link4'  => array(
		'name'	    => __('Graduiertenschule', 'fau' ),
		'content'  => 'http://www.promotion.fau.de/',
		'class'	    => 'natfak',
	    ),
	    'link5'  => array(
		'name'	    => __('FAU Busan Campus', 'fau' ),
		'content'  => 'http://www.fau-busan.ac.kr/',
		'class'	    => 'techfak',
	    ),
	),
	'diefau' => array(    
	    '_title'	=> __('Die FAU','fau'),
	    'link1'  => array(
		'name'	    => __('Alle Studiengänge', 'fau' ),
		'content'  => 'https://www.fau.de.de/studium/vor-dem-studium/studiengaenge/alle-studiengaenge/',
	    ),
	    'link2'  => array(
		'name'	    => __('Studium A-Z', 'fau' ),
		'content'  => 'https://www.fau.de/studium/im-studium/studium-a-z/',
		'class'	    => 'rwfak',
	    ),
	    'link3'  => array(
		'name'	    => __('Zahlen, Daten, Fakten', 'fau' ),
		'content'  => 'https://www.fau.de/universitaet/kennzahlen-und-rankings/',
		'class'	    => 'medfak',
	    ),	
	    'link4'  => array(
		'name'	    => __('Wissenschaftsschwerpunkte', 'fau' ),
		'content'  => 'https://www.fau.de/forschung/forschungsprofil/forschungsprofil-und-wissenschaftsschwerpunkte-der-fau/',
		'class'	    => 'medfak',
	    ),	
	    'link5'  => array(
		'name'	    => __('Stiften und Fördern', 'fau' ),
		'content'  => 'https://www.fau.de/universitaet/stiften-und-foerdern/',
		'class'	    => 'medfak',
	    ),	
	),
	'infos' => array(    
	    '_title'	=> __('Informationen für','fau'),
	    'link1'  => array(
		'name'	    => __('Studieninteressierte', 'fau' ),
		'content'  => 'https://www.fau.de/studium/vor-dem-studium/',
	    ),
	    'link2'  => array(
		'name'	    => __('Studierende', 'fau' ),
		'content'  => 'https://www.fau.de/studium/',
		'class'	    => 'rwfak',
	    ),
	    'link3'  => array(
		'name'	    => __('Alumni', 'fau' ),
		'content'  => 'https://www.fau.de/alumni/',
		'class'	    => 'medfak',
	    ),	
	    'link4'  => array(
		'name'	    => __('Schülerinnen und Schüler', 'fau' ),
		'content'  => 'https://www.fau.de/schulportal-der-fau/',
		'class'	    => 'medfak',
	    ),	
	    'link5'  => array(
		'name'	    => __('Unternehmen', 'fau' ),
		'content'  => 'https://www.fau.de/patente-gruendung-wissenstransfer/service-fuer-unternehmen/',
		'class'	    => 'medfak',
	    ),	
	    'link6'  => array(
		'name'	    => __('Presse', 'fau' ),
		'content'  => 'https://www.fau.de/presseportal-der-fau/',
		'class'	    => 'medfak',
	    ),	
	    'link7'  => array(
		'name'	    => __('Beschäftigte', 'fau' ),
		'content'  => 'https://www.fau.de/intranet/',
		'class'	    => 'medfak',
	    ),	
	),
	'top' => array(    
	    'link1'  => array(
		'name'	    => __('UnivIS', 'fau' ),
		'content'  => 'http://univis.fau.de/',
	    ),
	    'link2'  => array(
		'name'	    => __('Anfahrt und Lageplan', 'fau' ),
		'content'  => 'http://karte.fau.de/',
		'class'	    => 'rwfak',
	    ),
	    'link3'  => array(
		'name'	    => __('Universitätsklinikum', 'fau' ),
		'content'  => 'http://www.uk-erlangen.de/',
		'class'	    => 'medfak',
	    ),	  
	),
	'bottom' => array(    
	    'link1'  => array(
		'name'	    => __('Stellenangebote', 'fau' ),
		'content'  => 'https://www.fau.de/universitaet/stellen-praktika-und-jobs/',
	    ),
	    'link2'  => array(
		'name'	    => __('Presse', 'fau' ),
		'content'  => 'https://www.fau.de/presseportal-der-fau/',
		'class'	    => 'rwfak',
	    ),
	    'link3'  => array(
		'name'	    => __('Intranet', 'fau' ),
		'content'  => 'https://www.fau.de/intranet/',
		'class'	    => 'medfak',
	    ),	
	    'link4'  => array(
		'name'	    => __('Impressum', 'fau' ),
		'content'  => 'https://www.fau.de/impressum/',
		'class'	    => 'medfak',
	    ),	
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
	       