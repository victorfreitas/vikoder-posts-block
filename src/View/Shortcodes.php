<?php
/**
 *
 * View Shortcodes
 *
 * @package Vikoder\View\Shortcodes
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\View;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use Vikoder\Helper\Utils;

class Shortcodes {

	public static function get_items_html( $list ) {
		return self::get_template( 'shortcode', $list );
	}

	// phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter.Found
	public static function get_template( $template, $list = [] ) {
		ob_start();

		include Utils::plugin_dir_path( "templates/{$template}.php" );

		return ob_get_clean();
	}
}
