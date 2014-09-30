<?php
/**
 * Template Name: Startseite
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php $options = get_option('fau_theme_options', array('start_header_count' => 5, 'start_news_count' => 3)); ?>

	<div id="hero">
		<div id="hero-slides">
			
			<?php  
			
				$category = get_term_by('slug', 'header', 'category');
				$hero_posts = get_posts(array(
					'numberposts' => $options['start_header_count'],
					'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'id', // can be slug or id - a CPT-onomy term's ID is the same as its post ID
						'terms' => $category->term_id
						)
					))); 
			
			?>

			<?php foreach($hero_posts as $hero): ?>
				<div class="hero-slide">
					<?php echo get_the_post_thumbnail($hero->ID, 'hero'); ?>
					<div class="hero-slide-text">
						<div class="container">
							<h2>
								<?php if(get_field('external_link')): ?>
									<a href="<?php echo get_field('external_link');?>">
								<?php else: ?>
									<a href="<?php echo get_permalink($hero->ID); ?>">
								<?php endif; ?>
								
								<?php echo get_the_title($hero->ID); ?></a>
							</h2><br>
							<p><?php echo get_field('abstract', $hero->ID); ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		
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
		</div>
	</div>

	<div id="content">
		<div class="container">
			
			
			
			<?php if ( get_field( 'werbebanner_seitlich' ) ) : ?>
				<div class="banner-ad-right">
					<?php $ads = get_field('werbebanner_seitlich');?>
					<?php foreach($ads as $ad): ?>
						<?php the_widget('FAUAdWidget', array('id' => $ad)); ?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			
			<div class="row">
				<div class="span8">
					
					<?php

						for($j = 1; $j <= 5; $j++)
						{
							$news_posts = get_posts(array('tag' => 'startseite'.$j, 'numberposts' => 1));
							$i = 0;
							
							foreach($news_posts as $news):
							
							?>
								
								<div class="news-item">

								<h2>
									<?php if(get_field('external_link', $news->ID)): ?>
										<a href="<?php echo get_field('external_link', $news->ID);?>">
									<?php else: ?>
										<a href="<?php echo get_permalink($news->ID); ?>">
									<?php endif; ?>
									<?php echo get_the_title($news->ID); ?></a>
								</h2>


									<div class="row">
										<?php if(has_post_thumbnail( $news->ID )): ?>
										<div class="span3">
											<?php if(get_field('external_link', $news->ID)): ?>
												<a href="<?php echo get_field('external_link', $news->ID);?>" class="news-image">
											<?php else: ?>
												<a href="<?php echo get_permalink($news->ID); ?>" class="news-image">
											<?php endif; ?>
											<?php echo get_the_post_thumbnail($news->ID, 'post-thumb'); ?></a>
										</div>
										<div class="span5">
										<?php else: ?>
										<div class="span8">
										<?php endif; ?>
											<p>
												<?php echo get_field('abstract', $news->ID); ?> 
												<?php if(get_field('external_link', $news->ID)): ?>
													<a href="<?php echo get_field('external_link', $news->ID);?>" class="read-more-arrow">
												<?php else: ?>
													<a href="<?php echo get_permalink($news->ID); ?>" class="read-more-arrow">
												<?php endif; ?>
												›</a>
											</p>
										</div>
									</div>
								</div>
							
							<?php
								$i++;
							endforeach;
						}
					?>

					<?php
						$category = get_category_by_slug('news');
					?>
					
					<div class="news-more-links">
						<a class="news-more" href="<?php echo get_category_link($category->term_id); ?>"><?php _e('Mehr Meldungen','fau'); ?></a>
						<a class="news-rss" href="<?php echo get_category_feed_link($category->term_id); ?>">RSS</a>
					</div>
					
				</div>
				<div class="span4">
					
					<?php $topevent_posts = get_posts(array('tag' => 'top', 'numberposts' => 1));?>
					<?php foreach($topevent_posts as $topevent): ?>
						<div class="widget">
							<h2 class="small"><a href="<?php echo get_permalink($topevent->ID); ?>"><?php the_field('topevent_title', $topevent->ID); ?></a></h2>
							<div class="row">
								<?php if(get_field('topevent_image', $topevent->ID)): ?>
									<div class="span2">
										<?php $image = wp_get_attachment_image_src(get_field('topevent_image', $topevent->ID), 'topevent-thumb'); ?>
										<a href="<?php echo get_permalink($topevent->ID); ?>"><img src="<?php echo $image[0]; ?>"></a>
									</div>
									<div class="span2">
								<?php else: ?>
									<div class="span4">
								<?php endif; ?>
									<div class="topevent-description"><?php the_field('topevent_description', $topevent->ID); ?></div>
									</div>
							</div>
						</div>
					<?php endforeach; ?>
					
					<?php get_template_part('sidebar'); ?>
				</div>
			</div>
			
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
			
			
			</div>
			<div id="social">
				<div class="container">
					<div class="row">
						<?php if($options['socialmedia']): ?>
							<div class="span3">
								<h2 class="small"><strong>FAU</strong>Social</h2>
								<ul class="social">
									<?php if($options['socialmedia_facebook']): ?>
										<li class="social social-facebook"><a href="<?php echo $options['socialmedia_facebook']; ?>" target="_blank"><?php echo $options['socialmedia_facebook_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_twitter']): ?>
										<li class="social social-twitter"><a href="<?php echo $options['socialmedia_twitter']; ?>" target="_blank"><?php echo $options['socialmedia_twitter_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_gplus']): ?>
										<li class="social social-gplus"><a href="<?php echo $options['socialmedia_gplus']; ?>" target="_blank"><?php echo $options['socialmedia_gplus_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_youtube']): ?>
										<li class="social social-youtube"><a href="<?php echo $options['socialmedia_youtube']; ?>" target="_blank"><?php echo $options['socialmedia_youtube_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_vimeo']): ?>
										<li class="social social-vimeo"><a href="<?php echo $options['socialmedia_vimeo']; ?>" target="_blank"><?php echo $options['socialmedia_vimeo_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_xing']): ?>
										<li class="social social-xing"><a href="<?php echo $options['socialmedia_xing']; ?>" target="_blank"><?php echo $options['socialmedia_xing_text']; ?></a></li>
									<?php endif; ?>
									<?php if($options['socialmedia_pinterest']): ?>
										<li class="social social-pinterest"><a href="<?php echo $options['socialmedia_pinterest']; ?>" target="_blank"><?php echo $options['socialmedia_pinterest_text']; ?></a></li>
									<?php endif; ?>
								</ul>
							</div>
						<?php endif; ?>
						<div class="span9">
							<?php if(get_field('videos')): ?>
								<div class="row">
									<?php while(has_sub_field('videos')): ?>
                                    <?php
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
                                    ?>
                                    <?php if($wp_oembed_get !== false) : ?>
									<div class="span3">
										<?php echo $wp_oembed_get; ?>
									</div>
				                    <?php endif; ?>
				                    <?php endif; ?>
									<?php endwhile; ?>
								</div>
								<div class="pull-right link-all-videos">
									<a href="http://video.fau.de/"><?php _e('Alle Videos','fau'); ?></a>
								</div>
							<?php endif; ?>
							
						</div>						
					</div>
				</div>
			</div>
			<div class="container">
			

		</div>
	</div>


<?php get_footer(); ?>
