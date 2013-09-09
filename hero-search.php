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

			    <div class="breadcrumbs">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a><span>/</span>
					<?php _e('Search','fau'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h1><?php _e('Search','fau'); ?></h1>
			</div>
			<div class="span9">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>
