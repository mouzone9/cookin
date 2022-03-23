<?php

/*
 * Add a new menu Banier to the Admin Control Panel
 */


// Add a new top level menu link to the ACP

function create_banier_posttype() {
 
    
    // CPT Options
    $labels = array(
        'name'                => _x( 'Baniers', 'Post Type General Name', 'wik-theme' ),
        'singular_name'       => _x( 'Banier', 'Post Type Singular Name', 'wik-theme' ),
        'menu_name'           => __( 'Baniers', 'wik-theme' ),
        'parent_item_colon'   => __( 'Parent Banier', 'wik-theme' ),
        'all_items'           => __( 'All Baniers', 'wik-theme' ),
        'view_item'           => __( 'View Banier', 'wik-theme' ),
        'add_new_item'        => __( 'Add New Banier', 'wik-theme' ),
        'add_new'             => __( 'Add New', 'wik-theme' ),
        'edit_item'           => __( 'Edit Banier', 'wik-theme' ),
        'update_item'         => __( 'Update Banier', 'wik-theme' ),
        'search_items'        => __( 'Search Banier', 'wik-theme' ),
        'not_found'           => __( 'Not Found', 'wik-theme' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'wik-theme' ),
    );

    $args = array(
        'label'               => __( 'baniers', 'wik-theme' ),
        'description'         => __( 'banier\'s description', 'wik-theme' ),
        'labels'              => $labels,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
 
    );

    register_post_type( 'baniers', $args );
}

