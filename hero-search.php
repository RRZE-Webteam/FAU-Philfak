<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */
?>

<?php
global $options;
?>

<div id="hero" class="hero-small">
	<div class="container">
		<div class="row">
			<div class="span8">

			    <div class="breadcrumbs">
					<a href="<?php echo fau_esc_url( home_url( '/' ) ); ?>"><?php echo $options['breadcrumb_root']; ?></a><span>/</span>
					<?php _e('Suche','fau'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h1><?php _e('Suche','fau'); ?></h1>
			</div>
			<div class="span9">
				<?php /* get_search_form(); */ ?>
				
				<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' )?>">
					<input type="text" value="<?php the_search_query(); ?>" name="s" placeholder="<?php _e('Suchen nach...','fau'); ?>">
					<input type="submit" id="searchsubmit" value="<?php _e('Finden','fau'); ?>">
				</form>
				
			</div>
		</div>
	</div>
</div>
