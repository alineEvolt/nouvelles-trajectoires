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
				<div class="grid-3 has-gutter-xl">
					<h1 class="logo one-third">
						<?php
							if( is_front_page() ) {
								$homeLink = '#accueil';
							} else {
								$homeLink = '/#accueil';
							}
						?>
						<a href="<?php echo $homeLink; ?>" data-logo-1="<?php the_field('logo_1', 'option'); ?>" data-logo-2="<?php the_field('logo_2', 'option'); ?>" data-title="accueil">
							<img src="<?php the_field('logo_1', 'option'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" width="322" height="40" />
						</a>
					</h1>
					<div id="mainnav" class="two-thirds">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu','walker' => new mono_walker() ) ); ?>
					</div>
				</div>
			</div>
		</header>
		<main id="main">




