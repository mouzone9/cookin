<?php
/*
 * Template Name: Liste des recettes personnelles
 * Template Post Type : page
 *
 */
get_header();
the_post();

if (!is_user_logged_in()) {
    wp_redirect("/");
}

$args      = array('post_type' => 'recipe', 'posts_per_page' => 10, 'author' => get_current_user_id(), 'post_status' => 'any');
$the_query = new WP_Query($args);

?>
<h2><?= the_title() ?></h2>
<div class="recipes-grid">
    <div class="recipe-row">
        <p><strong>Titre</strong></p>
        <p><strong>Publication</strong></p>
        <p><strong>Catégorie</strong></p>
        <p><strong>Statut</strong></p>
        <p><strong>Action</strong></p>
    </div>
    <?php if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>

                <div class="recipe-row">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    <p><?php the_date( 'd/m/Y G:i' ) ?></p>
                    <p><?php  the_terms(get_the_ID(), "category")  ?></p>
                    <p><?= get_post( get_the_ID() )->post_status ?></p>
                    <div class="is-flex-container recipes-buttons">
                        <a href="<?= get_site_url() ?>/modifier-recette?id=<?php the_ID() ?>" class="icon-link button">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 700 700">
                                <path d="m482.38 206.3c10.922-12.098 6.7773-20.273-3.5273-29.566l-41.609-37.52c-14.727-13.273-24.641-6.1055-31.641 1.625l-15.008 16.633c-2.0703 2.2969-1.9023 5.8242 0.39062 7.8945l66.527 59.977c1.1211 1.0078 2.5742 1.5117 4.0312 1.457 1.457-0.054688 2.8555-0.72656 3.8633-1.8477z"/>
                                <path d="m213.02 426.72c1.5117 1.3438 3.6406 1.793 5.543 1.1211l44.07-15.008-38.922-35.055-12.32 43.289c-0.55859 2.0156 0 4.1445 1.5117 5.6016 0.0625-0.003907 0.0625 0.050781 0.11719 0.050781z"/>
                                <path d="m311.25 396.26c0.89453-0.28125 1.7344-0.83984 2.3516-1.5664l136.92-153.11c2.0703-2.2969 1.9023-5.8242-0.39062-7.8945l-66.586-59.98c-1.1211-1.0078-2.5742-1.5117-4.0312-1.457-1.457 0.054688-2.8555 0.72656-3.8633 1.8477l-136.92 153.11c-0.55859 0.61719-1.0078 1.3984-1.2305 2.2383l-10.359 36.344 47.602 42.953z"/>
                            </svg>
                        </a>
                        <a href="<?= admin_url( 'admin-post.php' ) ?>?action=wik_delete_recipe&recipe_id=<?= the_ID() ?>&return_to=<?= home_url( $wp->request ) ?>"
                           class="icon-link button">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 700 700">
                                <path d="m595.33 154.55c0-35.875-29.203-65.078-65.078-65.078h-115.17v-24.391c0-35.875-29.203-65.078-65.078-65.078s-65.078 29.203-65.078 65.078v24.281h-115.17c-35.875 0-65.078 29.203-65.078 65.078 0 34.344 26.797 62.562 60.594 64.969v323.09c0 9.625 7.875 17.5 17.5 17.5h334.58c9.625 0 17.5-7.875 17.5-17.5v-323.09c33.797-2.2969 60.484-30.516 60.484-64.859zm-275.41-89.469c0-16.625 13.453-30.078 30.078-30.078s30.078 13.453 30.078 30.078v24.281h-60.156zm-119.77 459.92v-305.38h299.69v305.38zm330.09-340.38h-360.5c-16.625 0-30.078-13.453-30.078-30.078s13.453-30.078 30.078-30.078h360.5c16.625 0 30.078 13.453 30.078 30.078s-13.453 30.078-30.078 30.078zm-243.14 96.688v182c0 9.625-7.875 17.5-17.5 17.5s-17.5-7.875-17.5-17.5v-182c0-9.625 7.875-17.5 17.5-17.5s17.5 7.7656 17.5 17.5zm80.391 0v182c0 9.625-7.875 17.5-17.5 17.5s-17.5-7.875-17.5-17.5v-182c0-9.625 7.875-17.5 17.5-17.5s17.5 7.7656 17.5 17.5zm80.281 0v182c0 9.625-7.875 17.5-17.5 17.5s-17.5-7.875-17.5-17.5v-182c0-9.625 7.875-17.5 17.5-17.5s17.5 7.7656 17.5 17.5z"/>
                            </svg>
                        </a>
                    </div>
                <p><?= get_post(get_the_ID())->post_status ?></p>
                </div>
          
        <?php endwhile; ?>
    <?php endif; ?>
    </div>
</div>

<?php
get_footer();
