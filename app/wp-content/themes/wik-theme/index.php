<?php get_header(); ?>
<h2>Femme, tu es au bon endroit pour apprendre.</h2>
<p>Voici quelques recettes qui te permettront de régaler ton mari et tes enfants :</p>

<div>
    <p>METTRE LISTE DE RECETTE</p>
    <div class="container">

        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="card">
                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                    <div class="bottom-card">
                        <h3><?php the_title(); ?></h3>
                        <p><?php the_excerpt(); ?></p>
                        <a href="<?php the_permalink(); ?>" class="button">Voir plus </a>
                    </div>
                </div>
    </div>
<?php endwhile; ?>
<?php endif ?>
<?php get_footer(); ?>