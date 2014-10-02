<?php
/**
 * The template for displaying the search page.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

	<?php get_template_part('hero', 'search'); ?>
	
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
					<?php if(strlen(get_search_query()) > 0): ?>
                    
						<?php if(have_posts()): ?>							
							<h2 style="padding-top: 4px"><?php _e('Suchergebnisse','fau'); ?></h2>
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="search-result">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
								</div>
							<?php endwhile; ?>
							<?php
                            global $wp_query, $wp_rewrite;
                            
                            if ( $wp_query->max_num_pages > 1 ) {
                                $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
                                $pagenum_link = html_entity_decode( get_pagenum_link() );
                                $query_args   = array();
                                $url_parts    = explode( '?', $pagenum_link );

                                if ( isset( $url_parts[1] ) ) {
                                    wp_parse_str( $url_parts[1], $query_args );
                                }

                                $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
                                $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

                                $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
                                $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

                                $links = paginate_links( array(
                                    'base'     => $pagenum_link,
                                    'format'   => $format,
                                    'total'    => $wp_query->max_num_pages,
                                    'current'  => $paged,
                                    'mid_size' => 1,
                                    'add_args' => array_map( 'urlencode', $query_args ),
                                    'prev_text' => __( '<span class="meta-nav">&larr;</span> Zurück', 'fau' ),
                                    'next_text' => __( 'Weiter <span class="meta-nav">&rarr;</span>', 'fau' ),
                                ) );
                                ?>
                                <?php if ( $links ) : ?>
                                    <nav id="nav-pages" class="navigation paging-navigation" role="navigation">
                                        <h3 class="screen-reader-text"><?php _e( 'Suchergebnissenavigation', 'fau' ); ?></h1>
                                        <div class="nav-links">
                                            <?php echo $links; ?>
                                        </div>
                                    </nav>
                                <?php endif;
                            } ?>
                            
						<?php else: ?>
							<h2 style="padding-top: 4px"><?php _e('Leider konnte für Ihre Suche nichts gefunden werden.','fau'); ?></h2>
						<?php endif; ?>
						
					<?php else: ?>
						<h2 style="padding-top: 4px"><?php _e('Bitte geben Sie einen Suchbegriff in das Suchfeld ein.','fau'); ?></h2>
					<?php endif; ?>
					
				</div>
			</div>

		</div>
	</div>

<?php get_footer(); ?>
