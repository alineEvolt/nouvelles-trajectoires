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


add_action( 'transition_post_status', 'send_mails_on_publish', 10, 3 );

function send_mails_on_publish( $new_status, $old_status, $post )
{
  if ( 'pending' !== $new_status or 'pending' === $old_status
        or 'synthese' !== get_post_type( $post ) )
        return;

    $subscribers = get_users( array ( 'role' => 'administrator' ) );
    $emails      = array ();

    foreach ( $subscribers as $subscriber )
        $emails[] = $subscriber->user_email;

    $body = sprintf( 'Hey there is a new entry!
        See <%s>',
        get_permalink( $post )
    );


    wp_mail( $emails, 'New entry!', $body );
}