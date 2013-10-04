<?php
/**
 * Template Name: Portalseite
 *
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
					<?php the_content(); ?>
				</div>
			</div>

<?php endwhile; ?>

			
			<div class="hr"><hr></div>
			
			<div class="row">
			
			<?php 
				$subpages = get_field('unterseiten'); 
				
				if($subpages):
				
					foreach($subpages as $post):
					?>
					<div class="span3">
						<a class="subpage-item" href="<?php the_permalink(); ?>">
						
							<?php if(has_post_thumbnail($id)): ?>
								<?php echo get_the_post_thumbnail($id, array(300,150)); ?>
							<?php endif; ?>
							<h3><?php the_title(); ?></h3>
						</a>
					</div>					
					<?php
					
					endforeach;
				
				endif;
			?>
			
			</div>

		</div>
	</div>
	


<?php get_footer(); ?>