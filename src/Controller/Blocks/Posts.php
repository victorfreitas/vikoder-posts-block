<?php
/**
 *
 * Controller Blocks Posts
 *
 * @package Vikoder\Controller\Blocks\Posts
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Controller\Blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use WP_REST_Controller;
use WP_REST_Server;
use WP_Error;

use Vikoder\Model\Blocks\Post;
use Vikoder\Config\App;

class Posts extends WP_REST_Controller {

	protected $namespace = App::REST_NAMESPACE;

	protected $rest_base = Post::REST_BASE;

	public function __construct() {
		$this->register_routes();
	}

	public function register_routes() {
		register_rest_route(
			$this->namespace,
			$this->rest_base,
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [ $this, 'get_items' ],
					'permission_callback' => [ $this, 'permissions_check' ],
					'args'                => $this->get_columns(),
				],
			]
		);
	}

	public function get_columns() {
		return [
			'context' => $this->get_context_param(),
			'type'    => [
				'type'              => 'string',
				'default'           => 'post',
				'validate_callback' => 'post_type_exists',
			],
			'limit'   => [
				'type'              => 'integer',
				'default'           => 3,
				'sanitize_callback' => 'absint',
				'minimum'           => 1,
			],
			'exclude' => [
				'type'              => 'integer',
				'sanitize_callback' => 'absint',
			],
		];
	}

	public function get_items( $request ) {
		$post = new Post( [
			'limit'   => $request->get_param( 'limit' ),
			'type'    => $request->get_param( 'type' ),
			'exclude' => $request->get_param( 'exclude' ),
		] );
		$list = $post->get_list();

		unset( $post );

		if ( $list ) {
			return $list;
		}

		return new WP_Error(
			'vkpb_rest_post_not_found',
			__( 'No posts found!', 'vikoder-posts-block' ),
			[ 'status' => 404 ]
		);
	}

	public function permissions_check() {
		if ( current_user_can( 'edit_posts' ) ) {
			return true;
		}

		return new WP_Error(
			'vkpb_rest_cannot_read',
			__( 'Sorry, you are not allowed to read block as this user.', 'vikoder-posts-block' ),
			[ 'status' => rest_authorization_required_code() ]
		);
	}
}
