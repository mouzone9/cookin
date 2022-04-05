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

/* ADD STYLES */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'wik-css', get_template_directory_uri() . "/dist/main.css" );
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

	wp_enqueue_script( 'wik-js', get_template_directory_uri() . "/dist/main.js", array( 'jquery' ), '1.0.0', true );
} );


 
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'baniers' ) );
    return $query;
}

  
function create_shortcode_baniers_post_type(){
  
    $args = array(
                    'post_type'      => 'baniers',
                    'posts_per_page' => '5',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
		$result = '<div class="slideshow"><ul>';

        while($query->have_posts()) :
  
            $query->the_post() ;
                      
			$result .= '<li class="baniers-item">';
			$result .= '<div class="baniers-background">' . get_the_post_thumbnail() . '</div>';
			$result .= '<div class="baniers-text">';
			$result .= '<b class="baniers-name">' . get_the_title() . '</b>';
			$result .= '<p class="baniers-desc">' . get_the_content() . '</p>'; 
			$result .= '</div>'; 
			$result .= '</li>';
  
        endwhile;
		$result .= '</ul>';
		$result .= '</div>';
        wp_reset_postdata();
  
    endif;    
  
    return $result;            
}
  
add_shortcode( 'baniers-list', 'create_shortcode_baniers_post_type' );

