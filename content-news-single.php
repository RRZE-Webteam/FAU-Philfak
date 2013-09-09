<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */
?>

	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="news-image"><?php the_post_thumbnail( array(770, 385) ); ?></div>
	<?php endif; ?>

	<?php the_content(); ?>