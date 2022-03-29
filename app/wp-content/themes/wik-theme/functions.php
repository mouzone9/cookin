<?php

/* ADD SUPPORTS */
function wik_theme_supports() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
}
add_action( 'after_setup_theme', "wik_theme_supports");
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
add_theme_support( 'post-thumbnails' );

add_action( 'after_setup_theme', "wik_theme_supports" );

/* ADD STYLES */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'wik-css', get_template_directory_uri() . "/dist/main.css" );
	wp_enqueue_script( 'wik-js', get_template_directory_uri() . "/dist/main.js" );
} );

/* ADD SVG SUPPORT */
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'baniers' ) );
    return $query;
}


	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes ) {

	global $wp_version;
	if ( $wp_version !== '4.7.1' ) {
		return $data;
	}

	$filetype = wp_check_filetype( $filename, $mimes );

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];

}, 10, 4 );


/* Remove admin bar */
if ( ! is_admin() && ! current_user_can( "manage_options" ) ) {
	add_filter( "show_admin_bar", "__return_false" );
}

/* Add CPT "recipe" */

function add_cpt_recipe() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'               => _x( 'Recette', 'Post Type General Name' ),
		// Le nom au singulier
		'singular_name'      => _x( 'Recette', 'Post Type Singular Name' ),
		// Le libellé affiché dans le menu
		'menu_name'          => __( 'Recettes' ),
		// Les différents libellés de l'administration
		'all_items'          => __( 'Toutes les recettes' ),
		'view_item'          => __( 'Voir les recettes' ),
		'add_new_item'       => __( 'Ajouter une nouvelle recette' ),
		'add_new'            => __( 'Ajouter' ),
		'edit_item'          => __( 'Editer la recette' ),
		'update_item'        => __( 'Modifier la recette' ),
		'search_items'       => __( 'Rechercher une recette' ),
		'not_found'          => __( 'Non trouvée' ),
		'not_found_in_trash' => __( 'Non trouvée dans la corbeille' ),
	);

	// On peut définir ici d'autres options pour notre custom post type

	$args = array(
		'label'        => __( 'Recette' ),
		'description'  => __( 'Tous sur Recette' ),
		'labels'       => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'     => array(
			'title',
			'editor',
			'excerpt',
			'author',
			'thumbnail',
			'comments',
			'revisions',
			'custom-fields',
		),
		/*
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical' => false,
		'public'       => true,
		'has_archive'  => true,
		'rewrite'      => array( 'slug' => 'series-tv' ),

	);

	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'recipe', $args );

}

add_action( 'init', 'add_cpt_recipe', 0 );


//ajouter une nouvelle zone de menu à mon thème
function register_menus() {
	register_nav_menu( 'header-base-menu', __( 'Menu Header - Base' ) );
	register_nav_menu( 'header-connected-menu', __( 'Menu Header - Connecté' ) );

}

add_action( 'init', 'register_menus' );

add_action( "admin_post_wik_add_recipe", function () {
	if ( $_POST ) {

		$recipe = wp_insert_post( [
			"post_content" => $_POST["recipe_recipe"],
			"post_title"   => $_POST["recipe_name"],
			"post_type"    => "recipe",
			"post_status"  => "pending",
			"post_author"  => get_current_user_id()
		] );

		$thumb_id = media_handle_upload("recipe_thumb", 0);
		if ( ! is_wp_error( $recipe ) ) {
			set_post_thumbnail($recipe, $thumb_id);
//			addMessage(sprintf( "Nouvelle recette '%s' crée !", get_post( $recipe )->post_title ));
			wp_redirect( $_POST["_wp_http_referer"]);
		} else {
			wp_redirect( $_POST["_wp_http_referer"] . "?message=" . sprintf( "<p class='alert'>%s</p>", $recipe->get_error_message() ) );
		}
	}
} );
