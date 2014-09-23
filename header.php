<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage FAU
 * @since FAU 1.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
	<title><?php wp_title( '-', true, 'right' ); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<ul class="jumplinks">
		<li><a href="#content" class="jumplink-content"><?php _e('Zum Inhalt springen','fau'); ?></a></li>
		<li><a href="#s" class="jumplink-search"><?php _e('Zur Suche springen','fau'); ?></a></li>
		<li><a href="#nav" class="jumplink-nav"><?php _e('Zum Hauptmenü springen','fau'); ?></a></li>
		<?php if(strpos(get_page_template(), 'page-subnav') === FALSE): else: ?><li><a href="#subnav" class="jumplink-subnav"><?php _e('Zum Seitenmenü springen','fau'); ?></a></li><?php endif; ?>
	</ul>

	<div id="meta">
		<div class="container">
			<div class="pull-left">
				<?php wp_nav_menu( array( 'theme_location' => 'meta', 'container' => false, 'items_wrap' => '<ul id="meta-nav" class="%2$s">%3$s</ul>' ) ); ?>
			</div>
			<div class="pull-right">
				<?php if ( is_active_sidebar( 'language-switcher' ) ) : ?>
					<?php dynamic_sidebar( 'language-switcher' ); ?>
				<?php endif; ?>
			
				<?php get_search_form();?>
			</div>
		</div>
	</div>
	<noscript>
		<div id="no-script">
			<div class="container">
				<div class="notice">
					<?php _e('JavaScript deaktiviert 1','fau'); ?><br>
					<?php _e('JavaScript deaktiviert 2','fau'); ?>
				</div>
			</div>
		</div>
	</noscript>
	<div id="header">
		<div class="container">
			<?php $header_image = get_header_image();
			if ( ! empty( $header_image ) ) : ?>
				<a id="logo" title="Friedrich-Alexander Universität Erlangen-Nürnberg" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="Friedrich-Alexander Universität Erlangen-Nürnberg" /></a>
			<?php endif; ?>
			<a href="#" id="nav-toggle" class="hide-desktop">
				<div></div>
				<div></div>
				<div></div>
			</a>			
			<?php if(class_exists('Walker_Main_Menu', false)) wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'items_wrap' => '<ul id="nav">%3$s</ul>', 'depth' => 2, 'walker' => new Walker_Main_Menu) ); ?>
		</div>
	</div>


