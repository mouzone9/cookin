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
<main class="<?= join( " ", get_post_class() ) ?>">
