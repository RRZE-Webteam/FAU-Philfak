<?php
/**
 * Template Name: Suche Nachrichten
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

global $post;
 
$query = isset( $_REQUEST['sq'] ) ? sanitize_text_field( $_REQUEST['sq'] ) : '';
 
$pag = isset( $_REQUEST['cmsp'] ) ? absint( $_REQUEST['cmsp'] ) : 1;

get_header(); ?>

<?php $options = get_option('fau_theme_options', array('breadcrumb_root' => 'fau.de')); ?>

<div id="hero" class="hero-small">
	<div class="container">
		<div class="row">
			<div class="span8">

			    <div class="breadcrumbs">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo $options['breadcrumb_root']; ?></a><span>/</span>
					<?php bcn_display(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span3">
				<h1><?php _e('Nachrichten','fau'); ?></h1>
			</div>
			<div class="span9">
				<form role="search" method="get" class="searchform" action="">
                    <input type="hidden" name="" id="" value="">
					<input type="text" value="<?php echo esc_attr($query); ?>" name="sq" id="sq" placeholder="<?php _e('Searchterm', 'fau'); ?>">
					<input type="submit" id="searchsubmit" value="<?php _e('Find','fau'); ?>">					
				</form>
				
			</div>
		</div>
	</div>
</div>

<div id="content">
    <div class="container">

        <div class="row">
            <div class="span3">
                <div class="search-sidebar">
                    <?php if ( is_active_sidebar( 'search-sidebar' ) ) : ?>
                        <?php dynamic_sidebar( 'search-sidebar' ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span9">
                <h2 style="padding-top:4px"><?php _e('Suchergebnisse', 'fau'); ?></h2>
                <?php if(!empty($query) && class_exists('CMS_Search')) : ?>
                    <?php
                    $engine = CMS_Search::instance();
                    $search_engine = 'nachrichten';

                    add_filter( 'cms_search_posts_per_page', function() { 
                        return 10;
                    });

                    $posts = $engine->search($search_engine, $query, $pag);

                    $prev_page = $pag > 1 ? $pag - 1 : false;
                    $next_page = $pag < $engine->maxNumPages ? $pag + 1 : false;
                    ?>

                    <div class="search-result">
                        <?php if(!empty($posts) ) : ?>
                        <?php foreach($posts as $post): setup_postdata($post); ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <?php the_excerpt(); ?>                        
                        <?php endforeach; ?>
                        <?php else: ?>
                            <h2 style="padding-top: 4px"><?php _e('Leider konnte für Ihre Suche nichts gefunden werden.','fau'); ?></h2>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
