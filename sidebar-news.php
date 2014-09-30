
<div class="span4">
	<?php if(get_post_type() == 'post'): ?>
		
		<aside id="search-widget" class="widget widget_search">
			<h2 class="small">
				<?php _e('In FAU aktuell suchen','fau'); ?>
			</h2>
			<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' )?>">
				<label for="s"><?php _e('Searchterm','fau'); ?></label>
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Searchterm','fau'); ?>">
				<input type="hidden" value="post" name="post_type">
				<input type="submit" id="searchsubmit" value="<?php _e('Find','fau'); ?>">
			</form>

		</aside>
		
		
		
		<?php if ( is_active_sidebar( 'news-sidebar' ) ) : ?>
			<?php dynamic_sidebar( 'news-sidebar' ); ?>
		<?php endif; ?>
	<?php endif; ?>
</div>
