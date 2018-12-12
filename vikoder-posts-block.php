<?php
/**
 *
 * Vikoder: Posts Block
 *
 * @package vikoder-posts-block
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 * @license GPL-3.0+
 *
 * @wordpress-plugin
 * Plugin Name: Vikoder: Posts Block
 * Description: Posts block for the new editor
 * Version:     1.0.0
 * Author:      Viktor Freitas
 * Author URI:  https://github.com/victorfreitas
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: vikoder-posts-block
 * Domain Path: /i18n/languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

global $wp_version;

require_once dirname( __FILE__ ) . '/includes/functions.php';

if ( version_compare( $wp_version, '5.0', '<' ) ) {
	vkpb_add_notice( 'vkpb_wp_version_notice' );
	return;
}

if ( version_compare( phpversion(), '5.4', '<' ) ) {
	vkpb_add_notice( 'vkpb_php_version_notice' );
	return;
}

if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	vkpb_add_notice( 'vkpb_vendor_notice' );
	return;
}

require_once __DIR__ . '/vendor/autoload.php';

if ( ! defined( 'VKPB_PLUGIN_FILE' ) ) {
	define( 'VKPB_PLUGIN_FILE', __FILE__ );
}

$app = Vikoder\Config\App::instance();

do_action( 'vkpb_plugin_init', $app );

register_activation_hook( __FILE__, [ $app, 'activate' ] );
register_deactivation_hook( __FILE__, [ $app, 'deactivate' ] );
