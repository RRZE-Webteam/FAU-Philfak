<?php
/**
 * Template Name: Seite mit Subnavigation
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
				
				<?php if ( is_active_sidebar( 'menu-subnav' ) ) : ?>
					<div class="span3">
						<?php dynamic_sidebar( 'menu-subnav' ); ?>
					</div>
				<?php endif; ?>
				
				<div class="span9">
					<?php the_content(); ?>
				</div>
			</div>

		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>