<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>
<body>
<header>
    <a href="<?= get_site_url() ?>">
        <img src="<?= get_template_directory_uri() ?>/src/img/logo.svg" class="logo"/>
		<?php get_site_icon_url() ?>
    </a>
    <div class="buttons">
		<?php if ( ! is_user_logged_in() && has_nav_menu( 'header-base-menu' ) ): ?>
			<?php wp_nav_menu( array(
				'theme_location' => 'header-base-menu',
				'menu_class'     => 'menu',

			) ) ?>
		<?php endif ?>
		<?php if ( is_user_logged_in() && has_nav_menu( 'header-connected-menu' ) ): ?>
			<?php wp_nav_menu( array(
				'theme_location' => 'header-connected-menu',
				'menu_class'     => 'menu',
			) ) ?>
		<?php endif ?>
    </div>
</header>
<?php
    echo do_shortcode ("[baniers-list]");
?>
<main class="<?= join( " ", get_post_class() ) ?>">
