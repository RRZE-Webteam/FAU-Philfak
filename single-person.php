<?php
/**
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

global $options;
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('hero', 'small'); ?>

	<section id="content">
		<div class="container">
			
		<?php 
		echo fau_get_ad('werbebanner_seitlich',false);
		?>

			<div class="row">
				<div class="span12">
					<?php 
				


					
					
					
				if (!empty($id)) {
				    
				    echo '<div class="person" itemscope itemtype="http://schema.org/Person">';
				     
				     
				    
			$honorificPrefix = get_post_meta($id, 'fau_person_honorificPrefix', true);
                        $givenName = get_post_meta($id, 'fau_person_givenName', true);
                        $familyName = get_post_meta($id, 'fau_person_familyName', true);
                        $honorificSuffix = get_post_meta($id, 'fau_person_honorificSuffix', true);
                        $jobTitle = get_post_meta($id, 'fau_person_jobTitle', true);
                        $worksFor = get_post_meta($id, 'fau_person_worksFor', true);
                        $telephone = get_post_meta($id, 'fau_person_telephone', true);
                        $faxNumber = get_post_meta($id, 'fau_person_faxNumber', true);
                        $email = get_post_meta($id, 'fau_person_email', true);
                        $url = get_post_meta($id, 'fau_person_url', true);
                        $streetAddress = get_post_meta($id, 'fau_person_streetAddress', true);
                        $postalCode = get_post_meta($id, 'fau_person_postalCode', true);
                        $addressLocality = get_post_meta($id, 'fau_person_addressLocality', true);
                        $addressCountry = get_post_meta($id, 'fau_person_addressCountry', true);
                        $workLocation = get_post_meta($id, 'fau_person_workLocation', true);
                        $hoursAvailable = get_post_meta($id, 'fau_person_hoursAvailable', true);
                        $pubs = get_post_meta($id, 'fau_person_pubs', true);
                        $freitext = get_post_meta($id, 'fau_person_description', true);
                        $link = get_post_meta($id, 'fau_person_link', true);             
                        
                        
                        if($streetAddress || $postalCode || $addressLocality || $addressCountry) {
                                $contactpoint = '<li class="person-info-address"><span class="screen-reader-text">'.__('Adresse',FAU_PERSON_TEXTDOMAIN).': </span><br>';    
                                                
                                if($streetAddress)          $contactpoint .= '<span class="person-info-street" itemprop="streetAddress">'.$streetAddress.'</span>';
                                if($streetAddress && ($postalCode || $addressLocality)) $contactpoint .= '<br>';
                                if($postalCode || $addressLocality) {
                                        $contactpoint .= '<span class="person-info-city">';
                                        if($postalCode)         $contactpoint .= '<span itemprop="postalCode">'.$postalCode.'</span> ';  
                                        if($addressLocality)	$contactpoint .= '<span itemprop="addressLocality">'.$addressLocality.'</span>';
                                        $contactpoint .= '</span>';
                                        }
                                if(($streetAddress || $postalCode || $addressLocality) && $addressCountry)                    $contactpoint .= '<br>';
                                if($addressCountry)         $contactpoint .= '<span class="person-info-country" itemprop="addressCountry">'.$addressCountry.'</span></';
                                $contactpoint .= '</li>';                                                
                        }
				    
				    
	
				    if ((strlen($url)>4) && (strpos($url,"http") === false)) {
					$url = 'http://'.$url;
				    }
				    
	   
				    $content = '';
				    $fullname = '';
				    if($honorificPrefix) 	$fullname .= '<span itemprop="honorificPrefix">'.$honorificPrefix.'</span> ';
				    if($givenName) 	$fullname .= '<span itemprop="givenName">'.$givenName.'</span> ';
				    if($familyName) 		$fullname .= '<span itemprop="familyName">'.$familyName.'</span>';
				    if($honorificSuffix) 	$fullname .= ' '.$honorificSuffix;


				    if ($options['plugin_fau_person_headline'] == 'jobTitle') {
					$headline =  '<span itemprop="jobTitle">'.$jobTitle.'</span>';
					echo '<h2>'.$headline.'</h2>';
					
				    } else {
					$headline = $fullname;
					echo '<h2 itemprop="name">'.$headline.'</h2>';
				    }
				    get_template_part('sidebar', 'inline'); 
				    
				    
				    
				    
				    
				    $post = get_post($id);
				  
				
				
				if(has_post_thumbnail($id)) {
					$content .= '<div itemprop="image" class="wp-caption alignright">';
					// $content .= get_the_post_thumbnail($id, 'post');
					$thumbid = get_post_thumbnail_id($id);
					$image_url_data = wp_get_attachment_image_src( $thumbid, 'person-thumb-page');
					$attribs = fau_get_image_attributs($thumbid);	
					$content .= '<img src="'.$image_url_data[0].'" alt="" width="'.$image_url_data[1].'" height="'.$image_url_data[2].'">';
					    
					
					$caption = '';
					if ($attribs['beschriftung'] || $attribs['beschreibung'] || $attribs['title'] ) {
					    if (!empty($attribs['beschriftung'])) {
						$caption .= $attribs['beschriftung'];
					    } elseif (!empty($attribs['beschreibung'])) {
						$caption .= $attribs['beschreibung'];
					    } else {
						$caption .= $attribs['title'];
					    }
					}
					
					if ($attribs['copyright']) {
					    if ($caption) 
						    $caption .= "<br>\n";
						$caption .= __('Bild:','fau').' '.$attribs["copyright"];
					}
					if ($caption) {
					    $content .= '<p class="wp-caption-text">';
					    $content .= $caption;
					    $content .= "</p>\n";
					}
					$content .= '</div>';
				}

					
			       if ((!$options['plugin_fau_person_headline']) || ($options['plugin_fau_person_headline']=='fullname')) {
				    $content .= '<h3 itemprop="name">';
				    $content .= $fullname;
				    $content .= '</h3>';
				}

				$content .= '<ul class="person-info">';

				if (($options['plugin_fau_person_headline'] != 'jobTitle') && ($position)) 
				    $content .= '<li class="person-info-position"><span class="screen-reader-text">'.__('Tätigkeit','fau').': </span><strong><span itemprop="jobTitle">'.$jobTitle.'</span></strong></li>';
				
				if($worksFor)	
				    $content .= '<li class="person-info-institution"><span class="screen-reader-text">'.__('Einrichtung','fau').': </span><span itemprop="worksFor">'.$worksFor.'</span></li>';
				if($telephone)			
				    $content .= '<li class="person-info-phone"><span class="screen-reader-text">'.__('Telefonnummer','fau').': </span><span itemprop="telephone">'.$telephone.'</span></li>';
				if($faxNumber)			
				    $content .= '<li class="person-info-fax"><span class="screen-reader-text">'.__('Faxnummer','fau').': </span><span itemprop="faxNumber">'.$faxNumber.'</span></li>';
				if($email)			
				    $content .= '<li class="person-info-email"><span class="screen-reader-text">'.__('E-Mail','fau').': </span><a itemprop="email" href="mailto:'.strtolower($email).'">'.strtolower($email).'</a></li>';
				if($url)		
				    $content .= '<li class="person-info-www"><span class="screen-reader-text">'.__('Webseite','fau').': </span><a itemprop="url" href="'.$url.'">'.$url.'</a></li>';
				if(!empty($contactpoint))		
				    $content .= $contactpoint;
				if($workLocation)			
				    $content .= '<li class="person-info-room"><span class="screen-reader-text">' . __('Raum', 'fau') .' </span><span itemprop="workLocation">'.$workLocation.'</span></li>';


				
				$content .= '</ul>';
			
				
				echo $content;
				
				the_content(); 
				
				
				echo $freitext;
				  
								
				
				
			echo'</div>';
		} else { ?>
		    <p class="hinweis">
			<strong><?php _e('Es tut uns leid.','fau'); ?></strong><br>
			<?php _e('Für den angegebenen Kontakt können keine Informationen abgerufen werden.','fau'); ?>
					</p>
		<?php }

					
					?>
				</div>
				
			</div>
		</div>
	</section>
	
	
<?php endwhile; ?>

<?php get_footer(); ?>