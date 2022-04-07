<?php
/**
 * Plugin Name: Frontend User
 * Description: Plugin qui permet aux utilisateurs de se connecter / gérer leur compte depuis le back-end
 * Version: 1.0.0
 * Author: Team WIK
 */

if ( ! defined( "ABSPATH" ) ) {
	die( "Accès interdit" );
}

require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'includes/actions.php';
