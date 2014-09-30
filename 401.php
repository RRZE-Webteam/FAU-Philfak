<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php $options = get_option('fau_theme_options', array('breadcrumb_root' => 'fau.de')); ?>

	<div id="hero" class="hero-small">
		<div class="container">
			<div class="row">
				<div class="span12">
					<div class="breadcrumbs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $options['breadcrumb_root']; ?></a>
					</div>

					<div class="hero-meta-portal">
						401
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					<h1><?php _e('Anmeldung fehlgeschlagen','fau'); ?></h1>
				</div>
			</div>
		</div>
	</div>
	

	<div id="content">
		<div class="container">
		
			<div class="row">
				<div class="span6">
					<h2>
						<strong><?php _e('Es tut uns leid.','fau'); ?></strong><br>
						<?php _e('Leider ist Ihre Anmeldung fehlgeschlagen.','fau'); ?>
					</h2>
					<div class="row">
						<div class="span4 offset2"><img src="<?php echo get_bloginfo('template_directory'); ?>/img/friedrich-alexander.gif" alt="Friedrich Alexander" class="error-404-persons"></div>
					</div>
				</div>
			</div>

			<div class="hr"><hr></div>

		</div>
	</div>

<?php get_footer(); ?>