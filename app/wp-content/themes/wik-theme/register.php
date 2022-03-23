<?php
/**
 *
 * Template Name: Page d'inscription
 * Template Post Type : page
 *
 */
get_header();

if ( $_POST ) {
	$user = wp_insert_user( [
		"user_pass"  => $_POST["pwd"],
		"user_email" => $_POST["email"],
		"user_login" => $_POST["username"]
	] );

	if ( ! is_wp_error( $user ) ) {
		echo sprintf( "<p class='alert'>The user %s is created ! To sign in go to the <a href='/inscription'>sign in</a> page !</p>", get_user_meta( $user )["nickname"][0] );

		exit;
	} else {
		echo sprintf( "<p class='alert'>%s</p>", $user->get_error_message() );
	}
}


the_post();
?>

    <h2><?= the_title() ?></h2>
    <form name="register-form" id="registerform" action="" method="post">
        <div class="input-group">
            <label for="user_email">Email address</label>
            <input type="email" name="email" id="user_email" class="input" value="" size="20" required
                   placeholder="catherine.dupont@gmail.com">
        </div>
        <div class="input-group">
            <label for="user_username">Username</label>
            <input type="text" name="username" id="user_username" class="input" value="" size="20" required
                   placeholder="cathydu69">
        </div>
        <div class="input-group">
            <label for="user_pass">Password</label>
            <input type="password" name="pwd" id="user_pass" class="input" value="" size="20" required
                   placeholder="password">
        </div>
        <div class="input-group">
            <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary">Submit</button>
            <input type="hidden" name="redirect_to" value="<?= get_site_url() ?>/my-account/">
        </div>
    </form>
    </main>

<?php
get_footer();
