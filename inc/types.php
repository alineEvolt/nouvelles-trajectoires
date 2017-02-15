<?php
//load custom post type [chat]
function chat() {

  $labels = array(
    'name'                  => _x( 'Chat', 'Post Type General Name', 'chatux' ),
    'singular_name'         => _x( 'Chat', 'Post Type Singular Name', 'chatux' ),
    'menu_name'             => __( 'Chat', 'chatux' ),
    'name_admin_bar'        => __( 'Chat', 'chatux' ),
    'archives'              => __( 'Tous les chats', 'chatux' ),
    'parent_item_colon'     => __( 'Chat parente', 'chatux' ),
    'all_items'             => __( 'Tous les chats', 'chatux' ),
    'add_new_item'          => __( 'Ajouter un nouveau chat', 'chatux' ),
    'add_new'               => __( 'Ajouter un chat', 'chatux' ),
    'new_item'              => __( 'Nouveau chat', 'chatux' ),
    'edit_item'             => __( 'Editer le chat', 'chatux' ),
    'update_item'           => __( 'Mettre le chat à jour', 'chatux' ),
    'view_item'             => __( 'Voir le chat', 'chatux' ),
    'search_items'          => __( 'Chercher un chat', 'chatux' ),
    'not_found'             => __( 'Aucun chat trouvé', 'chatux' ),
    'not_found_in_trash'    => __( 'Aucun chat trouvé dans la corbeille', 'chatux' ),
    'featured_image'        => __( '', 'chatux' ),
    'set_featured_image'    => __( '', 'chatux' ),
    'remove_featured_image' => __( '', 'chatux' ),
    'use_featured_image'    => __( '', 'chatux' ),
    'insert_into_item'      => __( 'Insérer dans le chat', 'chatux' ),
    'uploaded_to_this_item' => __( '', 'chatux' ),
    'items_list'            => __( 'Liste des chats', 'chatux' ),
    'items_list_navigation' => __( '', 'chatux' ),
    'filter_items_list'     => __( '', 'chatux' ),
  );
  $args = array(
    'label'                 => __( 'Chat', 'chatux' ),
    'description'           => __( 'Post Type Description', 'chatux' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'author', 'editor', 'thumbnail', 'page-attributes', 'post-formats' ),
    'hierarchical'          => true,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-admin-comments',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
  );
  register_post_type( 'chat', $args );

}
add_action( 'init', 'chat', 0 );


//Custom post type "Syntheses"
function synthese() {

  $labelsSynthese = array(
    'name'                  => _x( 'Réponses du chat', 'Post Type General Name', 'chatux' ),
    'singular_name'         => _x( 'Réponse du chat', 'Post Type Singular Name', 'chatux' ),
    'menu_name'             => __( 'Réponses', 'chatux' ),
    'name_admin_bar'        => __( 'Réponses du chat', 'chatux' ),
    'archives'              => __( 'Toutes les réponses', 'chatux' ),
    'parent_item_colon'     => __( 'Réponse parente', 'chatux' ),
    'all_items'             => __( 'Toutes les réponses', 'chatux' ),
    'add_new_item'          => __( 'Ajouter une réponse', 'chatux' ),
    'add_new'               => __( 'Ajouter une réponse', 'chatux' ),
    'new_item'              => __( 'Nouvelle réponse', 'chatux' ),
    'edit_item'             => __( 'Editer la réponse', 'chatux' ),
    'update_item'           => __( 'Mettre la réponse à jour', 'chatux' ),
    'view_item'             => __( 'Voir la réponse', 'chatux' ),
    'search_items'          => __( 'Chercher une réponse', 'chatux' ),
    'not_found'             => __( 'Aucune réponse trouvée', 'chatux' ),
    'not_found_in_trash'    => __( 'Aucune réponse trouvée dans la corbeille', 'chatux' ),
    'featured_image'        => __( '', 'chatux' ),
    'set_featured_image'    => __( '', 'chatux' ),
    'remove_featured_image' => __( '', 'chatux' ),
    'use_featured_image'    => __( '', 'chatux' ),
    'insert_into_item'      => __( 'Insérer dans la réponse', 'chatux' ),
    'uploaded_to_this_item' => __( '', 'chatux' ),
    'items_list'            => __( 'Liste des réponses', 'chatux' ),
    'items_list_navigation' => __( '', 'chatux' ),
    'filter_items_list'     => __( '', 'chatux' ),
  );
  $argsSynthese = array(
    'label'                 => __( 'Réponses', 'chatux' ),
    'description'           => __( 'Post Type Description', 'chatux' ),
    'labels'                => $labelsSynthese,
    'supports'              => array( 'title', 'author', 'editor', 'thumbnail', 'page-attributes', 'post-formats' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 6,
    'menu_icon'             => 'dashicons-admin-comments',
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
  );
  register_post_type( 'synthese', $argsSynthese );

}
add_action( 'init', 'synthese', 0 );

function __update_post_meta( $post_id, $field_name, $value = '' ) {
  if ( empty( $value ) OR ! $value )
  {
      delete_post_meta( $post_id, $field_name );
  }
  elseif ( ! get_post_meta( $post_id, $field_name ) )
  {
      add_post_meta( $post_id, $field_name, $value );
  }
  else
  {
      update_post_meta( $post_id, $field_name, $value );
  }
}

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
  return $toolbars;
}


// Ajax function wp_insert_post (synthèses)
add_action( 'wp_ajax_nopriv_chatux_create', 'chatux_create' );
add_action( 'wp_ajax_chatux_create', 'chatux_create' );
 
function chatux_create() {

  $results = '';

  $post_title = $_POST['post_title'];
  $questions = $_POST['questions'];
  $name = $_POST['name'];
  $email = $_POST['email'];


  if(isset($_POST['post_title']) && isset($_POST['questions'])) {
    // Create post object
    $new_chatux_post = array(
      'post_type'   => 'synthese',
      'post_title'  => $post_title,
      'post_content' => $questions,
      'post_status' => 'pending',
      'post_author' => 1,
    );
     
    // Insert the post into the database
    $the_post_id = wp_insert_post( $new_chatux_post );

    __update_post_meta( $the_post_id, 'nom_synthese', $name );
    __update_post_meta( $the_post_id, 'email_synthese', $email );

    die($results);
  }
};