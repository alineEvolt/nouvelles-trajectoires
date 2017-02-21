<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package nouvelles-trajectoires
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function nouvelles_trajectoires_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'nouvelles_trajectoires_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function nouvelles_trajectoires_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'nouvelles_trajectoires_pingback_header' );


class mono_walker extends Walker_Nav_Menu{
 function start_el(&$output, $item, $depth, $args){
  global $wp_query;
  $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
  $class_names = $value = '';
  $classes = empty( $item->classes ) ? array() : (array) $item->classes;
  
  $class_names = join( ' ', apply_filters( 'item_ancre', array_filter( $classes ), $item ) );
  $class_names = ' class="'. esc_attr( $class_names ) . '"';
  
  $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
  
  $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
  $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
  $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
  
  
  $parsedURL = parse_url( esc_attr( $item->url ));
  $cleanURL = substr_replace($parsedURL['path'],'',-1);//remove last '/';
  
  $pathTab = explode('/',$cleanURL);
  $pathTab[sizeof($pathTab)-1] = '#'.$pathTab[sizeof($pathTab)-1];
  $path = implode('/',$pathTab );
  
  $attributes .= ! empty( $item->url )        ? ' href="'   . $path .'"' : '';
  $attributes .= ! empty( $item->url )        ? ' data-title="'   .   apply_filters( 'the_title', $item->title, $item->ID ) .'"' : '';
  $attributes .= ! empty( $item->url )        ? ' id="item-'  .   sanitize_title($item->title) .'"' : '';
  $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
  
  if($depth != 0) $description = "";
  
  $item_output = $args->before;
  $item_output .= '<a'. $attributes .'>';
  $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
  $item_output .= $description.$args->link_after;
  $item_output .= '</a>';
  $item_output .= $args->after;
  
  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
 }
}

add_filter( 'wp_nav_menu_items', 'add_contact_btn', 10, 2 );

function add_contact_btn( $items, $args )
{
    $items .= '<li class="contact-btn"><a href="' . get_field('lien_contact', 'option') . '">Contact</a></li>';
    return $items;
}


// Ajout des notifications sur les synthèses en attente 
add_action( 'admin_menu', 'pending_posts_bubble_notif', 999 );
function pending_posts_bubble_notif() {

    global $menu;
    $args = array( 'public' => true ); 
    $post_types = get_post_types( $args );
    unset( $post_types['attachment'] );

    foreach( $post_types as $pt ) {

        $cpt_count = wp_count_posts( $pt );

        if ( $cpt_count->pending ) {
            $suffix = ( 'post' == $pt ) ? '' : "?post_type=$pt";

            $key = recursive_array_search_notif( "edit.php$suffix", $menu );

            if( !$key )
                return;

            $menu[$key][0] .= sprintf(
                '<span class="update-plugins count-%1$s" style="background-color:#d54e21;color:white; margin-left: 5px;"><span class="plugin-count">%1$s</span></span>',
                $cpt_count->pending 
            );
        }
    }
}

function recursive_array_search_notif( $needle, $haystack ) {
    foreach( $haystack as $key => $value ) {
        $current_key = $key;
        if( 
            $needle === $value 
            OR ( 
                is_array( $value )
                && recursive_array_search_notif( $needle, $value ) !== false 
            )
        ) 
        {
            return $current_key;
        }
    }
    return false;
}

/**
 * Adds styles from customizer to head of TinyMCE iframe.
 * These styles are added before all other TinyMCE stylesheets.
 * h/t Otto.
 */
function kwh_add_editor_style( $mceInit ) {
  // This example works with Twenty Sixteen.
  $backgroundBody = get_field('bkg_general_chat', 'option');
  $colorQuest = get_field('text_color_quest', 'option');
  $bkgQuest = get_field('bkg_bulles_quest', 'option');
  $colorResp = get_field('text_color_reponse', 'option');
  $bkgResp = get_field('bkg_bulles_reponse', 'option');
   $styles = 'body#tinymce.wp-editor { font-family: arial, helvetica, sans-serif; background: #EFF1F6 !important; color: #7184A6 !important; padding: 40px; max-width: 600px; margin: 0 auto; } p, h1, h2, h3, ul, li { color: #7184A6 !important; } p.question { clear: both; display: inline-block; float: left; padding: 10px; border-radius: 100px; background: #fff !important; color: #7184A6 !important; margin: 5px 0; } p.reponse { clear: both; display: inline-block; float: right; padding: 10px; border-radius: 100px; background: #1063FF !important; color: #fff !important; margin: 0; }';
  if ( !isset( $mceInit['content_style'] ) ) {
    $mceInit['content_style'] = $styles . ' ';
  } else {
    $mceInit['content_style'] .= ' ' . $styles . ' ';
  }
  return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'kwh_add_editor_style' );