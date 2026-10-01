<?php
/**
 * Single product card (WooCommerce-aware).
 *
 * Expects $args['product'] as a WC_Product when WooCommerce is active.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_product = isset( $args['product'] ) ? $args['product'] : null;

if ( ! $paperia_product || ! is_a( $paperia_product, 'WC_Product' ) ) {
	return;
}

$paperia_permalink = $paperia_product->get_permalink();
$paperia_name      = $paperia_product->get_name();
$paperia_image_id  = $paperia_product->get_image_id();
$paperia_regular   = $paperia_product->get_regular_price();
$paperia_sale      = $paperia_product->get_sale_price();
$paperia_on_sale   = $paperia_product->is_on_sale() && '' !== $paperia_sale && '' !== $paperia_regular;
$paperia_discount  = 0;

if ( $paperia_on_sale && (float) $paperia_regular > 0 ) {
	$paperia_discount = (int) round( ( ( (float) $paperia_regular - (float) $paperia_sale ) / (float) $paperia_regular ) * 100 );
}
?>
<article class="product-card">
	<a class="product-card__media" href="<?php echo esc_url( $paperia_permalink ); ?>">
		<?php if ( $paperia_image_id ) : ?>
			<?php
			echo wp_get_attachment_image(
				$paperia_image_id,
				'woocommerce_thumbnail',
				false,
				array(
					'class'   => 'product-card__image',
					'loading' => 'lazy',
					'alt'     => esc_attr( $paperia_name ),
				)
			);
			?>
		<?php else : ?>
			<span class="product-card__placeholder" aria-hidden="true"></span>
		<?php endif; ?>
	</a>

	<div class="product-card__body">
		<h3 class="product-card__title">
			<a href="<?php echo esc_url( $paperia_permalink ); ?>"><?php echo esc_html( $paperia_name ); ?></a>
		</h3>

		<div class="product-card__pricing">
			<?php if ( $paperia_on_sale ) : ?>
				<span class="product-card__price product-card__price--sale">
					<?php echo wp_kses_post( wc_price( $paperia_sale ) ); ?>
				</span>
				<span class="product-card__price product-card__price--regular">
					<?php echo wp_kses_post( wc_price( $paperia_regular ) ); ?>
				</span>
				<?php if ( $paperia_discount > 0 ) : ?>
					<span class="product-card__badge"><?php echo esc_html( $paperia_discount . '%' ); ?></span>
				<?php endif; ?>
			<?php else : ?>
				<span class="product-card__price product-card__price--sale">
					<?php echo wp_kses_post( $paperia_product->get_price_html() ); ?>
				</span>
			<?php endif; ?>
		</div>

		<?php if ( $paperia_product->is_purchasable() && $paperia_product->is_in_stock() ) : ?>
			<a
				class="button product-card__cart"
				href="<?php echo esc_url( $paperia_product->add_to_cart_url() ); ?>"
				data-quantity="1"
				data-product_id="<?php echo esc_attr( (string) $paperia_product->get_id() ); ?>"
			>
				<span class="icon-ShoppingCartSimple" aria-hidden="true"></span>
				<?php esc_html_e( 'افزودن به سبد', 'paperia' ); ?>
			</a>
		<?php else : ?>
			<a class="button product-card__cart" href="<?php echo esc_url( $paperia_permalink ); ?>">
				<?php esc_html_e( 'مشاهده محصول', 'paperia' ); ?>
			</a>
		<?php endif; ?>
	</div>
</article>
