<?php
/**
 * Plugin Name: Prime Caches WP-CLI
 * Plugin URI: https://github.com/technosailor/prime-caches-wpcli
 * Description: WP CLI package to prime caches by crawling all links on the WordPress site's homepage. Useful for preventing cache thrashing when doing a migration
 * Author: Aaron Brazell
 * Version: 0.1
 * Author URI: http://technosailor.com
 * Text Domain: tspc
 * Domain Path: /languages
 */

if( defined( 'PRIME_CACHES_WP_CLI_VERSION' ) || ! defined( 'WP_CLI' ) ) {
	return;
}

define( 'PRIME_CACHES_WP_CLI_VERSION', '0.1' );
define( 'PRIME_CACHES_WP_CLI_COMMANDS_PATH', 'includes/commands/' );

if ( defined( 'ABSPATH' ) ) {
	if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
		require_once( 'vendor/autoload.php' );
	} else {
		die( "Please, run composer install first" );
	}
}

require_once PRIME_CACHES_WP_CLI_COMMANDS_PATH . 'class-command-cli-prime-caches.php';
