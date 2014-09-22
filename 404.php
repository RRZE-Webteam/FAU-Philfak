<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

	<div id="hero" class="hero-small">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="breadcrumbs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">fau.de</a>
					</div>

					<div class="hero-meta-portal">
						404
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<h1><?php _e('Seite nicht gefunden','fau'); ?></h1>
				</div>
			</div>
		</div>
	</div>
	

	<div id="content">
		<div class="container">
		
			<div class="row">
				<div class="span8">
					<h2><?php _e('Leider konnte die gewünschte Seite nicht gefunden werden.','fau'); ?></h2>
					
					<form role="search" method="get" class="searchform searchform-content" action="http://localhost/wordpress/">
						<h3><?php _e('Vielleicht hilft Ihnen die Suche:','fau'); ?></h3>
						<?php
							
							$uri = $_SERVER['REQUEST_URI'];
							$uri = str_replace('/', ' ', $uri);

						?>
						<input type="text" value="<?php echo $uri ?>" name="s" id="s" placeholder="<?php _e('Searchterm','fau'); ?>">
						<input type="submit" id="searchsubmit" value="<?php _e('Find','fau'); ?>">
					</form>
				</div>
				<div class="span4">

				</div>
			</div>

			<div class="hr"><hr></div>

			<div class="row subpages-menu">
				<div class="span3">
					<?php if(has_nav_menu('error-1')): ?>
						<h3><?php echo fau_get_menu_name('error-1'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'error-1', 'container' => false, 'items_wrap' => '<ul class="sub-menu %2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('error-2')): ?>
						<h3><?php echo fau_get_menu_name('error-2'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'error-2', 'container' => false, 'items_wrap' => '<ul class="sub-menu %2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('error-3')): ?>
						<h3><?php echo fau_get_menu_name('error-3'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'error-3', 'container' => false, 'items_wrap' => '<ul class="sub-menu %2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
				<div class="span3">
					<?php if(has_nav_menu('error-4')): ?>
						<h3><?php echo fau_get_menu_name('error-4'); ?></h3>
						<?php wp_nav_menu( array( 'theme_location' => 'error-4', 'container' => false, 'items_wrap' => '<ul class="sub-menu %2$s">%3$s</ul>' ) ); ?>
					<?php endif; ?>
				</div>
			</div>
			
		</div>
	</div>

<?php get_footer(); ?>