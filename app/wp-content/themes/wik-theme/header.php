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
		<?php if ( !is_user_logged_in() ): ?>
            <a href="/sign-in/" class="button button__dark">Sign in</a>
            <a href="/register" class="button">Register</a>
		<?php endif ?>
	    <?php if ( is_user_logged_in() ): ?>
            <a href="/my-account/" class="button button__dark">My account</a>
            <a href="<?= wp_logout_url("/")?>" class="button">Log out</a>
	    <?php endif ?>
    </div>
</header>
<main class="<?= join(" ", get_post_class()) ?>">
