<?php
/**
 *
 * Controller Shortcodes
 *
 * @package Vikoder\Controller\Shortcodes
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Controller;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use Vikoder\Helper\Utils;
use Vikoder\Config\App;
use Vikoder\View\Shortcodes as View;
use Vikoder\Model\Blocks\Post;

class Shortcodes {

	public function __construct() {
		add_shortcode( 'vkpb', [ $this, 'render' ] );
	}

	public function render( $atts ) {
		$atts = shortcode_atts( [
			'type'    => 'post',
			'limit'   => 3,
			'exclude' => 0,
		], $atts );

		$post = new Post( $atts );
		$list = $post->get_list();

		unset( $post );

		return $list ? View::get_items_html( $list ) : '';
	}
}
