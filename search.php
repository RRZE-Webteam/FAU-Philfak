<?php
/**
 * The template for displaying the search page.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

	<?php get_template_part('hero', 'search'); ?>
	
	<div id="content">
		<div class="container">

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="search-result">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_excerpt(); ?>
			</div>
	
		<?php endwhile; ?>

		</div>
	</div>

<?php get_footer(); ?>