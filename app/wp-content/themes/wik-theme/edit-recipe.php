<?php
/*
 * Template Name: édition de recette
 * Template Post Type : page
 *
 */
get_header();
the_post();
$post = get_post($_GET['id']);
$ingredient = get_post_meta($_GET['id'], "wik_ingredient", true);
$price = get_post_meta($_GET['id'], "wik_price", true);
if (!is_user_logged_in()) {
    wp_redirect("/");
}
?>
<h2><?= the_title() ?></h2>
<div>
    <form name="recipe-form" id="recipe-form" action="<?= admin_url('admin-post.php') ?>" method="post" enctype="multipart/form-data">
        <div class="input-group">
            <label for="recipe_update_name">Nom</label>
            <input type="text" name="recipe_update_name" id="recipe_name" class="input" size="20" value='<?= $post->post_title ?>'>
        </div>
        <div class="input-group">
            <label for="ingredients">Ingrédients</label>
            <textarea name="ingredients" id="ingredients" class="input" cols="400" rows="10"><?= $ingredient ?></textarea>
        </div>
        <div class="input-group">
            <label for="price">Prix</label>
            <input name="price" id="price" class="input" placeholder="2" type="number" value='<?= $price ?>' />
        </div>
        <div class="input-group">
            <label for="recipe_update_recipe">Recette</label>
            <textarea name="recipe_update_recipe" id="recipe_recipe" class="input" cols="400" rows="10" value="<?= the_content() ?>"></textarea>
        </div>
        <div class="input-group">
            <label for="recipe_thumb">Image : </label>
            <input type="file" name="recipe_thumb" id="recipe_thumb" multiple accept="image/*" required />
        </div>
        <input type="hidden" name="action" value="wik_update_recipe">
        <input type="hidden" name="id" value="<?php $_GET['id'] ?>">
        <?php wp_referer_field() ?>
        <?php wp_nonce_field("recipe-update", "nonce_update_recipe") ?>
        <div class="input-group">
            <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary">Créer</button>
        </div>
    </form>
</div>

<?php
get_footer();
