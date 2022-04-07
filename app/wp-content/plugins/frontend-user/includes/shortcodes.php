<?php
function frusr_create_login_form( $args ) {
	$redirect_page = get_site_url();
	if ( $args && isset( $args["redirect_page"] ) ) {
		$redirect_page = $args["redirect_page"];
	}
	ob_start();
	?>
<form name="loginform" id="loginform" action="<?= home_url( 'wp-login.php' ) ?>" method="post">
    <div class="input-group">
        <label for="user_login">Username or Email Address</label>
        <input type="text" name="log" id="user_login" class="input" value="" size="20" placeholder="catherine">
    </div>
    <div class="input-group">
        <label for="user_pass">Password</label>
        <input type="password" name="pwd" id="user_pass" class="input" value="" size="20"
               placeholder="password">
    </div>
    <div class="input-group input-group__checkbox">
        <input name="rememberme" type="checkbox" id="rememberme" value="forever">
        <label for="rememberme">Remember Me</label>
    </div>
    <div class="input-group">
        <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary">Log in</button>
        <input type="hidden" name="redirect_to" value="<?= $redirect_page ?>">
    </div>
    </form><?php
	return ob_get_clean();
}

add_shortcode( 'login_form', 'frusr_create_login_form' );


function frusr_create_update_account_form() {
	ob_start();
	$user = wp_get_current_user();
	?>
<form name="account-form" id="accountform" action="<?= admin_url( 'admin-post.php' ) ?>" method="post">
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
    </form><?php
	return ob_get_clean();
}

add_shortcode( 'account_form', 'frusr_create_update_account_form' );


function frusr_create_register_form() {
	ob_start();
	?>
<form name="register-form" id="registerform" action="<?= admin_url( 'admin-post.php' ) ?>" method="post">
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
    <input type="hidden" name="action" value="wik_register">
	<?php wp_referer_field() ?>
	<?php wp_nonce_field( "register", "nonce_wik_register" ) ?>
    <div class="input-group">
        <button type="submit" name="wp-submit" id="wp-submit" class="button button-primary">Submit</button>
    </div>
    </form><?php
	return ob_get_clean();
}

add_shortcode( 'register_form', 'frusr_create_register_form' );
