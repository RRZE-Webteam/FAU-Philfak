<?php
/**
 * Template Name: Seite mit Subnavigation
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('hero', 'small'); ?>

	<div id="content">
		<div class="container">
		
			<?php if ( is_active_sidebar( 'sidebar-top' ) ) : ?>
				<div class="row">	
					<div class="span12">
						<?php dynamic_sidebar( 'sidebar-top' ); ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="row">
			
				<div class="span3">
					<?php $parent_page = get_top_parent_page_id($id); ?>
					<?php
						$parent = get_page($parent_page);
					?>
					<h2 class="small menu-header">
						<a href="<?php echo get_permalink($parent->ID); ?>"><?php echo $parent->post_title; ?></a>
					</h2>
					<ul id="subnav">
					<?php wp_list_pages("child_of=$parent_page&title_li="); ?>
					</ul>
				</div>
				
				<div class="span9">
					<h2><?php the_field('headline'); ?></h2>
					<?php if( get_field('abstract') != ''): ?>
						<h3 class="abstract"><?php the_field('abstract'); ?></h3>
					<?php endif; ?>
					
					<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
						<div class="sidebar-inline">
							<?php dynamic_sidebar( 'sidebar-right' ); ?>
						</div>
					<?php endif; ?>

					<?php the_content(); ?>
				</div>
				
			</div>
			
			<?php if ( is_active_sidebar( 'banner-area' ) ) : ?>
				<div class="hr"><hr></div>
				<?php dynamic_sidebar( 'banner-area' ); ?>
			<?php endif; ?>

		</div>
		
		<?php if( ! get_field('hide_pdf_button') && $post->post_password == ''): ?>
		<ul class="page-print-actions">
			<li>
				<?php
					$permalink = add_query_arg( 'print' , 'pdf' , get_permalink( $post->ID ) );
					echo '<a href="' . $permalink . '" class="page-print-pdf" target="_blank"><div class="icon"></div><div class="text">PDF dieser Seite</div></a>';
				?>
			</li>
			<li>
				<a href="javascript:window.print()" class="page-print"><div class="icon"></div><div class="text">Seite drucken</div></a>
			</li>
		</ul>
		<?php endif; ?>
	</div>
	
	
<?php endwhile; ?>

<?php get_footer(); ?>