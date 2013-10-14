<?php
/**
 * Template Name: Portalseite
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
				<div class="span12">
					<?php the_content(); ?>
				</div>
			</div>

<?php endwhile; ?>
			
			<?php if ( is_active_sidebar( 'menu-subpages' ) ) : ?>
				<div class="hr"><hr></div>
				<?php dynamic_sidebar( 'menu-subpages' ); ?>
			<?php endif; ?>

		</div>
	</div>
	


<?php get_footer(); ?>