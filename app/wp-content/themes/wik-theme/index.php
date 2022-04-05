<?php get_header(); ?>
<div class="container">
    <h2>Femme, tu es au bon endroit pour apprendre.</h2>

    <?php if (have_posts()) ?>
    <?php while (have_posts()) : the_post(); ?>
        <div class="card">
            <img src="<?php the_post_thumbnail_url(); ?>" alt="">
            <div class="bottom-card">
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
                <button class="button">Voir plus </button>
            </div>
        </div>
</div>
<?php get_footer(); ?>
<?php endwhile; ?>