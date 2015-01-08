<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

	<?php if(get_post_type() == 'event'): ?>
		<?php get_template_part('hero', 'events'); ?>
	<?php else: ?>
		<?php get_template_part('hero', 'category'); ?>
	<?php endif; ?>

	<div id="content">
		<div class="container">
		
			<div class="row">
				<div class="span8">
					
					<?php while ( have_posts() ) : the_post(); ?>
    					<?php get_template_part( 'post', get_post_type() ); ?>
					<?php endwhile; ?>
					
					<div class="navigation">
						<div class="nav-previous"><?php previous_posts_link(__('<span class="meta-nav">&laquo;</span> Neuere Beiträge', 'fau')); ?></div>
						<div class="nav-next"><?php next_posts_link(__('Ältere Beiträge <span class="meta-nav">&raquo;</span>', 'fau'), '' ); ?></div>
					</div>
				</div>
				
				<?php get_template_part('sidebar', 'news'); ?>
			</div>

		</div>
	</div>


<?php get_footer(); ?>
