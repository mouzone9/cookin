<?php get_header() ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="Image" class="thumbnail">
        <h2><?php the_title(); ?></h2>
        <div class="content">
            <div class="meta">
                <p><strong>Ingrédients :</strong></p>
                <p><?= get_post_meta( get_the_ID(), 'wik_ingredient' ) ? get_post_meta( get_the_ID(), 'wik_ingredient' )[0] : "" ?></p>
                <p><strong>Prix :</strong>
					<?= get_post_meta( get_the_ID(), 'wik_price' ) ? get_post_meta( get_the_ID(), 'wik_price' )[0] . "€" : "Non indiqué" ?>
                </p>
            </div>
            <div class="recipe-recipe">

                <p><?php the_content(); ?></p>
            </div>
        </div>
        <div class="comments">
	        <?php comments_open() || get_comments_number() ? comments_template() : "" ?>
        </div>

	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
