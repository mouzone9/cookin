<?php

/* ADD SUPPORTS */
function wik_theme_supports() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
}
add_action( 'after_setup_theme', "wik_theme_supports");
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

/* ADD STYLES */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'wik-css', get_template_directory_uri() . "/dist/main.css" );
	wp_enqueue_script( 'wik-js', get_template_directory_uri() . "/dist/main.js" );
} );


 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'baniers' ) );
    return $query;
}

