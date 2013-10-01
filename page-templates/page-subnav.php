<?php
/**
 * Template Name: Seite mit Subnavigation
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
				<div class="span3">
					<?php /* wp_list_pages(array('sort_column' => 'menu_order', 'child_of' => $id)); */ ?>
					<?php $parent_page = get_top_parent_page_id($post->ID); ?>

					<ul id="subnav">
					<?php wp_list_pages("child_of=$parent_page&title_li="); ?>
					</ul>
					
				</div>
				<div class="span9">
					<?php the_content(); ?>
				</div>
			</div>

		</div>
	</div>
	
<?php endwhile; ?>

<?php get_footer(); ?>