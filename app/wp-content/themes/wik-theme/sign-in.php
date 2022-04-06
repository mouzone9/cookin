<?php
/**
 *
 * Template Name: Page de connexion
 * Template Post Type : page
 *
 */
get_header();
the_post()
?>
    <h2><?= the_title() ?></h2>
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
            <input type="hidden" name="redirect_to" value="<?= get_site_url() ?>/mes-recettes/">
        </div>
    </form>
<?php
get_footer();
