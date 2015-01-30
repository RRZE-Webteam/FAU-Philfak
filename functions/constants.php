<?php

/* 
 * Default Constants and values for FAU THeme
 */
$defaultoptions = array(
    'js-version'		    => '1.1',
    'optionpage-tab-default'	    => 'startseite',
    'content-width'		    => 770,
    'src-fallback-slider-image'	    => get_template_directory_uri().'/img/slider-fallback.jpg',
    'slider-category'		    => 'header',
    'slider-catid'		    => 0,
    'slider-image-width'	    => 1260,
    'slider-image-height'	    => 350,    
    'slider-image-crop'		    => true,
    'default_slider_excerpt_length' => 240,
    'start_header_count'	    => 5,
    'start_max_newscontent'	    => 5,
    'start_max_newspertag'	    => 1,    
    'start_prefix_tag_newscontent'  => 'startseite',
    'start_link_news_cat'	    => 0,    
    'start_link_news_show'	    => 1,
    'start_link_news_linktitle'	    => __('Mehr Meldungen','fau'),
  
    
    'default_mainmenuthumb_width'    => 370,
    'default_mainmenuthumb_height'   => 185,
    
    'default_submenuthumb_width'    => 220,
    'default_submenuthumb_height'   => 110,    
    'default_submenuthumb_src'	    =>  get_template_directory_uri().'/img/default-submenuthumb.png',
    'default_submenu_spalten'	    => 4,
    'default_submenu_entries'	    => 5,
    
    'menu_fallbackquote_show_excerpt'		=> 1,
    'menu_fallbackquote_excerpt_length'	=> 240,  
    'start_topevents_tag'	    => 'top',
    'start_topevents_max'	    => 1,
    'default_topevent_thumb_src'    => get_template_directory_uri().'/img/default-topeventthumb.png',
    'default_topevent_thumb_width'  => 140,
    'default_topevent_thumb_height' => 90,
    'default_topevent_thumb_crop'   => true,
    'default_topevent_excerpt_length' => 100,

    
    'breadcrumb_root'		    => 'fau.de',
    'socialmedia'		    => 1,
    'menu_pretitle_portal'	    => __('Portal', 'fau'),
    'menu_aftertitle_portal'	    => '',
    
   'contact_address_name'	    => __('Friedrich-Alexander-Universität', 'fau'),
   'contact_address_name2'	    => __('Erlangen-Nürnberg', 'fau'),
   'contact_address_street'	    => __('Schlossplatz 4', 'fau'),
   'contact_address_plz'	    => __('91054', 'fau'),
   'contact_address_ort'	    => __('Erlangen', 'fau'),
   
    'contact_address_country'	    => '',
    'display_nojs_notice'	    => 0,
    'display_nojs_note'		    => __('JavaScript wurde deaktiviert oder Ihr Browser unterstützt kein JavaScript. Alle Inhalte sind erreichbar, jedoch ist die Bedienung teilweise umständlicher.','fau'),
    'google-site-verification'	    => '',
    'default_mainmenu_number'	    => 4,
   
    'default_logo_src'		    => get_template_directory_uri().'/img/logo-fau.png',
    'default_logo_height'	    => 65,
    'default_logo_width'	    => 240,
    
    'default_excerpt_morestring'    => '...',
    'default_excerpt_length'	    => 300,
    'default_anleser_excerpt_length'=> 300,
    'default_search_excerpt_length' => 300,
    
    'default_postthumb_src'	    => get_template_directory_uri().'/img/default-postthumb.png',
    'default_postthumb_width'	    => 220,
    'default_postthumb_height'	    => 147,
    'default_postthumb_crop'	    => false,
    'default_postthumb_always'	    => 1,


    'custom_excerpt_allowtags'	    => 'br',
    'url_banner-ad-notice'	    => 'https://www.fau.de/patente-gruendung-wissenstransfer/service-fuer-unternehmen/werben/',
    'title_banner-ad-notice'	    => __( 'Werbung', 'fau' ),
    
    'title_hero_post_categories'    =>  __( 'FAU aktuell', 'fau' ),
    'title_hero_post_archive'	    =>  __( 'FAU aktuell', 'fau' ),
    'title_hero_search'		    =>  __( 'Suche', 'fau' ),
    'title_hero_events'		    =>  __( 'Veranstaltungskalender','fau')
    

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
	    ),
	    'link3'  => array(
		'name'	    => __('Zahlen, Daten, Fakten', 'fau' ),
		'content'  => 'https://www.fau.de/universitaet/kennzahlen-und-rankings/',
	    ),	
	    'link4'  => array(
		'name'	    => __('Wissenschaftsschwerpunkte', 'fau' ),
		'content'  => 'https://www.fau.de/forschung/forschungsprofil/forschungsprofil-und-wissenschaftsschwerpunkte-der-fau/',
	    ),	
	    'link5'  => array(
		'name'	    => __('Stiften und Fördern', 'fau' ),
		'content'  => 'https://www.fau.de/universitaet/stiften-und-foerdern/',
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
	    ),
	    'link3'  => array(
		'name'	    => __('Alumni', 'fau' ),
		'content'  => 'https://www.fau.de/alumni/',
	    ),	
	    'link4'  => array(
		'name'	    => __('Schülerinnen und Schüler', 'fau' ),
		'content'  => 'https://www.fau.de/schulportal-der-fau/',
	    ),	
	    'link5'  => array(
		'name'	    => __('Unternehmen', 'fau' ),
		'content'  => 'https://www.fau.de/patente-gruendung-wissenstransfer/service-fuer-unternehmen/',
	    ),	
	    'link6'  => array(
		'name'	    => __('Presse', 'fau' ),
		'content'  => 'https://www.fau.de/presseportal-der-fau/',
	    ),	
	    'link7'  => array(
		'name'	    => __('Beschäftigte', 'fau' ),
		'content'  => 'https://www.fau.de/intranet/',
	    ),	
	),
	'meta' => array(    
	    'link1'  => array(
		'name'	    => __('UnivIS', 'fau' ),
		'content'  => 'http://univis.fau.de/',
	    ),
	    'link2'  => array(
		'name'	    => __('Anfahrt und Lageplan', 'fau' ),
		'content'  => 'http://karte.fau.de/',
	    ),
	    'link3'  => array(
		'name'	    => __('Universitätsklinikum', 'fau' ),
		'content'  => 'http://www.uk-erlangen.de/',
	    ),	  
	),
	'techmenu' => array(    
	    'link1'  => array(
		'name'	    => __('Stellenangebote', 'fau' ),
		'content'  => 'https://www.fau.de/universitaet/stellen-praktika-und-jobs/',
	    ),
	    'link2'  => array(
		'name'	    => __('Presse', 'fau' ),
		'content'  => 'https://www.fau.de/presseportal-der-fau/',
	    ),
	    'link3'  => array(
		'name'	    => __('Intranet', 'fau' ),
		'content'  => 'https://www.fau.de/intranet/',
	    ),	
	    'link4'  => array(
		'name'	    => __('Impressum', 'fau' ),
		'content'  => 'https://www.fau.de/impressum/',
	    ),	
	),
);


$default_header_logos = array(
    'fau' => array(
	    'url'           => '%s/img/logo-fau.png',
	    'thumbnail_url' => '%s/img/logo-fau.png',
	    'description'   => _x( 'FAU', 'Offizielles FAU-Logo', 'fau' )
    ),
    'fak-med' => array(
	    'url'           => '%s/img/logo-fak-med.png',
	    'thumbnail_url' => '%s/img/logo-fak-med.png',
	    'description'   => _x( 'FAKMED', 'Offizielles Logo der Medizin', 'fau' )
    ),
    'fak-nat' => array(
	    'url'           => '%s/img/logo-fak-nat.png',
	    'thumbnail_url' => '%s/img/logo-fak-nat.png',
	    'description'   => _x( 'FAKNAT', 'Offizielles Logo der Naturwissenschaft', 'fau' )
    ),
    'fak-phil' => array(
	    'url'           => '%s/img/logo-fak-phil.png',
	    'thumbnail_url' => '%s/img/logo-fak-phil.png',
	    'description'   => _x( 'FAKPHIL', 'Offizielles Logo der Philosophischen Fakultät', 'fau' )
    ),
    'fak-rechtswiwi' => array(
	    'url'           => '%s/img/logo-fak-rechtswiwi.png',
	    'thumbnail_url' => '%s/img/logo-fak-rechtswiwi.png',
	    'description'   => _x( 'FAKRECHTSWIWI', 'Offizielles Logo der Rechts- und Wirtschaftswissenschaftlichen Fakultät', 'fau' )
    ),
    'fak-tech' => array(
	    'url'           => '%s/img/logo-fak-tech.png',
	    'thumbnail_url' => '%s/img/logo-fak-tech.png',
	    'description'   => _x( 'FAKTECH', 'Offizielles Logo der Technischen Fakultät', 'fau' )
    )
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
                            
	       'newsbereich'  => array(
                  'type'    => 'section',
                  'title'   => __( 'Nachrichtenbereich', 'fau' ),                      
              ),
	       
	       'start_max_newscontent'=> array(
                  'type'    => 'select',
                  'title'   => __( 'Zahl der News (Gesamt)', 'fau' ),
                  'label'   => __( 'Anzahl der News auf der Startseite unterhalb des Sliders', 'fau' ),
		   'liste'   => array(2 => 2,3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7),
                  'default' => $defaultoptions['start_max_newscontent'],
		   'parent'  => 'newsbereich'
              ),  
	        'start_prefix_tag_newscontent' => array(
                  'type'    => 'text',
                  'title'   => __( 'Sortierungs-Tag', 'fau' ),
                  'label'   => __( 'Angabe des Tag-Prefixes, mit dem News auf der Startseite gezeigt werden. Im Artikel wird dann dieser Tag plus eine Nummer vergeben um die Sortierung festzusetzen. Beispiel bei einem gewählten Tag-Prefix "Startseite": Erster Artikel mit Tag "Startseite1", Zweiter Artikel mit Tag "Startseite2"', 'fau' ),               
                  'default' => $defaultoptions['start_prefix_tag_newscontent'],
		     'parent'  => 'newsbereich'
              ),  
	       
	       
	       'start_max_newspertag'=> array(
                  'type'    => 'select',
                  'title'   => __( 'News pro gleichem Sortierungs-Tag', 'fau' ),
                  'label'   => __( 'Anzahl der Artikel mit dem vorgegebene Prefix-Tag (Reihenfolge).', 'fau' ),
		   'liste'   => array(1 => 1, 2 => 2,3 => 3, 4 => 4, 5 => 5),
                  'default' => $defaultoptions['start_max_newspertag'],
		    'parent'  => 'newsbereich'
              ),  
	       'start_link_news_show' => array(
                  'type'    => 'bool',
                  'title'   => __( 'News verlinken', 'fau' ),
                  'label'   => __( 'Weitere Meldungen verlinken.', 'fau' ),               
                  'default' => $defaultoptions['start_link_news_show'],
		     'parent'  => 'newsbereich'
              ),  
		'start_link_news_cat' => array(
                  'type'    => 'select',
                  'title'   => __( 'News-Kategorie', 'fau' ),
                  'label'   => __( 'Unter den News erscheint ein Link auf eine Übersicht der News. Hier wird die Kategorie dafür ausgewählt. Für den Fall, dass keine Artikel mit einem Prefix-Tag ausgestattet sind, wird diese Kategorie auch bei der Anzeige der ersten News verwendet.', 'fau' ),
                  'liste'   => $currentcatliste,
                  'default' => $defaultoptions['start_link_news_cat'],
		     'parent'  => 'newsbereich'
              ), 
	    'default_postthumb_always' => array(
		    'type'    => 'select',
		    'title'   => __( 'Immer ein Artikelbild anzeigen', 'fau' ),
		    'label'   => __( 'Immer ein Artikelbild zu einer Nachricht zeigen. Wenn kein Artikelbild definiert wurde, nehme stattdessen ein Ersatzbild.', 'fau' ),      
		    'liste'   => array(1 => __('Ja', 'fau'), 0 => __('Nein', 'fau')),
		    'default' => $defaultoptions['default_postthumb_always'],
		    'parent'  => 'newsbereich'
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
             'topevents'  => array(
                  'type'    => 'section',
                  'title'   => __( 'Top Events', 'fau' ),                      
              ), 
	    'start_topevents_tag' => array(
                  'type'    => 'text',
                  'title'   => __( 'Schlagwort', 'fau' ),
                  'label'   => __( 'Schlagwort mit dem Beiträge als ausgestattet sein müssen, damit sie als Top-Event angezeigt werden.', 'fau' ),               
                  'default' => $defaultoptions['start_topevents_tag'],
		  'parent'  => 'topevents'
              ),  
	       'start_topevents_max'=> array(
                  'type'    => 'select',
                  'title'   => __( 'Zahl der Top-Events', 'fau' ),
                  'label'   => __( 'Wieviele Top-Events sollen maximal auf der Startseite angezeigt werden', 'fau' ),
		  'liste'   => array(1 => 1,2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6),
                  'default' => $defaultoptions['start_topevents_max'],
                  'parent'  => 'topevents'
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
	       
	      'menu_fallbackquote_show_excerpt' => array(
                  'type'    => 'bool',
                  'title'   => __( 'Zitatersatz', 'fau' ),
                  'label'   => __( 'Wenn bei einem Menupunkt auf oberster Ebene kein Zitat vorgegeben ist, zeige stattdessen einen Auszug der Seite.', 'fau' ),                
                  'default' => $defaultoptions['menu_fallbackquote_show_excerpt'],
              ),  
	       
	       
	     'google-site-verification' => array(
                  'type'    => 'text',
                  'title'   => __( 'Google Site Verification', 'fau' ),
                  'label'   => __( 'Meta-Tag zur Identifikation der Inhaberschaft gegenüber Google. geben Sie hier den Content-Bestand an für die Identifikation mittels Meta-Tag.', 'fau' ),               
                  'default' => $defaultoptions['google-site-verification'],
              ),  
	      'url_banner-ad-notice'	 => array(
                  'type'    => 'url',
                  'title'   => __( 'Werbebanner Infolink', 'fau' ),
                  'label'   => __( 'URL zu einer Seite, die bei einem Klick auf den Hinweis zur Werbung aufgerufen wird.', 'fau' ),               
                  'default' => $defaultoptions['url_banner-ad-notice'],
              ),  
	       'title_banner-ad-notice'	 => array(
                  'type'    => 'text',
                  'title'   => __( 'Hinweistitel für Werbebanner', 'fau' ),
                  'label'   => __( 'Aus gesetzlichen Gründen muss vor Werbebannern ein Hinweis stehen, daß es sich um eben solche Werbung handelt. Üblicherweise reicht ein Titel "Werbung" o.ä.. Dieser Titel kann hier angegeben oder geändert werden.', 'fau' ),               
                  'default' => $defaultoptions['title_banner-ad-notice'],
              ),  
   
		'title_hero_post_categories'	 => array(
		    'type'    => 'text',
		    'title'   => __( 'Bühnentitel Kategorieseiten', 'fau' ),
		    'label'   => __( 'Im Bühnenteil wird ein Titel großflächig hinterlegt. Dieser kann hier für Kategorieseiten von Nachrichten hinterlegt werden.', 'fau' ),               
		    'default' => $defaultoptions['title_hero_post_categories'],
		), 
		'title_hero_post_archive'	 => array(
		    'type'    => 'text',
		    'title'   => __( 'Bühnentitel Beitragsarchiv', 'fau' ),
		    'label'   => __( 'Im Bühnenteil wird ein Titel großflächig hinterlegt. Dieser kann hier für Archivseiten von Nachrichten hinterlegt werden.', 'fau' ),               
		    'default' => $defaultoptions['title_hero_post_archive'],
		), 
	       'title_hero_search'	 => array(
		    'type'    => 'text',
		    'title'   => __( 'Bühnentitel Suche', 'fau' ),
		    'label'   => __( 'Im Bühnenteil wird ein Titel großflächig hinterlegt. Dieser kann hier für Suchergebnisseiten hinterlegt werden.', 'fau' ),               
		    'default' => $defaultoptions['title_hero_search'],
		), 
	       'title_hero_events'	 => array(
		    'type'    => 'text',
		    'title'   => __( 'Bühnentitel Veranstaltungen', 'fau' ),
		    'label'   => __( 'Im Bühnenteil wird ein Titel großflächig hinterlegt. Dieser kann hier für Seiten zu Veranstaltungen hinterlegt werden.', 'fau' ),               
		    'default' => $defaultoptions['title_hero_events'],
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
	       