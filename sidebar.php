<?php
/**
 * The template partial for displaying the sidebar
 *
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */


?>

<?php 
 if ( function_exists('get_field') ) {
    if(get_field('sidebar_text_above') || get_field('sidebar_personen') || get_field('sidebar_quicklinks') || get_field('sidebar_quicklinks_external') || get_field('sidebar_text_below')): ?>
	<?php get_template_part('sidebar', 'textabove'); ?>
	<?php get_template_part('sidebar', 'personen'); ?>
	<?php get_template_part('sidebar', 'quicklinks'); ?>
	<?php get_template_part('sidebar', 'textbelow'); ?>
 <?php endif; } ?>
