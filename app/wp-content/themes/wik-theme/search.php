<?php
/*
Template Name: Search Page
*/
global $wp_query;

?>
		
			
		<?php get_header(); ?>


<div class="container">
        <h2>Recherche :</h2>

</div>
<?php
    get_search_form();
?>

<?php if ($wp_query->have_posts()) : ?>
    <div class="card-container">
    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
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