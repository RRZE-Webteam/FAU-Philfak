<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

	<?php if(get_post_type() == 'event'): ?>
		<?php get_template_part('hero', 'events'); ?>
	<?php else: ?>
		<?php get_template_part('hero', 'category'); ?>
	<?php endif; ?>

	<div id="content">
		<div class="container">
		
			<div class="row">
				<div class="span8">
					
					<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'post', get_post_type() ); ?>
					<?php endwhile; ?>
					
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


<?php get_footer(); ?>