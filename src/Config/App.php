<?php
/**
 *
 * General configurations of the application
 *
 * @package Vikoder\Config\App
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Config;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use Vikoder\Controller\Blocks\Posts;

class App extends Loader {

	private static $_instance = null;

	public $controllers = [
		'I18n',
		'Shortcodes',
	];

	const VERSION = '1.0.0';

	const SLUG = 'vikoder-posts-block';

	const REST_NAMESPACE = 'vkpb/v1';

	public function setup() {
		add_action( 'rest_api_init', [ $this, 'register_rest_routes' ] );
		Scripts::instance();
	}

	public function register_rest_routes() {
		new Posts();
	}

	public function activate() {

	}

	public function deactivate() {

	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
}
