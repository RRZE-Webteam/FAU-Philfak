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
		
			<?php if ( is_active_sidebar( 'sidebar-top' ) ) : ?>
				<div class="row">	
					<div class="span12">
						<?php dynamic_sidebar( 'sidebar-top' ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="row">
			
				<?php $content_span = 12; ?>
				
				<div class="span<?php echo $content_span; ?>">
					<h2><?php the_field('headline'); ?></h2>
					<?php if( get_field('abstract') != ''): ?>
						<h3 class="abstract"><?php the_field('abstract'); ?></h3>
					<?php endif; ?>
							
					<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
						<div class="sidebar-inline">
							<?php dynamic_sidebar( 'sidebar-right' ); ?>
						</div>
					<?php endif; ?>
									
					<?php the_content(); ?>
				</div>
				
			</div>

<?php endwhile; ?>
			
			<?php if ( is_active_sidebar( 'menu-subpages' ) ) : ?>
				<div class="hr"><hr></div>
				<?php
					$widgets = wp_get_sidebars_widgets();
					$count = count($widgets['menu-subpages']);
				?>
				<div class="portal-subpages<?php if($count > 1) echo ' portal-subpages-tabs'; ?>">
					<?php dynamic_sidebar( 'menu-subpages' ); ?>
				</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'banner-area' ) ) : ?>
				<div class="hr"><hr></div>
				<?php dynamic_sidebar( 'banner-area' ); ?>
			<?php endif; ?>

		</div>
	</div>
	


<?php get_footer(); ?>