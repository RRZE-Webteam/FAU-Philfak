<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */
?>


<div id="hero" class="hero-small">
	<div class="container">
		<div class="row">
			<div class="span8">

			    <?php if(function_exists('bcn_display')): ?>
					<div class="breadcrumbs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">fau.de</a><span>/</span>
						<?php bcn_display(); ?>
					</div>
				<?php endif; ?>

				<h1><?php _e('Veranstaltungskalender','fau'); ?></h1>
			</div>
		</div>
	</div>
</div>
