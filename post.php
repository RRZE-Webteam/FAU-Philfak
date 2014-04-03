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
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumb'); ?></a>
		</div>
		<div class="span5">
		<?php else: ?>
		<div class="span8">
		<?php endif; ?>
			<?php the_field('abstract'); ?>
			<a href="<?php the_permalink(); ?>">[…]</a>
		</div>
	</div>
</div>