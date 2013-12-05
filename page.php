<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
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
			
				<?php $content_span = 12; ?>
				<?php if ( is_active_sidebar( 'menu-subnav' ) ) $content_span -= 3; ?>
				<?php if ( is_active_sidebar( 'sidebar-right' ) ) $content_span -= 3; ?>
				
				<?php if ( is_active_sidebar( 'menu-subnav' ) ) : ?>
					<div class="span3">
						<?php dynamic_sidebar( 'menu-subnav' ); ?>
					</div>
				<?php endif; ?>
				
				<div class="span<?php echo $content_span; ?>">
					<?php the_content(); ?>
				</div>
				
				<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
					<div class="span3">
						<?php dynamic_sidebar( 'sidebar-right' ); ?>
					</div>
				<?php endif; ?>
				
			</div>

		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>