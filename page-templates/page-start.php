<?php
/**
 * Template Name: Startseite
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header();
global $options;


?>

	<section id="hero">
		<div id="hero-slides">
			
			<?php	
			global $usejslibs;
			
			$usejslibs['flexslider'] = true;
			
            if (isset($options['slider-catid']) && $options['slider-catid'] > 0) {
                $hero_posts = get_posts( array( 'cat' => $options['slider-catid'], 'posts_per_page' => $options['start_header_count']) );
            } else {							    
                $category = get_term_by('slug', $options['slider-category'], 'category');
                if($category) {
                    $query = array(
                        'numberposts' => $options['start_header_count'],
                        'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
                            'terms' => $category->term_id
                            )
                        )
                    );
                } else {
                    $query = array(
                        'numberposts' => $options['start_header_count']
                    );                    
                }
                $hero_posts = get_posts($query); 
            }
            foreach($hero_posts as $hero): ?>
		<div class="hero-slide">
			    <?php 
			    
			    $sliderimage = '';
			   // $imageid = get_post_meta( $hero->ID, 'fauval_sliderid', true );
			    $imageid = get_post_meta( $hero->ID, 'fauval_slider_image', true );
			    if (isset($imageid) && ($imageid>0)) {
				$sliderimage = wp_get_attachment_image_src($imageid, 'hero'); 
			    } else {
				$post_thumbnail_id = get_post_thumbnail_id( $hero->ID ); 
				if ($post_thumbnail_id) {
				    $sliderimage = wp_get_attachment_image_src( $post_thumbnail_id, 'hero' );
				}
			    }

			    if (!$sliderimage || empty($sliderimage[0])) {  
				$slidersrc = '<img src="'.fau_esc_url($options['src-fallback-slider-image']).'" width="'.$options['slider-image-width'].'" height="'.$options['slider-image-height'].'" alt="">';			    
			    } else {
				$slidersrc = '<img src="'.fau_esc_url($sliderimage[0]).'" width="'.$options['slider-image-width'].'" height="'.$options['slider-image-height'].'" alt="">';	
			    }
			    echo $slidersrc."\n"; 
			    ?>
			    <div class="hero-slide-text">
				<div class="container">
					    <?php
						echo '<h2><a href="';
						
						$link = get_post_meta( $hero->ID, 'external_link', true );
						$external = 0;
						if (isset($link) && (filter_var($link, FILTER_VALIDATE_URL))) {
						    $external = 1;
						} else {
						    $link = get_permalink($hero->ID);
						}
						echo $link;
						echo '">'.get_the_title($hero->ID).'</a></h2>'."\n";					
	
						$abstract = get_post_meta( $hero->ID, 'abstract', true );
						if (strlen(trim($abstract))<3) {
						   $abstract =  fau_custom_excerpt($hero->ID,$options['default_slider_excerpt_length'],false);
						} ?>
						<br><p><?php echo $abstract; ?></p>
				</div>
			    </div>
		    <script type="text/javascript">
			jQuery(document).ready(function($) {
			$('#hero-slides').flexslider({
				selector: '.hero-slide',
				directionNav: true,
				pausePlay: true
			});
		    });
		    </script>
		    </div>
	    <?php endforeach; 
              wp_reset_query();
	      ?>
		
		</div>
	
		<div class="container">
			<div class="row">
				<div class="span6">
				    <h1><?php echo get_bloginfo( 'title' ) ?></h1>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-3')) { ?>
						<h3><?php echo fau_get_menu_name('quicklinks-3'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-3', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) ); 
					} else {
					    echo fau_get_defaultlinks('centers');
					} ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-4')) { ?>
						<h3><?php echo fau_get_menu_name('quicklinks-4'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-4', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) );  
					} else {
					    echo fau_get_defaultlinks('infos');
					} ?>
				</div>
			</div>
			<a href="#content" class="hero-jumplink-content"><?php _e('','fau'); ?></a>
		</div>
	</section> <!-- /hero -->

	<section id="content">
		<div class="container">
			<?php 
			    echo fau_get_ad('werbebanner_seitlich',false);
			 ?>
			
			<div class="row">
				<div class="span8">
					
					<?php
					
						$number = 0;
						$max = $options['start_max_newspertag'] || 3;
						$maxall = $options['start_max_newscontent'] || 5;
						
						for($j = 1; $j <= 3; $j++) {
							$i = 0;
							$thistag = $options['start_prefix_tag_newscontent'].$j;    
							$query = new WP_Query( 'tag='.$thistag );
							
							 while ($query->have_posts() && ($i<$max) ) { 
							    $query->the_post(); 
							    echo fau_display_news_teaser($post->ID);
							    $i++;
							    $number++;
							    wp_reset_postdata();
							}
						}
						if ($number==0) {
						    $args = '';
						    if (isset($options['start_link_news_cat'])) {
							 $args = 'cat='.$options['start_link_news_cat'];	
						    }
						    if (isset($args)) {
							$args .= '&';
						    }
						    
						    $args .= 'post_type=post&has_password=0&posts_per_page='.$options['start_max_newscontent'];	
						    $query = new WP_Query( $args );
						    while ($query->have_posts() ) { 
							$query->the_post(); 
							echo fau_display_news_teaser($post->ID);
							 wp_reset_postdata();
						    }
						}
						
			
					?>

					<?php
						$category = get_the_category_by_ID($options['start_link_news_cat']);
						if (($category) && ($options['start_link_news_show']==1)) {
					?>
					
					<div class="news-more-links">
						<a class="news-more" href="<?php echo get_category_link($options['start_link_news_cat']); ?>"><?php echo $options['start_link_news_linktitle']; ?></a>
						<a class="news-rss" href="<?php echo get_category_feed_link($options['start_link_news_cat']); ?>">RSS</a>
					</div>
					<?php } ?>			    
					
				</div>
				<div class="span4">
					
					<?php $topevent_posts = get_posts(array('tag' => $options['start_topevents_tag'], 'numberposts' => $options['start_topevents_max']));
					 foreach($topevent_posts as $topevent): ?>
						<div class="widget">
							<?php 
							$titel = get_post_meta( $topevent->ID, 'topevent_title', true );
							if (strlen(trim($titel))<3) {
							    $titel =  get_the_title($topevent->ID);
							} 
							$link = get_permalink($topevent->ID);
							
							?>
							<h2 class="small"><a href="<?php echo $link; ?>"><?php echo $titel; ?></a></h2>
							
							<div class="row">
							    <?php 
							    
								$imageid = get_post_meta( $topevent->ID, 'topevent_image', true );
								$imagehtml = '';
								if (isset($imageid) && ($imageid>0)) {
								    $image = wp_get_attachment_image_src($imageid, 'topevent-thumb'); 					
								    if (($image) && ($image[0])) {  
									$imagehtml = '<img src="'.fau_esc_url($image[0]).'" width="'.$options['default_topevent_thumb_width'].'" height="'.$options['default_topevent_thumb_height'].'" alt="">';	
								    }								    
								} 
								if (empty($imagehtml)) {
								   $imagehtml = '<img src="'.fau_esc_url($options['default_topevent_thumb_src']).'" width="'.$options['default_topevent_thumb_width'].'" height="'.$options['default_topevent_thumb_height'].'" alt="">';			    
								}
								
								
								
								
							    if (isset($imagehtml)) { ?>
								<div class="span2">
									<?php echo '<a href="'.$link.'">'.$imagehtml.'</a>'; ?>
								</div>
								<div class="span2">
							    <?php } else { ?>
								<div class="span4">
							    <?php } 
							    $desc = get_post_meta( $topevent->ID, 'topevent_description', true );
							    if (strlen(trim($desc))<3) {
								$desc =  fau_custom_excerpt($topevent->ID,$options['default_topevent_excerpt_length']);
							    }  ?>   
								    <div class="topevent-description"><?php echo $desc; ?></div>
								   
								</div>			
							</div>
						</div>
					<?php endforeach; ?>
					
					<?php get_template_part('sidebar'); ?>
				</div>
			</div> <!-- /row -->
			<?php  
			
			 $menuslug = get_post_meta( $post->ID, 'portalmenu-slug', true );	
			 if ($menuslug) { ?>	
			    <hr>
			    <?php 			
				$nosub  = get_post_meta( $post->ID, 'fauval_portalmenu_nosub', true );
				if ($nosub==1) {
				    $displaysub =0;
				} else {
				    $displaysub =1;
				}
				$nofallbackthumbs  = get_post_meta( $post->ID, 'fauval_portalmenu_nofallbackthumb', true );
				$nothumbnails  = get_post_meta( $post->ID, 'fauval_portalmenu_thumbnailson', true ); 

				fau_get_contentmenu($menuslug,$displaysub,0,0,$nothumbnails,$nofallbackthumbs);
	
			 }
			 
			echo fau_get_ad('werbebanner_unten',true);
			
			 $logoliste = get_post_meta( $post->ID, 'fauval_imagelink_catid', true );
			 if ($logoliste) { ?>	
			    <hr>
			    <?php 
			    fau_get_imagelinks($logoliste);
			     
			 }
			
			 ?>
			
		</div> <!-- /container -->
		<?php get_template_part('footer', 'social'); ?>	
		
	</section> <!-- /content -->

<?php get_footer(); ?>
