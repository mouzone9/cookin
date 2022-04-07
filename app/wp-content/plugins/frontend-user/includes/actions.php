<?php

add_action( "admin_post_wik_manage_account", function () {
	if ( ! wp_verify_nonce( $_POST["nonce_wik_manage_account"], "account" ) ) {
		die( "wrong nonce" );
	}
	if ( $_POST ) {
		$user = wp_update_user( [
			"ID"         => get_current_user_id(),
			"user_pass"  => $_POST["pwd"],
			"user_email" => $_POST["email"],
			"user_login" => $_POST["username"]
		] );

		if ( ! is_wp_error( $user ) ) {
			//echo sprintf( "<p class='alert'>Mise à jour réussie</p>" );
			wp_redirect( $_POST["_wp_http_referer"] );
		} else {
			//echo sprintf( "<p class='alert'>%s</p>", $user->get_error_message() );
			wp_redirect( $_POST["_wp_http_referer"] );
		}
	}
} );

add_action( "admin_post_nopriv_wik_register", function () {
	if ( ! wp_verify_nonce( $_POST["nonce_wik_register"], "register" ) ) {
		die( "wrong nonce" );
	}
	if ( $_POST ) {
		$user = wp_insert_user( [
			"user_pass"  => $_POST["pwd"],
			"user_email" => $_POST["email"],
			"user_login" => $_POST["username"]
		] );

//		if ( ! is_wp_error( $user ) ) {
			//echo sprintf( "<p class='alert'>The user %s is created ! To sign in go to the <a href='/inscription'>sign in</a> page !</p>", get_user_meta( $user )["nickname"][0] );
			wp_redirect( "/" );
//		} else {
//			//	echo sprintf( "<p class='alert'>%s</p>", $user->get_error_message() );
//			wp_redirect( $_POST["_wp_http_referer"] );
//		}
	}
} );
