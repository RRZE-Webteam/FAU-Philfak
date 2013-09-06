<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

	<?php get_template_part('hero', 'category'); ?>

	<div id="content">
		<div class="container">
		
			<div class="row">
				<div class="span8">
					
					<?php while ( have_posts() ) : the_post(); ?>
						<?php if($i > 0): ?>
							<h2 class="small">
						<?php else: ?>
							<h2>
						<?php endif; ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
					  	
						<div class="row">
							<?php if(has_post_thumbnail( $post->ID )): ?>
							<div class="span3">
								<?php the_post_thumbnail(array(300,150)); ?>
							</div>
							<div class="span5">
							<?php else: ?>
							<div class="span8">
							<?php endif; ?>
								<?php the_content(); ?>
							</div>
						</div>
					
						<?php $i++; ?>
					<?php endwhile; ?>
					
				</div>
				<div class="span4">

				</div>
			</div>
			



		</div>
	</div>


<?php get_footer(); ?>