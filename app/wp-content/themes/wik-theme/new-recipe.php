<?php
/*
 * Template Name: Page Nouvelle recette
 * Template Post Type : page
 *
 */
get_header();
the_post();

if ( ! is_user_logged_in() ) {
	wp_redirect( "/" );
}

//if ( $_POST ) {
//	$recipe = wp_insert_post( [
//		"post_content" => $_POST["recipe_recipe"],
//		"post_title"   => $_POST["recipe_name"],
//        "post_type" => "recipe",
//        "post_status" => "pending",
//        "post_author"=>get_current_user_id()
//	] );
//
//	if ( ! is_wp_error( $recipe ) ) {
//		echo sprintf( "<p class='alert'>Nouvelle recette '%s' crée !</p>", get_post($recipe)->post_title );
//	} else {
//		echo sprintf( "<p class='alert'>%s</p>", $recipe->get_error_message() );
//	}
//}

?>
    <h2><?= the_title() ?></h2>
    <div>
        <p>Créer une nouvelle recette : </p>
        <form name="recipe-form" id="recipe-form" action="<?= admin_url( 'admin-post.php' ) ?>" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="recipe_name">Nom</label>
                <input type="text" name="recipe_name" id="recipe_name" class="input" size="20" placeholder="Pot au feu">
            </div>
            <!--            <div class="input-group">-->
            <!--                <label for="recipe_ingredients">Ingrédients</label>-->
            <!--                <input type="text" name="username" id="recipe_ingredients" class="input" size="20" placeholder="cathydu69">-->
            <!--            </div>-->
            <div class="input-group">
                <label for="recipe_recipe">Recette</label>
                <textarea name="recipe_recipe" id="recipe_recipe" class="input" cols="400" rows="100"
                          placeholder="1 - Cuire le pot au feu"></textarea>
            </div>
            <input type="file" name="recipe_thumb" id="recipe-thumb" multiple="false"/>
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
