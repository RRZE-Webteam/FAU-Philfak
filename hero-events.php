<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */
	    
global $options;
?>

<section id="hero" class="hero-small">
	<div class="container">
		<div class="row">
			<div class="span8">

			    <?php if(function_exists('bcn_display')): ?>
					<div class="breadcrumbs">
						<a href="<?php echo fau_esc_url( home_url( '/' ) ); ?>"><?php echo $options['breadcrumb_root']; ?></a><span>/</span>
						<?php bcn_display(); ?>
					</div>
				<?php endif; ?>

				<h1><?php echo $options['title_hero_events']; ?></h1>
			</div>
		</div>
	</div>
</section>
