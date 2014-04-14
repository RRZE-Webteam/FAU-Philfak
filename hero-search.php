<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */
?>


<div id="hero" class="hero-small">
	<div class="container">
		<div class="row">
			<div class="span8">

			    <div class="breadcrumbs">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">fau.de</a><span>/</span>
					<?php _e('Search','fau'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h1><?php _e('Search','fau'); ?></h1>
			</div>
			<div class="span9">
				<?php /* get_search_form(); */ ?>
				
				<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' )?>">
					<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Searchterm','fau'); ?>">
					<input type="submit" id="searchsubmit" value="<?php _e('Find','fau'); ?>">
					
					<?php
						$post_type = get_query_var('post_type');
						print_r($post_type);
						$post_type = $post_type[0];
					?>

					<br style="clear:both">
					<label class="search-radio-label">
						<input type="radio" name="post_type" value="page,post,event,person"<?php if( ! $post_type || $post_type == '' || $post_type == 'any') echo " checked"; ?>>
						Alle Inhalte
					</label>
					<label class="search-radio-label">
						<input type="radio" name="post_type" value="post"<?php if($post_type == 'post') echo " checked"; ?>>
						Nachrichten
					</label>
					<label class="search-radio-label">
						<input type="radio" name="post_type" value="event"<?php if($post_type == 'event') echo " checked"; ?>>
						Veranstaltungen
					</label>
					<label class="search-radio-label">
						<input type="radio" name="post_type" value="person"<?php if($post_type == 'person') echo " checked"; ?>>
						Personen
					</label>
				</form>
				
			</div>
		</div>
	</div>
</div>
