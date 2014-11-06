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

	<div id="content">
		<div class="container">

			<div class="row">
				<div class="span8">
					
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="post-image">
							<?php the_post_thumbnail( 'post' ); ?>
							<?php if(get_post(get_post_thumbnail_id()) && get_post(get_post_thumbnail_id())->post_excerpt != ''): ?>
								<div class="post-image-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
							<?php endif; ?>
						</div>
						
					<?php endif; ?>

					<?php the_content(); ?>
					
				</div>
				
				<?php get_template_part('sidebar', 'news'); ?>
			</div>

		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>