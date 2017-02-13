<?php
/**
 * nouvelles-trajectoires Theme Customizer
 *
 * @package nouvelles-trajectoires
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function nouvelles_trajectoires_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'nouvelles_trajectoires_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function nouvelles_trajectoires_customize_preview_js() {
	wp_enqueue_script( 'nouvelles_trajectoires_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'nouvelles_trajectoires_customize_preview_js' );


/*
* Ajout d'un bouton dans wysiwyg
*/
add_filter( 'mce_buttons_2', 'fb_mce_editor_buttons' );
function fb_mce_editor_buttons( $buttons ) {

    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/*
* Add Ajout de styles et classes dans wysiwyg
*/ 
add_filter( 'tiny_mce_before_init', 'fb_mce_before_init' );

function fb_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'btn',
            'styles' => array(
            	'display' => 'inline-block',
            	'height' => '35px',
            	'line-height' => '35px',
            	'text-align' => 'center',
            	'text-transform' => 'uppercase',
            	'padding' => '0 15px',
            	'color' => '#1063FF',
            	'border' => 'solid 1px #1063FF',
            	'border-radius' => '100px',
            	'text-decoration' => 'none'
            )
        ),
        array(
            'title' => 'Texte Big',
            'selector' => 'p',
            'classes' => 'text-intro',
            'styles' => array(
            	'font-size' => '32px',
            	'font-weight' => '100'
            )
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;

}

//Ajout des options du thème [ACF]
if( function_exists('acf_add_options_page') ) {	
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'parent_slug'	=> '',
		'position'		=> false,
		'icon_url'		=> false,
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Infos générales',
		'menu_title'	=> 'Infos générale',
		'parent_slug'	=> 'theme-options',
		'menu_slug'		=> 'theme-options-infos',
		'capability'	=> 'edit_posts',
		'position'		=> false,
		'icon_url'		=> false,
	));
	
}
