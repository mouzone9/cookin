<?php
$args      = array('post_type' => 'recipe', 'posts_per_page' => 10);
$the_query = new WP_Query($args);
global $wp_query;
?>


<?php get_header(); ?>

<h2>Bienvenue sur Cook-Inn</h2>

<?php
get_search_form();
?>

<?php if ($the_query->have_posts()) : ?>
    <div class="card-container">
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

            <div class="card">
                <img class="img-responsive" src="<?php the_post_thumbnail_url(); ?>" alt="">
                <div class="overlay">
                    <h2><?php the_title(); ?></h2>
                    
                    <a class="info" href="<?php the_permalink(); ?>">Voir plus</a>
                </div>
            </div>

    <?php endwhile; ?>
    </div>
<?php endif; ?>
<?php get_footer(); ?>
