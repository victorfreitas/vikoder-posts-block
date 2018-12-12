<?php
/**
 *
 * Helpers
 *
 * @package Vikoder\Helper\Utils
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

namespace Vikoder\Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

use Vikoder\Config\App;

class Utils {

	public static function basename( $path ) {
		return plugin_basename( dirname( VKPB_PLUGIN_FILE ) ) . $path;
	}

	public static function plugins_url( $path ) {
		return plugins_url( $path, VKPB_PLUGIN_FILE );
	}

	public static function plugin_dir_path( $path ) {
		return plugin_dir_path( VKPB_PLUGIN_FILE ) . $path;
	}

	public static function filemtime( $path ) {
		if ( file_exists( self::plugin_dir_path( $path ) ) ) {
			return filemtime( self::plugin_dir_path( $path ) );
		}

		return App::VERSION;
	}

	public static function get_image_url( $post_id, $size = 'thumbnail' ) {
		$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

		return $src ? $src[0] : false;
	}

	public static function get_post_types() {
		$types = get_post_types( [ 'public' => true ], 'objects' );
		$list  = [];

		foreach ( $types as $key => $type ) :
			if ( 'attachment' !== $key ) {
				$list[] = [
					'label' => $type->label,
					'value' => $type->name,
				];
			}
		endforeach;

		return $list;
	}

	public static function get_locale_json_data() {
		$translations = get_translations_for_domain( App::SLUG );
		$locale       = [
			'' => [
				'domain' => App::SLUG,
				'lang'   => get_user_locale(),
			],
		];

		if ( ! empty( $translations->headers['Plural-Forms'] ) ) {
			$locale['']['plural_forms'] = $translations->headers['Plural-Forms'];
		}

		foreach ( $translations->entries as $msgid => $entry ) {
			$locale[ $msgid ] = $entry->translations;
		}

		return wp_json_encode( $locale );
	}
}
