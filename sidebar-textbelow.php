<?php 
 if ( function_exists('get_field') ) {

    if(get_field('sidebar_text_below')): ?>
	<aside class="widget">
		<?php if(get_field('sidebar_title_below')): ?>
			<h2 class="small"><?php echo get_field('sidebar_title_below'); ?></h2>
		<?php endif; ?>
		<?php 
			if(function_exists('mimetypes_to_icons'))
			{
				echo mimetypes_to_icons(get_field('sidebar_text_below')); 
			}
			else 
			{
				echo get_field('sidebar_text_below');
			}
 		?>
	</aside>
<?php endif; 
 }
 ?>