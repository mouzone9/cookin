<?php get_header() ?>

<?php if (have_posts()); ?>
<?php while (have_posts()) : the_post(); ?>
    <img src="<?php the_post_thumbnail_url(); ?>" alt="Image">
    <h5><?php the_title(); ?></h5>
    <p><?php the_content(); ?></p>
    <p><?php the_date(); ?></p>
<?php endwhile; ?>

<?php get_footer(); ?>