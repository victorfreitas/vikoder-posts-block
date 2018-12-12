<?php
/**
 *
 * Model Blocks Post
 *
 * @package Vikoder\Model\Blocks\Post
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Model\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use WP_Query;

use Vikoder\Helper\Utils;
use Vikoder\Config\App;

class Post {

	protected $args;

	const BLOCK_NAME = App::SLUG . '/posts';

	const REST_BASE = '/posts';

	public function __construct( $args ) {
		$this->args = $args;
	}

	public function get_query() {
		return new WP_Query( $this->get_query_args() );
	}

	public function get_query_args() {
		return [
			'posts_per_page' => $this->args['limit'],
			'post_status'    => 'publish',
			'post_type'      => $this->args['type'],
			 // phpcs:ignore WordPress.VIP.SlowDBQuery.slow_db_query_meta_key
			'meta_key'       => '_thumbnail_id',
			'post__not_in'   => [ $this->args['exclude'] ],
		];
	}

	public function get_list() {
		$query = $this->get_query();

		if ( ! $query->have_posts() ) {
			return false;
		}

		return array_map( function( $post ) {
			return [
				'key'   => "{$post->post_type}{$post->post_name}",
				'link'  => get_permalink( $post->ID ),
				'title' => get_the_title( $post->ID ),
				'thumb' => Utils::get_image_url( $post->ID, [ 300, 300 ] ),
			];
		}, $query->posts );
	}
}
