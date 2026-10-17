<?php
/**
 * Single product price, including the same percent badge as product cards.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package Paperia
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product instanceof WC_Product ) {
	return;
}

$paperia_percent = paperia_get_sale_percent( $product );
?>
<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
	<?php echo wp_kses_post( $product->get_price_html() ); ?>
	<?php if ( $paperia_percent > 0 ) : ?>
		<span class="product-page__badge"><?php echo esc_html( $paperia_percent . '%' ); ?></span>
	<?php endif; ?>
</p>
