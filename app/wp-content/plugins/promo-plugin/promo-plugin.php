<?php 

/**
Plugin Name: Promo Plugin
Description: Plugin de bannière de promo au contenu et fond personnalisable
Version: 1.0.0
Author: Team WIK
 */
require_once plugin_dir_path(__FILE__) . 'includes/promo-functions.php';

if (!defined('ABSPATH')){
    wp_die( 'Accès interdit' );
}
register_activation_hook( __FILE__, function () {
    $admin = get_role('administrator');
    $admin->add_cap('manage_events');

    add_role( 'event_manager', 'Event Manager', [
        'read' => true,
        'manage_events' => true
    ]);
});
register_deactivation_hook( __FILE__, function () {
    $admin = get_role( 'administrator' );
    $admin->remove_cap('manage_events');
    remove_role( 'event_manager' );
});

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    if ($post_type === 'baniers') return false;
    return $current_status;
}

add_action( 'init', 'create_banier_posttype' );

function create_shortcode_baniers_post_type(){
  
    $args = array(
                    'post_type'      => 'baniers',
                    'posts_per_page' => '5',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
    $result = '';
  
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

?>