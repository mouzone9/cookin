<?php
$args      = array('post_type' => 'recipe', 'posts_per_page' => 10);
$the_query = new WP_Query($args);
global $wp_query;
?>


<?php get_header(); ?>
<h2>Femme, tu es au bon endroit pour apprendre.</h2>

<div class="container">
    <h2>
        <h2><?php the_title(); ?>
    </h2>
    </h2>
</div>
<?php
get_search_form();
?>
<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>
        <p><?php the_content(); ?></p>
	<?php endwhile; ?>
<?php endif; ?>
<?php if ($the_query->have_posts()) : ?>
    <div class="card-container">
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
        
            <div class="card">
                <img class="img-responsive" src="<?php the_post_thumbnail_url(); ?>" alt="">
                <div class="overlay">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_excerpt(); ?></p>
                    <a class="info" href="<?php the_permalink(); ?>">Voir plus</a>
                </div>
            </div>
        
    <?php endwhile; ?>
    </div>
<?php endif; ?>
<?php get_footer(); ?>
