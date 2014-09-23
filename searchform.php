<?php
/**
* The template for the search form.
*
* @package WordPress
* @subpackage FAU
* @since FAU 1.0
*/
?>

<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' )?>">
	<label for="s"><?php _e('Searchterm','fau'); ?></label>
	<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="<?php _e('Searchterm','fau'); ?>">
	<input type="submit" id="searchsubmit" value="<?php _e('Find','fau'); ?>">
</form>