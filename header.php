<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nouvelles-trajectoires
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="page">
		<header id="masthead">
			<div class="wrapper">
				<div class="grid">
					<h1 class="logo one-third">
						<a href="#page">
							<img src="<?php echo get_template_directory_uri(); ?>/dist/images/logo-big.svg" alt="<?php echo get_bloginfo( 'name' ); ?>" width="322" height="40" />
						</a>
					</h1>
					<div id="mainnav" class="two-third">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
					</div>
				</div>
			</div>
		</header>
		<main id="main">




