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

	<div id="hero">
		<div id="hero-slides">
			
			<?php			 
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
            ?>
	    <?php foreach($hero_posts as $hero): ?>
		<div class="hero-slide">
			    <?php 
			    $post_thumbnail_id = get_post_thumbnail_id( $hero->ID ); 
			    $sliderimage = '';
			    if ($post_thumbnail_id) {
				$sliderimage = wp_get_attachment_image_src( $post_thumbnail_id, 'hero' );
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
						if (function_exists('get_field') && get_field('external_link')) {
						    echo get_field('external_link');
						} else {
						    echo get_permalink($hero->ID);
						}
						echo '">'.get_the_title($hero->ID).'</a></h2>'."\n";					
	
					     if (function_exists('get_field') &&  get_field('abstract', $hero->ID)): ?>
						<br><p><?php echo get_field('abstract', $hero->ID); ?></p>
					    <?php endif; ?>
				</div>
			    </div>
		    </div>
	    <?php endforeach; 
              wp_reset_query();
	      ?>
		
		</div>
	
		<div class="container">
			<div class="row">
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-1')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-1'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-1', 'container' => false, 'items_wrap' => '<ul class="menu-faculties %2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-2')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-2'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-2', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-3')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-3'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-3', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('quicklinks-4')): ?>
						<h3><?php echo fau_get_menu_name('quicklinks-4'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'quicklinks-4', 'container' => false, 'items_wrap' => '<ul class="%2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
			<a href="#content" class="hero-jumplink-content"><?php _e('Zum Inhalt springen','fau'); ?></a>
		</div>
	</div> <!-- /hero -->

	<div id="content">
		<div class="container">
			
			
			
			<?php 
			if ( function_exists('get_field') ) {
			  if ( get_field( 'werbebanner_seitlich' ) ) : ?>
				<div class="banner-ad-right">
					<?php $ads = get_field('werbebanner_seitlich');?>
					<?php foreach($ads as $ad): ?>
						<?php the_widget('FAUAdWidget', array('id' => $ad)); ?>
					<?php endforeach; ?>
				</div>
			<?php endif; 
			} ?>
			
			<div class="row">
				<div class="span8">
					
					<?php
						$max = 1;
						for($j = 1; $j <= 5; $j++) {
							$i = 0;
							    
							$query = new WP_Query( 'tag=startseite'.$j );
							 while ($query->have_posts() && $i<$max) { 
							    $query->the_post();  ?>
				    
							    <div class="news-item">
								    <h2><?php if(function_exists('get_field') && get_field('external_link', $post->ID)): ?>
										<a href="<?php echo get_field('external_link', $post->ID);?>">
									<?php else: ?>
										<a href="<?php echo get_permalink($post->ID); ?>">
									<?php endif; ?>
									<?php echo get_the_title(); ?></a></h2>


								<div class="row">
								    <?php if(has_post_thumbnail( $post->ID )): ?>
									<div class="span3">
										<?php
										echo '<a href="';
										if(function_exists('get_field') && get_field('external_link', $post->ID)) {
										    echo get_field('external_link', $post->ID);
										} else {
										    echo get_permalink($post->ID);
										}
										echo '" class="news-image">';

										$post_thumbnail_id = get_post_thumbnail_id( $post->ID, 'post-thumb' ); 
										$sliderimage = '';
										if ($post_thumbnail_id) {
										    $sliderimage = wp_get_attachment_image_src( $post_thumbnail_id,  'post-thumb');
										}
										if ($sliderimage && !empty($sliderimage[0])) {  
										    $slidersrc = '<img src="'.fau_esc_url($sliderimage[0]).'" width="'.$options['slider-image-width'].'" height="'.$options['slider-image-height'].'" alt="">';	
										}
										echo $slidersrc;
										echo '</a>';
										?>
									</div>
									<div class="span5">
								    <?php else: ?>
									<div class="span8">
								    <?php endif; ?>
									    <p>
										    <?php if (function_exists('get_field')) {
											 echo get_field('abstract', $post->ID);											  
										    } else {
											  the_excerpt();
										    }

										    echo ' <a href="';
										    if(function_exists('get_field') && get_field('external_link', $post->ID)) {
											    echo get_field('external_link', $post->ID);
										    } else {
											    echo get_permalink($post->ID);
										    }
										    echo '" class="read-more-arrow">›</a>'; ?>
									    </p>
									</div>
								</div>
							    </div> <!-- /news-item -->
							
							<?php
								$i++;
								wp_reset_postdata();
							}
						}
					?>

					<?php
						$category = get_category_by_slug('news');
						if ($category) {
					?>
					
					<div class="news-more-links">
						<a class="news-more" href="<?php echo get_category_link($category->term_id); ?>"><?php _e('Mehr Meldungen','fau'); ?></a>
						<a class="news-rss" href="<?php echo get_category_feed_link($category->term_id); ?>">RSS</a>
					</div>
					<?php } ?>			    
					
				</div>
				<div class="span4">
					
					<?php $topevent_posts = get_posts(array('tag' => 'top', 'numberposts' => 1));?>
					<?php foreach($topevent_posts as $topevent): ?>
						<div class="widget">
							<?php if (function_exists('get_field') && get_field('topevent_title', $topevent->ID)) { ?>
							<h2 class="small"><a href="<?php echo get_permalink($topevent->ID); ?>"><?php the_field('topevent_title', $topevent->ID); ?></a></h2>
							<?php } ?>
							<div class="row">
							    <?php if(function_exists('get_field') && get_field('topevent_image', $topevent->ID)): ?>
								<div class="span2">
									<?php $image = wp_get_attachment_image_src(get_field('topevent_image', $topevent->ID), 'topevent-thumb'); ?>
									<a href="<?php echo get_permalink($topevent->ID); ?>"><img src="<?php echo $image[0]; ?>"></a>
								</div>
								<div class="span2">
							    <?php else: ?>
								<div class="span4">
							    <?php endif; ?>
								    <?php if (function_exists('get_field') && get_field('topevent_description', $topevent->ID)) { ?>   
								    <div class="topevent-description"><?php the_field('topevent_description', $topevent->ID); ?></div>
								    <?php } ?>   
								</div>			
							</div>
						</div>
					<?php endforeach; ?>
					
					<?php get_template_part('sidebar'); ?>
				</div>
			</div> <!-- /row -->
			<?php  if ( function_exists('get_field') ) { ?>
			    <?php if ( get_field( 'portalmenu-slug' ) ) : ?>
				    <div class="hr"><hr></div>
				    <?php the_widget('FAUMenuSubpagesWidget', array('menu-slug' => get_field('portalmenu-slug'))); ?>
			    <?php endif; ?>

			    <?php if ( get_field( 'logo-slider-slug' ) ) : ?>
				    <div class="hr"><hr></div>
				    <?php the_widget('FAUMenuLogosWidget', array('menu-slug' => get_field('logo-slider-slug'))); ?>
			    <?php endif; ?>

			    <?php if ( get_field( 'werbebanner_unten' ) ) : ?>
				    <div class="hr"><hr></div>
				    <?php $ads = get_field('werbebanner_unten');?>
				    <?php foreach($ads as $ad): ?>
					    <?php the_widget('FAUAdWidget', array('id' => $ad)); ?>
				    <?php endforeach; ?>
			    <?php endif; ?>
			<?php  } ?>
			
		</div> <!-- /container -->
		<div id="social">
			<div class="container">
				<div class="row">
					<?php if (isset($options['socialmedia'])): ?>
						<div class="span3">
							<h2 class="small"><strong>FAU</strong>Social</h2>
							<?php 
							global $default_socialmedia_liste;

							echo '<nav id="socialmedia" aria-label="'.__('Social Media','fau').'">';
							echo '<ul class="social">';       
							    foreach ( $default_socialmedia_liste as $entry => $listdata ) {        

								$value = '';
								$active = 0;
								if (isset($options['sm-list'][$entry]['content'])) {
									$value = $options['sm-list'][$entry]['content'];
									if (isset($options['sm-list'][$entry]['active'])) {
									    $active = $options['sm-list'][$entry]['active'];
									} 
								} else {
									$value = $default_socialmedia_liste[$entry]['content'];
									$active = $default_socialmedia_liste[$entry]['active'];
								 }

								if (($active ==1) && ($value)) {
								    echo '<li class="social-'.$entry.'"><a href="'.$value.'">';
								    echo $listdata['name'].'</a></li>';
								}
							    }
							    echo '</ul>';
							    echo '</nav>';
							?>

						</div>
					<?php endif; ?>
					<div class="span9">
						<?php 
						if ( function_exists('get_field') ) {

						if(get_field('videos')): ?>
							<div class="row">
							    <?php
							     $foundvids = 0;
							    while(has_sub_field('videos')): 

							    $args = '';
							    $video_link = get_sub_field('video-links');
							    if($video_link):
								$video_height = get_sub_field('video-height');
								$video_height = $video_height ? $video_height : '';
								$video_width = get_sub_field('video-width');
								$video_width = $video_width ? $video_width : '';
								$video_poster = get_sub_field('video-poster');
								$video_poster = $video_poster ? $video_poster : '';
								$wp_oembed_get = sprintf('[fauvideo url="%1$s" height="%2$s" width="%3$s" image="%4$s"]', $video_link, $video_height, $video_width, $video_poster);
								$wp_oembed_get = do_shortcode($wp_oembed_get);
								    if($wp_oembed_get !== false) : ?>
								<div class="span3">
									<?php
										$video_titel = get_sub_field('video-titel');
										if($video_titel):
											echo '<h2 class="small">'.$video_titel.'</h2>';
										endif; 
										 $foundvids = 1;
									?>	
									<?php echo $wp_oembed_get; ?>
								</div>
								    <?php endif; ?>
								<?php endif; ?>
								<?php endwhile; ?>
							</div>
							<?php if ( $foundvids==1) { ?>
							<div class="pull-right link-all-videos">
								<a href="http://video.fau.de/"><?php _e('Alle Videos','fau'); ?></a>
							</div>
							<?php }    
						     endif;  							
						} ?>

					</div>						
				</div>
			</div>
		</div> <!-- /social -->	
	</div> <!-- /content -->

<?php get_footer(); ?>
