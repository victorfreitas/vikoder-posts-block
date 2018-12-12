<?php
/**
 *
 * Global functions
 *
 * @package includes\functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

if ( ! function_exists( 'vkpb_add_notice' ) ) {
	function vkpb_add_notice( $notice ) {
		add_action( 'admin_notices', $notice );
	}
}

if ( ! function_exists( 'vkpb_admin_notice' ) ) {
	function vkpb_admin_notice( $message, $type = 'error' ) {
	?>
		<div class="<?php echo esc_attr( $type ); ?> notice is-dismissible">
			<p>
				<strong>
					<?php esc_html_e( 'Vikoder: Posts Block: ', 'vikoder-posts-block' ); ?>
				</strong>
				<?php echo wp_kses( $message, [ 'code' => true ] ); ?>
			</p>
		</div>
	<?php
	}
}

if ( ! function_exists( 'vkpb_wp_version_notice' ) ) {
	function vkpb_wp_version_notice() {
		global $wp_version;

		/* translators: %s: global $wp_version */
		vkpb_admin_notice( sprintf( esc_html__( 'Your WordPress version (%s) is not supported. Required >=5.0', 'vikoder-posts-block' ), $wp_version ) );
	}
}

if ( ! function_exists( 'vkpb_php_version_notice' ) ) {
	function vkpb_php_version_notice() {
		/* translators: %s: phpversion() */
		vkpb_admin_notice( sprintf( esc_html__( 'Your PHP version (%s) is not supported. Required >=5.4', 'vikoder-posts-block' ), phpversion() ) );
	}
}

if ( ! function_exists( 'vkpb_vendor_notice' ) ) {
	function vkpb_vendor_notice() {
		vkpb_admin_notice( __( 'Please install plugin dependencies. Use <code>composer install</code>', 'vikoder-posts-block' ) );
	}
}
