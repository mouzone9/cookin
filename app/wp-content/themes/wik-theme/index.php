<?php
$args      = array( 'post_type' => 'recipe', 'posts_per_page' => 10 );
$the_query = new WP_Query( $args );
global $wp_query;
?>


<?php get_header(); ?>

<h2><?= get_bloginfo( "name" ) ?></h2>

<?php
get_search_form();
?>
<?php if ( $the_query->have_posts() ) : ?>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="container">
            <div class="card">
                <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                <div class="bottom-card">
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                    <a class="button" href="<?php the_permalink(); ?>">Voir plus</a>
                </div>
            </div>
        </div>
	<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
