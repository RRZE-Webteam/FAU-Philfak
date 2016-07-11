<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); 

$posttype = get_post_type();
?>

	<?php if($posttype == 'event') {
		get_template_part('hero', 'events');
	} elseif ($posttype == 'post') {
		get_template_part('hero', 'category'); 
	} else {
	    get_template_part('hero', 'index'); 
	}
	$active_sidebar = false;
	?>

	<div id="content">
		<div class="container">
		
			<div class="row">
			     <?php 
				if(get_post_type() != 'post') {
				    if ( is_active_sidebar( 'search-sidebar' ) ) { 	
					$active_sidebar = true; ?>
				<div class="span3">
					<div class="search-sidebar">
					    <?php dynamic_sidebar( 'search-sidebar' ); ?>
					</div>
				</div>
							
			     <?php } 					 
				} ?>
				    
				<div class="span8">
				    <main>
					<?php 
					if (($posttype == 'synonym') && ($options['index_synonym_listall'])) {					    
					    echo '<h2>'.__('Synonyme','fau')."</h2>\n";					    
					    echo fau_get_synonym();
					} elseif (($posttype == 'glossary') && ($options['index_glossary_listall'])) {    
					    echo '<h2>'.__('Glossar','fau')."</h2>\n";					    
					    echo fau_get_glossar();					    					    
					} else {	
					    $line=0;
					    while ( have_posts() ) : 
						the_post();  
						$line++;
						if( $posttype == 'event') {
						    get_template_part( 'post', 'event' ); 
						} elseif($posttype == 'synonym') { 	
						    echo fau_get_synonym($post->ID);
						} elseif($posttype == 'glossary') { 	
						    echo fau_get_glossar($post->ID);
						} elseif (($posttype == 'person') && (function_exists('fau_person'))) { 	
						//    if ($line>1) {
						//	echo "<hr>\n";
						//  }
						    
						    echo fau_person(array("id"=> $post->ID, 'format' => 'kompakt', 'showlink' => 1 )); // 

						    
						} elseif($posttype == 'post') { 
						      echo fau_display_news_teaser($post->ID,true);
						 } else { ?>


						    <h2 class="small">
							    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						    </h2>

						    <div class="row">
							    <?php if(has_post_thumbnail( $post->ID )): ?>
							    <div class="span3">
								    <?php the_post_thumbnail('post-thumb'); ?>
							    </div>
							    <div class="span5">
							    <?php else: ?>
							    <div class="span8">
							    <?php endif; ?>
								    <?php the_content(); ?>
							    </div>
						    </div>
						    <?php 




						 }
					    endwhile; 


					    if (($posttype=='glossary') || ($posttype=='person')) { ?>
						<nav class="navigation">
						    <div class="nav-previous"><?php previous_posts_link(__('<span class="meta-nav">&laquo;</span> Vorherige Einträge', 'fau')); ?></div>
						    <div class="nav-next"><?php next_posts_link(__('Weitere Einträge <span class="meta-nav">&raquo;</span>', 'fau'), '' ); ?></div>
						</nav>
					   	
					    <?php } elseif($posttype=='post') { ?>
						<nav class="navigation">
						    <div class="nav-previous"><?php previous_posts_link(__('<span class="meta-nav">&laquo;</span> Neuere Beiträge', 'fau')); ?></div>
						    <div class="nav-next"><?php next_posts_link(__('Ältere Beiträge <span class="meta-nav">&raquo;</span>', 'fau'), '' ); ?></div>
					    </nav>
					    <?php }
					} ?>
					
				   
				</div>
				 </main>
				    <?php if(get_post_type() == 'post') {
					 get_template_part('sidebar', 'news');
				    } ?>
				    
			</div>

		</div>
		<?php get_template_part('footer', 'social'); ?>	
	</div>


<?php 
get_footer(); 

