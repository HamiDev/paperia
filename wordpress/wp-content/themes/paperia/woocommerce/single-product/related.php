<?php
/**
 * Related products, rendered with the theme product cards.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package Paperia
 */

defined( 'ABSPATH' ) || exit;

if ( ! $related_products ) {
	return;
}

$paperia_heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

get_template_part(
	'template-parts/components/product',
	'grid',
	array(
		'products' => $related_products,
		'heading'  => is_string( $paperia_heading ) ? $paperia_heading : '',
		'label_id' => 'product-related-title',
	)
);

wp_reset_postdata();
