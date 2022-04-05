<?php
/**
 *
 * Template Name: Page d'inscription
 * Template Post Type : page
 *
 */
get_header();
the_post();
?>

    <h2><?= the_title() ?></h2>
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
    </form>
    </main>

<?php
get_footer();
