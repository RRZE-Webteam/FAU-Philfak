<?php
/**
 * The template for displaying a single post.
 *
 *
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

						<?php endif; 
						
						
						
						$output = '';
						$categories = get_the_category();
						$separator = ",\n ";
						$thiscatstr = '';
						$typestr = '';
						if($categories){
						    $typestr .= '<span class="post-meta-categories fa fa-tag"> ';
						    $typestr .= __('Kategorie', 'fau');
						    $typestr .= ': ';
						    
						    foreach($categories as $category) {
							$thiscatstr .= '<a href="'.get_category_link( $category->term_id ).'">'.$category->cat_name.'</a>'.$separator;
						    }
						    $typestr .= trim($thiscatstr, $separator);
						    $typestr .= '</span> ';
						}


						$output .= '<div class="post-meta">'."\n";
					//	$output .= $typestr;
						$output .= '<span class="post-meta-date fa fa-calendar"> '.get_the_date('',$post->ID)."</span>\n";
						$output .= '</div>'."\n";
	
						echo $output;    
						the_content();
						
						if ($options['post_display_category_below']) {
						    $output = '<div>'."\n";
						    $output .= $typestr;
						    $output .= '</div>'."\n";
						    echo $output;   
						}
						?>
					    
						
					</article>
					
				</div>
				
				<?php get_template_part('sidebar', 'news'); ?>
			</div>

		</div>
	</section>
	
<?php endwhile; ?>

<?php get_footer(); ?>