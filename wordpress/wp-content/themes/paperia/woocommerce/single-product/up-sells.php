<?php
/**
 * Up-sells, rendered with the theme product cards.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package Paperia
 */

defined( 'ABSPATH' ) || exit;

if ( ! $upsells ) {
	return;
}

$paperia_heading = apply_filters( 'woocommerce_product_upsells_products_heading', __( 'You may also like&hellip;', 'woocommerce' ) );

get_template_part(
	'template-parts/components/product',
	'grid',
	array(
		'products' => $upsells,
		'heading'  => is_string( $paperia_heading ) ? $paperia_heading : '',
		'label_id' => 'product-upsells-title',
	)
);

wp_reset_postdata();
