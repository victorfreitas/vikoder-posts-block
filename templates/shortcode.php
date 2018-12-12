<?php
/**
 *
 * Template shortcode
 *
 * @package templates/shortcode
 * @author  Viktor Freitas
 * @since   1.0.0
 * @link    https://github.com/victorfreitas
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 0 );
}

?>
<div class="vkpb-cards">

	<?php foreach ( $list as $item ) : ?>

	<div class="vkpb-cart-item">
		<a
			href="<?php echo esc_url( $item['link'] ); ?>"
			title="<?php echo esc_attr( $item['title'] ); ?>"
			class="vkpb-link"
		>
			<img
				src="<?php echo esc_url( $item['thumb'] ); ?>"
				alt="<?php echo esc_attr( $item['title'] ); ?>"
			/>
			<span><?php echo esc_html( $item['title'] ); ?></span>
		</a>
	</div>

	<?php endforeach; ?>

</div>
