<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */
?>

	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="span3">
					<p><img src="img/logo-fau-inverse.png"></p>
				</div>
				<div class="span3">
					<p>
						Friedrich-Alexander-Universität<br>
						Erlangen-Nürnberg<br>
						Schlossplatz 4<br>
						91054 Erlangen
					</p>
				</div>
				<div class="span6">
					<?php wp_nav_menu( array( 'theme_location' => 'meta-nav', 'container' => false, 'items_wrap' => '<ul id="footer-nav" class="%2$s">%3$s</ul>' ) ); ?>
				</div>
			</div>
		</div>
	</div>

	<?php wp_footer(); ?>
</body>
</html>