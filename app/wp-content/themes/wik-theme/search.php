<?php
/*
Template Name: Search Page
*/

get_header();
global $wp_query;

?>
	<div id="primary">
		<main id="main" class="site-main mt-5" role="main">
			<div class="container">
				<header class="mb-5">
                    <?php 
                        $wp_query->set('post_type', 'recipe');
                    ?>
					<h1 class="page-title"> <?php echo $wp_query->found_posts; ?>
						<?php _e( 'Search Results Found For', 'locale' ); ?>: "<?php the_search_query(); ?>"
					</h1>
				</header>

				<?php if ( have_posts() ) { ?>

					<div>

						<?php 
                        
                        while ( have_posts() ) {
							the_post(); ?>
							<div class="card mb-5 pb-3">
								<div class="card-body">
									<h3 class="card-title">
										<a href="<?php echo esc_url(get_the_permalink()); ?>">
											<?php the_title(); ?>
										</a>
										
									</h3>
									
								</div>
							</div>

						<?php } ?>

					</div>

					

				<?php } else {
					get_search_form();
				}?>

			</div>
		</main>
	</div>
<?php get_footer(); ?>