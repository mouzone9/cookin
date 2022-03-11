<?php
/**
 *
 * Template Name: Page d'inscription
 * Template Post Type : page
 *
 */
get_header();
the_post()
?>

<h2><?= the_title()?></h2>

<?php
wp_login_form();
get_footer();
