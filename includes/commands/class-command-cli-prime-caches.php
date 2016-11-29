<?php
namespace TSPC\Commands;

use Sunra\PhpSimple\HtmlDomParser;
use WP_CLI;

/**
 * A WP-CLI command to manage cache operations. In it's most basic form, it will retrieve URLs on a given page an request them priming page or object caches that may exist.
 * @package TSPC\Commands
 */
class TS_Prime_Caches extends \WP_CLI_Command {

	/**
	 * Pre-prime caches by crawling links on a page
	 *
	 * ## OPTIONS
	 *
	 * [--blog_id=<blog_id>]
	 * : For Multisite, pass the ID of a subsite to prime
	 *
	 * [--url=<URL>]
	 * : By default, this is the homepage of the site
	 * ---
	 * default: home_url()
	 *
	 * ## EXAMPLES
	 *
	 *  wp tspc-cache prime --blog_id=2
	 *
	 *  wp tspc-cache prime --url=http://example.com/category/foobar
	 *
	 * @param $args
	 * @param $assoc_args
	 */
	public function prime( $args, $assoc_args ) {

		$blog_id = ( ! empty( $assoc_args['blog_id'] ) ) ? (int) $assoc_args['blog_id'] : 1;

		switch_to_blog( $blog_id );

		$url = '';

		if( empty( $assoc_args['url'] ) ) {
			$url = home_url();
		} else {
			$url = $assoc_args['url'];
		}

		if( ! filter_var( $url, FILTER_VALIDATE_URL ) ) {
			WP_CLI::error( __( 'Argument 1 should be a fully qualified URL', 'tspc' ) );
		}


		$html = HtmlDomParser::file_get_html( esc_url( $url ) );

		foreach( $html->find( 'a' ) as $anchor ) {
			$response = wp_remote_get( $anchor->href );
			$http_code = (int) wp_remote_retrieve_response_code( $response );
			if( 200 === $http_code ) {
				WP_CLI::success( esc_attr__( sprintf( '%s has been primed', esc_url( $anchor->href ) ), 'tspc' ) );
			}
		}

		restore_current_blog();

	}

}

WP_CLI::add_command( 'tspc-cache', __NAMESPACE__ . '\\TS_Prime_Caches' );