<?php
/**
 * Template Name: Suche Veranstaltungen
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

global $post, $wp_rewrite;

$query = isset($_REQUEST['sq']) ? sanitize_text_field($_REQUEST['sq']) : '';

$paged = isset($_REQUEST['spg']) ? absint($_REQUEST['spg']) : 1;

get_header();
?>

<?php $options = get_option('fau_theme_options', array('breadcrumb_root' => 'fau.de')); ?>

<div id="hero" class="hero-small">
    <div class="container">
        <div class="row">
            <div class="span8">

                <div class="breadcrumbs">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo $options['breadcrumb_root']; ?></a><span>/</span>
                    <?php bcn_display(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="span3">
                <h1><?php _e('Veranstaltungen', 'fau'); ?></h1>
            </div>
            <div class="span9">
                <form role="search" method="get" class="searchform" action="">
                    <input type="hidden" name="" id="" value="">
                    <input type="text" value="<?php echo esc_attr($query); ?>" name="sq" id="sq" placeholder="<?php _e('Suchen nach...', 'fau'); ?>">
                    <input type="submit" id="searchsubmit" value="<?php _e('Finden', 'fau'); ?>">					
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
                    <?php if (is_active_sidebar('search-sidebar')) : ?>
                        <?php dynamic_sidebar('search-sidebar'); ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="span9">
                <?php if (!empty($query) && class_exists('CMS_Search')) : ?>
                    <?php
                    $engine = CMS_Search::instance();
                    $search_engine = 'veranstaltungen';

                    add_filter('cms_search_posts_per_page', function() {
                        return 10;
                    });

                    $posts = $engine->search($search_engine, $query, $paged);

                    if (!empty($posts)) : ?>
                        <?php
                        $pagenum_link = html_entity_decode(get_pagenum_link());
                        $query_args   = array();
                        $url_parts    = explode('&', $pagenum_link);

                        if(isset( $url_parts[1])) {
                            wp_parse_str($url_parts[1], $query_args);
                        }

                        $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
                        $pagenum_link = $pagenum_link . '%_%';

                        $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
                        $format .= '&amp;spg=%#%';

                        $total_pages = $engine->maxNumPages;
                        $current_page = max(1, $paged);
                        $paginate_links = paginate_links(
                            array(
                                'base' => $pagenum_link,
                                'format' => $format,
                                'total' => $total_pages,                        
                                'current' => $current_page,
                                'prev_next'    => true,
                                'prev_text'    => __('<span class="meta-nav">&larr;</span> Zurück', 'fau'),
                                'next_text'    => __('Weiter <span class="meta-nav">&rarr;</span>', 'fau'),                        
                            )
                        );
                        ?>
                        <h2 style="padding-top:4px"><?php _e('Suchergebnisse', 'fau'); ?></h2>                
                        <div class="search-result">                
                        <?php foreach ($posts as $post): setup_postdata($post); ?>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <?php the_excerpt(); ?>
                        <?php endforeach; ?>
                        </div>                                
                        <?php wp_reset_postdata(); ?>
                        <!-- begin pagination -->
                        <?php if($total_pages > 1) : ?>
                            <nav id="nav-pages" class="navigation paging-navigation" role="navigation">
                                <h3 class="screen-reader-text"><?php _e('Weitere Suchergebnisse', 'fau'); ?></h3>
                                <div class="nav-links">
                                    <?php echo $paginate_links; ?>
                                </div>
                            </nav>
                        <?php endif; ?>
                        <!-- end pagination -->                            
                    <?php else : ?>
                        <h2 style="padding-top: 4px"><?php _e('Leider konnte für Ihre Suche nichts gefunden werden.', 'fau'); ?></h2>
                    <?php endif; ?>
                <?php elseif(isset($_REQUEST['sq']) && empty($query) && class_exists('CMS_Search')) : ?>
                    <h2 style="padding-top: 4px"><?php _e('Bitte geben Sie einen Suchbegriff in das Suchfeld ein.','fau'); ?></h2>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>
