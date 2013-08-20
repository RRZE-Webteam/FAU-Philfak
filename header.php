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
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '–', true, 'right' ); ?></title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="meta">
		<div class="container">
			<?php wp_nav_menu( array( 'theme_location' => 'meta', 'container' => false, 'items_wrap' => '<ul id="meta-nav" class="%2$s">%3$s</ul>' ) ); ?>
		</div>
	</div>
	<div id="header">
		<div class="container">
			<a href="/" id="logo"><img src="img/logo-fau.png"></a>
			<a href="#" id="nav-toggle" class="hide-desktop">
				<div></div>
				<div></div>
				<div></div>
			</a>			
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'items_wrap' => '<ul id="nav">%3$s</ul>', 'depth' => 2, 'walker' => new Walker_Main_Menu) ); ?>
		</div>
	</div>


