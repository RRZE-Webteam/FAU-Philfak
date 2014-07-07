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
						<div class="post-image"><?php the_post_thumbnail( 'post' ); ?></div>
					<?php endif; ?>

					<?php the_content(); ?>
					
				</div>
				
				<?php if(get_post_type() == 'post'): ?>
					<?php if ( is_active_sidebar( 'news-sidebar' ) ) : ?>
						<div class="span4">
							<?php dynamic_sidebar( 'news-sidebar' ); ?>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>

		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>