<?php if(get_field('sidebar_text_below')): ?>
	<aside class="widget">
		<?php if(get_field('sidebar_title_below')): ?>
			<h2 class="small"><?php echo get_field('sidebar_title_below'); ?></h2>
		<?php endif; ?>
		<?php echo get_field('sidebar_text_below'); ?>
	</aside>
<?php endif; ?>