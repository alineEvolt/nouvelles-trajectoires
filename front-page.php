<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nouvelles-trajectoires
 */

get_header();

		// Intro -> page d'accueil 
		echo get_template_part('/template-parts/content', 'home');

		$menu_name = 'menu-1';
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] )) {
		    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
		    $menu_items = wp_get_nav_menu_items($menu->term_id);
		}
		foreach ( $menu_items as $menu_item ) {    

			$section_id = $menu_item->object_id;
			$each_section = new WP_Query( array( 'page_id' => $section_id ) ); 

			if ( $each_section->have_posts() ) :
				while ( $each_section->have_posts() ) : $each_section->the_post();
//echo 'section id : ' . $section_id;
					echo get_template_part('/template-parts/content', 'page');

				endwhile;
			endif;

		}

get_footer();
