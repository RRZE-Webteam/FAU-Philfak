<?php
/**
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

?>

<div class="news-meta">
	<div class="news-meta-date"><?php echo get_the_date(); ?></div>
	<div class="news-meta-categories"><?php echo get_the_category_list(); ?></div>
</div>
<h2 class="small">
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

