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
			<div class="span12">
				<?php if(function_exists('bcn_display')): ?>
					<div class="breadcrumbs">
						<a href="<?php echo fau_esc_url( home_url( '/' ) ); ?>"><?php echo $options['breadcrumb_root']; ?></a><span>/</span>
						<?php bcn_display(); ?>
					</div>
				<?php endif; ?>
				
				<div class="hero-meta-portal">
					<?php
						if(get_post_type() == 'page')
						{
							$parent = array_reverse(get_post_ancestors(get_the_ID()));
							if(isset($parent) && is_array($parent) && isset($parent[0]))
							{
								$first_parent = get_page($parent[0]);
							}

							if (isset($first_parent)) { //  && ($first_parent->ID != get_the_ID())) {
								echo $first_parent->post_title;
							}
						}
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span6">

				<h1><?php the_title(); ?></h1>
				
			</div>
		</div>
	</div>
</div>
