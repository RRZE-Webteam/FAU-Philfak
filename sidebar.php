<?php
/**
 * The template partial for displaying the sidebar
 *
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */


?>

<?php if(get_field('sidebar_text_above') || get_field('sidebar_personen') || get_field('sidebar_quicklinks') || get_field('sidebar_text_below')): ?>
	<div class="sidebar-inline">
		
		<?php if(get_field('sidebar_text_above')): ?>
			<aside class="widget">
				<?php if(get_field('sidebar_title_above')): ?>
					<h2 class="small"><?php echo get_field('sidebar_title_above'); ?></h2>
				<?php endif; ?>
				<?php echo get_field('sidebar_text_above'); ?>
			</aside>
		<?php endif; ?>
		
		<?php if(get_field('sidebar_personen')): ?>
			<?php $persons = get_field('sidebar_personen'); ?>
			<?php $i = 0; ?>
			<?php foreach($persons as $person): ?>
				<?php if($i == 0): ?>
					<?php the_widget('FAUPersonWidget', array('id' => $person->ID, 'title' => get_field('sidebar_title_personen'))); ?>
				<?php else: ?>
					<?php the_widget('FAUPersonWidget', array('id' => $person->ID)); ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		
		<?php if(get_field('sidebar_quicklinks')): ?>
			<aside class="widget">
				<?php if(get_field('sidebar_title_quicklinks')): ?>
					<h2 class="small"><?php echo get_field('sidebar_title_quicklinks'); ?></h2>
				<?php endif; ?>
				<?php $quicklinks = get_field('sidebar_quicklinks'); ?>
				<ul class="tagcloud">
					<?php foreach($quicklinks as $quicklink): ?>
						<li class="tag"><a href="<?php echo get_permalink($quicklink->ID); ?>"><?php echo get_the_title($quicklink->ID); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</aside>
		<?php endif; ?>
		
		<?php if(get_field('sidebar_text_below')): ?>
			<aside class="widget">
				<?php if(get_field('sidebar_title_below')): ?>
					<h2 class="small"><?php echo get_field('sidebar_title_below'); ?></h2>
				<?php endif; ?>
				<?php echo get_field('sidebar_text_below'); ?>
			</aside>
		<?php endif; ?>
		
	</div>
<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-right' ) ) : ?>
		<div class="sidebar-inline sidebar-inline-old">
			<?php dynamic_sidebar( 'sidebar-right' ); ?>
		</div>
	<?php endif; ?>