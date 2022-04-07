<?php

require_once( 'meta-data.php' );

/* ADD SUPPORTS */
function wik_theme_supports() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
}

add_action( 'after_setup_theme', "wik_theme_supports" );
add_theme_support( 'post-thumbnails' );

add_action( 'after_setup_theme', "wik_theme_supports" );

/* ADD STYLES */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'wik-css', get_template_directory_uri() . "/dist/main.css" );
	wp_deregister_script( 'jquery' );
	wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true );
	wp_enqueue_script( 'wik-js', get_template_directory_uri() . "/dist/main.js", array( 'jquery' ), '1.0.0', true );
} );

/* ADD SVG SUPPORT */
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

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
if ( ! is_admin() && ! current_user_can( "manage_recipe" ) ) {
	add_filter( "show_admin_bar", "__return_false" );
}

/* Add CPT "recipe" */

function add_cpt_recipe() {


	$labels = array(
		'name'               => _x( 'Recette', 'Post Type General Name' ),
		'singular_name'      => _x( 'Recette', 'Post Type Singular Name' ),
		'menu_name'          => __( 'Recettes' ),
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

	$args = array(
		'label'              => __( 'Recette' ),
		'description'        => __( 'Tous sur Recette' ),
		'labels'             => $labels,
		'supports'           => array(
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
		'show_in_rest'       => true,
		'hierarchical'       => false,
		'public'             => true,
		'has_archive'        => true,
		"show_in_menu"       => true,
		'publicly_queryable' => true,

		'rewrite'    => array( 'slug' => 'recette' ),
		'taxonomies' => array( 'category' ),

		'capabilities' => [
			'edit_post'          => "edit_recipe",
			'edit_posts'         => "edit_recipe",
			'read_post'          => "edit_recipe",
			"delete_post"        => "edit_recipe",
			"publish_posts"      => "manage_recipe",
			"read_private_posts" => "manage_recipe",
		]

	);

	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'recipe', $args );
}

add_action( 'init', 'add_cpt_recipe', 0 );

//add caps to admin / users and new role to publish recipe
add_action( "after_switch_theme", function () {
	$admin = get_role( "administrator" );
	$admin->add_cap( 'edit_recipe' );
	$admin->add_cap( 'manage_recipe' );

	$subscriber = get_role( "subscriber" );
	$admin->add_cap( 'edit_recipe' );

	add_role( 'recipe_moderator', 'Recipe moderator', [
		'read'              => true,
		'manage_recipe'     => true,
		'edit_recipe'       => true,
		'moderate_comments' => true,
		'edit_comment'      => true,
		'edit_posts'        => true
	] );
} );


//ajouter une nouvelle zone de menu à mon thème
function register_menus() {
	register_nav_menu( 'header-base-menu', __( 'Menu Header - Base' ) );
	register_nav_menu( 'header-connected-menu', __( 'Menu Header - Connecté' ) );
}

add_action( 'init', 'register_menus' );

/* Action pour ajouter une recette en bdd */
add_action( "admin_post_wik_add_recipe", function () {
	if ( ! wp_verify_nonce( $_POST["nonce_new_recipe"], "recipe" ) ) {
		die( "wrong nonce" );
	}
	if ( $_POST ) {
		$recipe   = wp_insert_post( [
			"post_content"  => $_POST["recipe_recipe"],
			"post_title"    => $_POST["recipe_name"],
			"post_type"     => "recipe",
			"post_status"   => "pending",
			"post_author"   => get_current_user_id(),
			"post_category" => [ $_POST["recipe_category"] ]
		] );
		$thumb_id = media_handle_upload( "recipe_thumb", 0, array() );


		if ( ! is_wp_error( $recipe ) && ! is_wp_error( $thumb_id ) ) {

			set_post_thumbnail( $recipe, $thumb_id );

			//addMessage(sprintf( "Nouvelle recette '%s' crée !", get_post( $recipe )->post_title ));
			wp_redirect( $_POST["_wp_http_referer"] );
		} else {
			wp_redirect( $_POST["_wp_http_referer"] );
		}
	}
} );

/* action pour éditer une recette */
add_action( "admin_post_wik_update_recipe", function () {
	if ( ! wp_verify_nonce( $_POST["nonce_update_recipe"], "recipe-update" ) ) {
		die( "wrong nonce" );
	}
	if ( $_POST ) {
		$recipe   = wp_update_post( [
			"ID"           => $_POST['id'],
			"post_content" => $_POST["recipe_update_recipe"],
			"post_title"   => $_POST["recipe_update_name"],
			'meta_input'   => [
				"wik_price"      => $_POST["price"],
				"wik_ingredient" => $_POST["ingredients"]
			]
		] );
		$thumb_id = media_handle_upload( "recipe_thumb", 0, array() );

		wp_set_post_terms( $recipe, $_POST["recipe_category"], "category" );
//		var_dump( get_post( $recipe ) );
		if ( ! is_wp_error( $recipe ) ) {

			if ( ! is_wp_error( $thumb_id ) ) {
				set_post_thumbnail( $recipe, $thumb_id );
			}

			//			addMessage(sprintf( "Nouvelle recette '%s' crée !", get_post( $recipe )->post_title ));
			wp_redirect( $_POST["_wp_http_referer"] );
		} else {
			wp_redirect( $_POST["_wp_http_referer"] . "?message=" . sprintf( "<p class='alert'>%s</p>", $recipe->get_error_message() ) );

		}
	}
} );

/* Action pour supprimer une recette */
add_action( "admin_post_wik_delete_recipe", function () {
	$result = "";
	if ( user_can( get_current_user_id(), "edit_recipe" ) ) {
		if ( isset( $_GET["recipe_id"] ) ) {
			$result = wp_delete_post( $_GET["recipe_id"] )->post_title . " a bien été supprimé";
		} else {
			$result = "Erreur : pas de 'recipe_id'";
		}
	} else {
		$result = "Erreur : vous n'êtes pas autorisé à supprimer cette recette";
	}

	if ( isset( $_GET["return_to"] ) ) {
		wp_redirect( $_GET["return_to"] );

	} else {
		wp_redirect( home_url() );
	}
} );


add_action( 'init', 'wik_register_style_taxonomy' );
function wik_register_style_taxonomy() {
	$labels = [
		'name'          => 'Styles',
		'singular_name' => 'Style',
		'search_items'  => 'Rechercher Style',
		'all_items'     => 'Tous les styles',
	];

	$args = [
		'labels'            => $labels,
		'public'            => true,
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'show_admin_column' => true
	];

	register_taxonomy( 'style', [ 'post' ], $args );
}

/* Ajout des métadatas */
$MetaData = new metaData( 'ingredient' );
$MetaData->wik();

/* Ajout de filtres à la recherce */
add_action( 'pre_get_posts', 'search_by_cat' );
function search_by_cat() {
	global $wp_query;
	if ( is_search() ) {

		if ( $_GET['minprice'] && ! empty( $_GET['minprice'] ) ) {
			$minprice = $_GET['minprice'];
		} else {
			$minprice = 0;
		}

		if ( $_GET['maxprice'] && ! empty( $_GET['maxprice'] ) ) {
			$maxprice = $_GET['maxprice'];
		} else {
			$maxprice = 999999;
		}

		$wp_query->set( 'post_type', 'recipe' );
		$wp_query->set( 'posts_per_page', - 1 );
		$wp_query->set( 'meta_query', array(
			array(
				'key'     => 'wik_price',
				'type'    => 'NUMERIC',
				'value'   => array( $minprice, $maxprice ),
				'compare' => 'BETWEEN'
			)
		) );

		$cat                         = intval( $_GET['cat'] );
		$cat                         = ( $cat > 0 ) ? $cat : '';
		$wp_query->query_vars['cat'] = $cat;
	}
}

