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

if ( $_POST ) {

	$user = wp_update_user( [
		"ID"         => get_current_user_id(),
		"user_pass"  => $_POST["pwd"] ,
		"user_email" => $_POST["email"],
		"user_login" => $_POST["username"]
	] );

	if ( ! is_wp_error( $user ) ) {
		echo sprintf( "<p class='alert'>Mise à jour réussie</p>" );
	} else {
		echo sprintf( "<p class='alert'>%s</p>", $user->get_error_message() );
	}
}

$user = wp_get_current_user();

?>
    <h2><?= the_title() ?></h2>
    <div>
        <p>Mettre à jour ses informations :</p>
        <form name="register-form" id="registerform" action="" method="post">
            <div class="input-group">
                <label for="user_email">Email address</label>
                <input type="email" name="email" id="user_email" class="input" value="<?= $user->data->user_email ?>"
                       size="20" placeholder="catherine.dupont@gmail.com">
            </div>
            <div class="input-group">
                <label for="user_username">Username</label>
                <input type="text" name="username" id="user_username" class="input"
                       value="<?= $user->data->user_login ?>" size="20" placeholder="cathydu69">
            </div>
            <div class="input-group">
                <label for="user_pass">Password</label>
                <input type="password" name="pwd" id="user_pass" class="input" value=""
                       size="20" placeholder="password">
            </div>
            <div class="input-group">
                <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary">Submit</button>
            </div>
        </form>
    </div>

<?php
get_footer();
