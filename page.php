<?php
/**
 * The template for displaying all pages.
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
				
				<div class="span12">
					<?php if ( function_exists('the_field')) {
						if (get_field('headline')) {
						    echo "<h2>".get_field('headline')."</h2>\n";
						}
						if( get_field('abstract') != '') {
						     echo "<h3>".get_field('abstract')."</h3>\n";
						}
					}
					get_template_part('sidebar', 'inline'); 
					the_content(); ?>
				</div>
				
			</div>
		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>