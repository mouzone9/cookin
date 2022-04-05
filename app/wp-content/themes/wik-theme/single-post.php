<?php get_header() ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <img src="<?php the_post_thumbnail_url(); ?>" alt="...">
        <h5><?php the_title(); ?></h5>
        <p><?php the_content(); ?></p>
        <p><?php the_date(); ?></p>
        <?php if (get_post_meta(get_the_ID(), 'wik_ingredient')) : ?>
            <div>
                <ul>
                    <li>Ingrédient : <?= get_post_meta(get_the_ID(), 'wik_ingredient')[0] ?></li>
                    <li>Notes : <?= get_post_meta(get_the_ID(), 'wik_notes')[0] ?></li>
                </ul>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>