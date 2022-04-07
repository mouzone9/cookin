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
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
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
