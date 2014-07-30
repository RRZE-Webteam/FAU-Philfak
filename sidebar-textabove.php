<?php if(get_field('sidebar_text_above')): ?>
	<aside class="widget">
		<?php if(get_field('sidebar_title_above')): ?>
			<h2 class="small"><?php echo get_field('sidebar_title_above'); ?></h2>
		<?php endif; ?>
		<?php echo get_field('sidebar_text_above'); ?>
	</aside>
<?php endif; ?>