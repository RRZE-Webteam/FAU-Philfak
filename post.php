<?php
/**
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

?>


<div class="news-item">
	<h2>
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>
	<div class="news-meta-date"><?php echo get_the_date(); ?></div>

	<div class="row">
		<?php if(has_post_thumbnail( $post->ID )): ?>
		<div class="span3">
			<?php if(get_field('external_link', $post->ID)): ?>
				<a href="<?php echo get_field('external_link', $post->ID);?>" class="news-image">
			<?php else: ?>
				<a href="<?php echo get_permalink($post->ID); ?>" class="news-image">
			<?php endif; ?>
			<?php the_post_thumbnail('post-thumb'); ?></a>
		</div>
		<div class="span5">
		<?php else: ?>
		<div class="span8">
		<?php endif; ?>
			<?php the_field('abstract'); ?>
			<?php if(get_field('external_link', $post->ID)): ?>
				<a href="<?php echo get_field('external_link', $post->ID);?>" class="read-more-arrow">›</a>
			<?php else: ?>
				<a href="<?php echo get_permalink($post->ID); ?>" class="read-more-arrow">›</a>
			<?php endif; ?>
		</div>
	</div>
</div>