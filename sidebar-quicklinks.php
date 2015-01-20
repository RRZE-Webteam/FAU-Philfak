<?php 
 if ( function_exists('get_field') ) {

if(get_field('sidebar_quicklinks') || get_field('sidebar_quicklinks_external')): ?>
	<aside class="widget">
		<?php if(get_field('sidebar_title_quicklinks')): ?>
			<h2 class="small"><?php echo get_field('sidebar_title_quicklinks'); ?></h2>
		<?php endif; ?>
		<?php $quicklinks = get_field('sidebar_quicklinks'); 
		
		if (is_array($quicklinks)) {
		?>
		<ul class="tagcloud">
			<?php foreach($quicklinks as $quicklink): ?>
				<li class="tag"><a href="<?php echo get_permalink($quicklink->ID); ?>"><?php echo get_the_title($quicklink->ID); ?></a></li>
			<?php endforeach; ?>
			<?php while(has_sub_field('sidebar_quicklinks_external')): ?>
				<li class="tag"><a href="<?php the_sub_field('sidebar_quicklinks_external_link'); ?>"><?php the_sub_field('sidebar_quicklinks_external_text');?></a></li>
			<?php endwhile; ?>
		</ul>
		<?php } ?>
	</aside>
 <?php
 endif; 
  } ?>