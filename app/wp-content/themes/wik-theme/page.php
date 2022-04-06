<?php get_header(); ?>
<div class="main page">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
            <h2 class="post-title"><?php the_title(); ?></h2>
            <div class="post-content">
				<?php the_content(); ?>
            </div>
		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
