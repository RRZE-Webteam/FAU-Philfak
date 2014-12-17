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
					<?php 
					$headline = get_post_meta( $post->ID, 'headline', true );				
					if ( $headline) {
					     echo "<h2>".$headline."</h2>\n";
					}
					/* 
					 * Custom Field ist doch nur fuer Posts definiert?
					 */
					$abstract = get_post_meta( $post->ID, 'abstract', true );	
					if($abstract) {
						     echo "<h3>".$abstract."</h3>\n";
					}
					 
					get_template_part('sidebar', 'inline'); 
					the_content(); ?>
				</div>
				
			</div>
		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>