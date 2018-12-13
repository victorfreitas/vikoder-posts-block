<?php
/**
 *
 * WP Scripts
 *
 * @package Vikoder\Config\Scripts
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Config;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use Vikoder\Helper\Utils;
use Vikoder\Model\Blocks\Post;
use Vikoder\Config\App;

class Scripts {

	const CDN = 'https://assets.vikoder.com';

	const VERSION = '1.0.0';

	private static $_instance = null;

	private function __construct() {
		add_action( 'enqueue_block_editor_assets', [ $this, 'block_assets' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'front_scripts' ] );
	}

	public function get_handle() {
		return App::SLUG . '-build';
	}

	public function block_assets() {
		$this->make_scripts( 'admin', [
			'wp-blocks',
			'wp-i18n',
			'wp-element',
			'wp-components',
			'wp-editor',
			'wp-url',
			'wp-api-fetch',
		] );
		$this->admin_localize_script();
		$this->admin_script_translations();
	}

	public function front_scripts() {
		$this->make_scripts( 'front' );
	}

	public function make_scripts( $type, $deps = [ 'jquery' ] ) {
		wp_enqueue_script(
			$this->get_handle(),
			$this->get_assets( $type, 'js' ),
			$deps,
			$this->get_ver( $type ),
			true
		);

		wp_enqueue_style(
			$this->get_handle(),
			$this->get_assets( $type, 'css' ),
			[],
			$this->get_ver( $type )
		);
	}

	public function admin_localize_script() {
		wp_localize_script(
			$this->get_handle(),
			'vkpbGlobalVars',
			[
				'blockName' => Post::BLOCK_NAME,
				'restPath'  => App::REST_NAMESPACE . Post::REST_BASE,
				'postTypes' => Utils::get_post_types(),
				'postId'    => filter_input( INPUT_GET, 'post', FILTER_SANITIZE_NUMBER_INT ),
			]
		);
	}

	public function admin_script_translations() {
		// ... Provisory method for the translations
		wp_add_inline_script(
			$this->get_handle(),
			sprintf(
				'wp.i18n.setLocaleData(%s, "%s" );',
				Utils::get_locale_json_data(),
				App::SLUG
			),
			'before'
		);

		/**
		 *  Not Working, under analysis
		 *  wp_set_script_translations( $this->get_handle(), App::SLUG );
		*/
	}

	public function get_assets( $type, $ext ) {
		if ( $type === 'front' ) {
			return Utils::plugins_url( "build/{$type}.bundle.{$ext}" );
		}

		return sprintf( '%s/widget.%s?key=%s', self::CDN, $ext, md5( site_url() ) );
	}

	public function get_ver( $type ) {
		return $type === 'front' ? self::VERSION : false;
	}

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
}
