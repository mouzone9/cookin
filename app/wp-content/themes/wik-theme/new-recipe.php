<?php
/*
 * Template Name: Page Nouvelle recette
 * Template Post Type : page
 *
 */
get_header();
the_post();

$categories = get_terms( [
	'taxonomy'   => 'category',
	'hide_empty' => false
] );

if ( ! is_user_logged_in() ) {
	wp_redirect( "/" );
}
?>
    <h2><?= the_title() ?></h2>
    <div>
        <form name="recipe-form" id="recipe-form" action="<?= admin_url( 'admin-post.php' ) ?>" method="post"
              enctype="multipart/form-data">
            <div class="input-group">
                <label for="recipe_name">Nom</label>
                <input type="text" name="recipe_name" id="recipe_name" class="input" size="20" placeholder="Pot au feu">
            </div>
            <div class="input-group">
                <label for="recipe_category">Catégorie</label>
                <select name="recipe_category" id="recipe_category" class="input" required>
					<?php foreach ( $categories as $category ): ?>
                        <option value="<?= $category->term_id?>"><?=$category->name?></option>
					<?php endforeach; ?>
                </select>
            </div>
            <div class="input-group">
                <label for="ingredients">Ingrédients</label>
                <textarea name="ingredients" id="ingredients" class="input" cols="400" rows="10"
                          placeholder="Coucou"></textarea>
            </div>
            <div class="input-group">
                <label for="price">Prix</label>
                <input name="price" id="price" class="input" placeholder="2" type="number"/>
            </div>
            <div class="input-group">
                <label for="recipe_recipe">Recette</label>
                <textarea name="recipe_recipe" id="recipe_recipe" class="input" cols="400" rows="10"
                          placeholder="1 - Cuire le pot au feu"></textarea>
            </div>
            <div class="input-group">
                <label for="recipe_thumb">Image : </label>
                <input type="file" name="recipe_thumb" id="recipe_thumb" multiple accept="image/*" required/>
            </div>
            <input type="hidden" name="action" value="wik_add_recipe">
			<?php wp_referer_field() ?>
			<?php wp_nonce_field( "recipe", "nonce_new_recipe" ) ?>
            <div class="input-group">
                <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary">Créer</button>
            </div>
        </form>
    </div>

<?php
get_footer();
