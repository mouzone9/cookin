<?php

require_once('meta-data.php');

/* ADD SUPPORTS */
function wik_theme_supports()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
}

add_action('after_setup_theme', "wik_theme_supports");

/* ADD STYLES */
add_action('wp_enqueue_scripts', function () {
	wp_enqueue_style('wik-css', get_template_directory_uri() . "/dist/main.css");
	wp_enqueue_script('wik-js', get_template_directory_uri() . "/dist/main.js");
});

/* ADD SVG SUPPORT */
function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);


/* Remove admin bar */
if (!is_admin() && !current_user_can("manage_options")) {
	add_filter("show_admin_bar", "__return_false");
}

add_action('init', 'wik_register_style_taxonomy');
function wik_register_style_taxonomy()
{
	$labels = [
		'name' => 'Styles',
		'singular_name' => 'Style',
		'search_items' => 'Rechercher Style',
		'all_items' => 'Tous les styles',
	];

	$args = [
		'labels' => $labels,
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'show_admin_column' => true
	];

	//register_taxonomy(taxonomy: 'style', ['post'], $args);
}

$MetaData = new metaData('ingredient');
$MetaData->wik();
