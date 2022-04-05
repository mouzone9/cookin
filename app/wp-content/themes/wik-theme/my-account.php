<?php
/*
 * Template Name: Page mon compte
 * Template Post Type : page
 *
 */
get_header();
the_post();

if ( ! is_user_logged_in() ) {
	wp_redirect( "/" );
}

$user = wp_get_current_user();

?>
    <h2><?= the_title() ?></h2>
    <div>
        <p>Mettre à jour ses informations :</p>
        <form name="register-form" id="registerform" action="<?= admin_url( 'admin-post.php' ) ?>" method="post">
            <div class="input-group">
                <label for="user_email">Email</label>
                <input type="email" name="email" id="user_email" class="input" value="<?= $user->data->user_email ?>"
                       size="20" placeholder="catherine.dupont@gmail.com">
            </div>
            <div class="input-group">
                <label for="user_username">Nom d'utilisateur</label>
                <input type="text" name="username" id="user_username" class="input"
                       value="<?= $user->data->user_login ?>" size="20" placeholder="cathydu69">
            </div>
            <div class="input-group">
                <label for="user_pass">Mot de passe</label>
                <input type="password" name="pwd" id="user_pass" class="input" value=""
                       size="20" placeholder="password">
            </div>
            <input type="hidden" name="action" value="wik_manage_account">
	        <?php wp_referer_field() ?>
	        <?php wp_nonce_field( "account", "nonce_wik_manage_account" ) ?>
            <div class="input-group">
                <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary">Submit</button>
            </div>
        </form>
    </div>

<?php
get_footer();
