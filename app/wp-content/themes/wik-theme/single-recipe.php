<?php get_header() ?>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="Image">
        <h5><?php the_title(); ?></h5>
        <p><strong>Ingrédients :</strong></p>
        <p><?= get_post_meta( get_the_ID(), 'wik_ingredient' ) ? get_post_meta( get_the_ID(), 'wik_ingredient' )[0] : "" ?></p>
        <p><strong>Prix :</strong>
			<?= get_post_meta( get_the_ID(), 'wik_price' ) ? get_post_meta( get_the_ID(), 'wik_price' )[0] . "€" : "Non indiqué" ?>
        </p>
        <p><strong>Note :</strong>
			<?= get_post_meta( get_the_ID(), 'wik_note' ) ? get_post_meta( get_the_ID(), 'wik_note' )[0] : "Aucune note" ?>
        </p>
        <p><?php the_content(); ?></p>
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>