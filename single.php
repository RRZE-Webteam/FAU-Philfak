<?php
/**
 * The template for displaying a single post.
 *
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('hero', 'small'); ?>

	<section id="content">
		<div class="container">

			<div class="row">
				<div class="span8">
					
					<article class="news-details">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
							<div class="post-image">
								<?php 

								$post_thumbnail_id = get_post_thumbnail_id(); 
								if ($post_thumbnail_id) {
									
									$full_image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, 'gallery-full');
									echo '<a class="lightbox" href="'.fau_esc_url($full_image_attributes[0]).'"';
										if(get_post(get_post_thumbnail_id()) && get_post(get_post_thumbnail_id())->post_excerpt != ''):
										 	echo ' title="'.get_post(get_post_thumbnail_id())->post_excerpt.'"';
										endif;
									echo '>';

								    $image_attributes = wp_get_attachment_image_src( $post_thumbnail_id, 'post' );							    
								    echo '<img src="'.fau_esc_url($image_attributes[0]).'" class="attachment-post wp-post-image" width="'.$image_attributes[1].'" height="'.$image_attributes[1].'" alt="">';
								
									echo '</a>';
								}

								if(get_post(get_post_thumbnail_id()) && get_post(get_post_thumbnail_id())->post_excerpt != ''): ?>
									<div class="post-image-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
								<?php endif; ?>
							</div>

						<?php endif; ?>
						<div class="news-meta-date"><?php echo get_the_date(); ?></div>   
						<?php the_content(); ?>
					</article>
					
				</div>
				
				<?php get_template_part('sidebar', 'news'); ?>
			</div>

		</div>
	</section>
	
<?php endwhile; ?>

<?php get_footer(); ?>