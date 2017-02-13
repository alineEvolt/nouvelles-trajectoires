<?php
/**
 * nouvelles-trajectoires functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nouvelles-trajectoires
 */

if ( ! function_exists( 'nouvelles_trajectoires_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function nouvelles_trajectoires_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on nouvelles-trajectoires, use a find and replace
	 * to change 'nouvelles-trajectoires' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'nouvelles-trajectoires', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	//Ajout des tailles d'image
	add_image_size('picto_big', 138, 138, false);
	add_image_size('picto_small', 75, 75, false);


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'nouvelles-trajectoires' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'nouvelles_trajectoires_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nouvelles_trajectoires_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'nouvelles-trajectoires' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'nouvelles-trajectoires' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'nouvelles_trajectoires_widgets_init' );


//Add google web font
function wpb_add_google_fonts() {

wp_enqueue_style( 'nt-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900', false ); 
}

add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

/**
 * Enqueue scripts and styles.
 */
function nouvelles_trajectoires_scripts() {
	wp_enqueue_style( 'nt-style', get_stylesheet_uri() );

	/* à remettre pour le build (prod)*/
	//wp_enqueue_style( 'nt-styles', get_template_directory_uri() . '/dist/css/styles.min.css' );
    
    //A virer pour le build
    wp_enqueue_style( 'nt-styles', get_template_directory_uri() . '/app/css/knacss.css' );

    wp_enqueue_script( 'nt-modernirz', get_template_directory_uri() . '/dist/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js', array("jquery"), '20170207', false );

		wp_enqueue_script( 'nt-functions', get_template_directory_uri() . '/dist/js/main.min.js', array("jquery"), '20170207', true );


}
add_action( 'wp_enqueue_scripts', 'nouvelles_trajectoires_scripts' );


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';