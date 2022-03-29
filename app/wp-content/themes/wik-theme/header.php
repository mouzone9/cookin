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

    <?php 
        $args = array( 'post_type' => 'baniers', 'posts_per_page' => 10 );
        $the_query = new WP_Query( $args ); 
        ?>
        <?php if ( $the_query->have_posts() ) : ?>
        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <h2><?php the_title(); ?></h2>
        <div class="entry-content">
        <?php the_content();  
        if (has_post_thumbnail()) {
            the_post_thumbnail();
        } ?>
        </div>
        <?php endwhile;
        wp_reset_postdata(); ?>
        <?php else:  ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>
</header>
