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
			<div class="span12">
				<?php if(function_exists('bcn_display')): ?>
					<div class="breadcrumbs">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Start</a><span>/</span>
						<?php bcn_display(); ?>
					</div>
				<?php endif; ?>
				
				<div class="hero-meta-portal">
					<?php
						$parent = array_reverse(get_post_ancestors(get_the_ID()));
						$first_parent = get_page($parent[0]);

					//	if($first_parent->ID != get_the_ID()) 
						{
							echo $first_parent->post_title;
						}
					?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span8">

				<h1><?php the_title(); ?></h1>
				
			</div>
		</div>
	</div>
</div>
