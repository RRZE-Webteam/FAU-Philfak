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