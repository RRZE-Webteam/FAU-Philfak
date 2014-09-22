<?php if(get_field('sidebar_text_above')): ?>
	<aside class="widget">
		<?php if(get_field('sidebar_title_above')): ?>
			<h2 class="small"><?php echo get_field('sidebar_title_above'); ?></h2>
		<?php endif; ?>
		<?php 
			if(function_exists('mimetypes_to_icons')) 
			{
				echo mimetypes_to_icons(get_field('sidebar_text_above')); 
			}
			else
			{
				echo get_field('sidebar_text_above');
			}
		?>
	</aside>
<?php endif; ?>