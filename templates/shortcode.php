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

	<div class="vkpb-card-item">
		<a
			href="<?php echo esc_url( $item['link'] ); ?>"
			title="<?php echo esc_attr( $item['title'] ); ?>"
			class="vkpb-link"
		>
			<div class="vkpb-card-thumb">
				<img
					src="<?php echo esc_url( $item['thumb'] ); ?>"
					alt="<?php echo esc_attr( $item['title'] ); ?>"
				/>
			</div>
			<h4 class="vkpb-card-title">
				<?php echo esc_html( $item['title'] ); ?>
			</h4>
		</a>
	</div>

	<?php endforeach; ?>

</div>
