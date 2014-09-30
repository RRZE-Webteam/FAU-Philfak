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

			<div class="row">
				<div class="span3">
					<div class="search-sidebar">
						<?php if ( is_active_sidebar( 'search-sidebar' ) ) : ?>
							<?php dynamic_sidebar( 'search-sidebar' ); ?>
						<?php endif; ?>
					</div>
				</div>
				<div class="span9">
					<?php if(count(get_search_query()) > 0): ?>
						
						<?php if(have_posts()): ?>
							
							<h2 style="padding-top: 4px"><?php _e('Suchergebnisse','fau'); ?></h2>
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="search-result">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
								</div>
							<?php endwhile; ?>
							
						<?php else: ?>
							<h2 style="padding-top: 4px"><?php _e('Leider konnte für Ihre Suche nichts gefunden werden.','fau'); ?></h2>
						<?php endif; ?>
						
					<?php else: ?>
						<h2 style="padding-top: 4px"><?php _e('Bitte geben Sie einen Suchbegriff in das Suchfeld ein.','fau'); ?></h2>
					<?php endif; ?>
					
				</div>
			</div>

		</div>
	</div>

<?php get_footer(); ?>