<?php
/**
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

global $options;
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('hero', 'small'); ?>

	<section id="content">
		<div class="container">
			
		<?php 
		echo fau_get_ad('werbebanner_seitlich',false);
		?>

			<div class="row">
				<div class="span12">
				    <?php 
				    $id = $post->ID;
				    if ($id) {
					echo fau_person_page($id);
					the_content();
				    } else { ?>
					<p class="hinweis">
					    <strong><?php _e('Es tut uns leid.','fau'); ?></strong><br>
					    <?php _e('Für den angegebenen Kontakt können keine Informationen abgerufen werden.','fau'); ?>
					</p>
				    <?php }  ?>
				</div>
				
			</div>
		</div>
	</section>
	
	
<?php endwhile; ?>

<?php get_footer(); ?>