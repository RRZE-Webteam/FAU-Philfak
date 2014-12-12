<?php
/**
 * Template Name: Portalseite
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part('hero', 'small'); ?>

    <div id="content" class="content-portal">
	<div class="container">
	    <div class="row">
		<div class="span8">
		    <?php 
			$headline = get_post_meta( $post->ID, 'headline', true );				
			if ( $headline) {
			     echo "<h2>".$headline."</h2>\n";
			}
			$abstract = get_post_meta( $post->ID, 'abstract', true );	
			if($abstract) {
				     echo "<h3>".$abstract."</h3>\n";
			}
			the_content(); 
			?>
		</div>
		<div class="span4">
		    <?php get_template_part('sidebar'); ?>
		</div>
	    </div>
		
	    <?php  

	    $menuslug = get_post_meta( $post->ID, 'portalmenu-slug', true );	
	    if ($menuslug) { ?>	
		<div class="hr"><hr></div>
		<?php 
		
		fau_get_contentmenu($menuslug);
	      }
	    ?>

	</div>
    </div>
<?php endwhile; ?>

<?php get_footer(); ?>