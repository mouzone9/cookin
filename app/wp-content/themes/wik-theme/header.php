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
    <h1><?= get_bloginfo( "name" ) ?></h1>
    <div class="buttons">
        <a href="/sign-in/" class="button button__dark">Sign in</a>
        <a href="#" class="button">Register</a>
    </div>
</header>
