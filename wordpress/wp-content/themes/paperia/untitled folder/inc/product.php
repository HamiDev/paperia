<?php
/**
 * Single product layout helpers.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Percent off the regular price, or 0 when the product is not discounted.
 *
 * @param mixed $product Product object.
 * @return int
 */
function paperia_get_sale_percent( $product ) {
	if ( ! $product instanceof WC_Product || ! $product->is_on_sale() ) {
		return 0;
	}

	$regular = $product->get_regular_price();
	$sale    = $product->get_sale_price();

	if ( '' === $regular || '' === $sale || ! is_numeric( $regular ) || ! is_numeric( $sale ) ) {
		return 0;
	}

	$regular_amount = (float) $regular;

	if ( $regular_amount <= 0 ) {
		return 0;
	}

	return (int) round( ( ( $regular_amount - (float) $sale ) / $regular_amount ) * 100 );
}

/**
 * Drop WooCommerce's full-bleed wrappers so the theme product layout can own the page.
 *
 * @return void
 */
function paperia_product_unhook_defaults() {
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return;
	}

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
}
add_action( 'template_redirect', 'paperia_product_unhook_defaults' );

/**
 * Mark single product screens so product styles can target them.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function paperia_product_body_class( $classes ) {
	if ( function_exists( 'is_product' ) && is_product() ) {
		$classes[] = 'paperia-product';
	}

	return $classes;
}
add_filter( 'body_class', 'paperia_product_body_class' );

/**
 * Show the discount percent on the gallery badge.
 *
 * @param string     $html    Default sale flash markup.
 * @param WP_Post    $post    Product post.
 * @param WC_Product $product Product object.
 * @return string
 */
function paperia_product_sale_flash( $html, $post, $product ) {
	unset( $post );

	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return $html;
	}

	$percent = paperia_get_sale_percent( $product );
	$label   = $percent > 0 ? $percent . '%' : __( 'تخفیف', 'paperia' );

	return '<span class="onsale">' . esc_html( $label ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'paperia_product_sale_flash', 10, 3 );

/**
 * The tab label already names the panel, so skip the repeated heading.
 *
 * @return string
 */
function paperia_product_hide_tab_heading() {
	return '';
}
add_filter( 'woocommerce_product_description_heading', 'paperia_product_hide_tab_heading' );
add_filter( 'woocommerce_product_additional_information_heading', 'paperia_product_hide_tab_heading' );

/**
 * Minus control for the product quantity field.
 *
 * @return void
 */
function paperia_product_quantity_minus() {
	paperia_product_quantity_button( -1 );
}
add_action( 'woocommerce_before_quantity_input_field', 'paperia_product_quantity_minus' );

/**
 * Plus control for the product quantity field.
 *
 * @return void
 */
function paperia_product_quantity_plus() {
	paperia_product_quantity_button( 1 );
}
add_action( 'woocommerce_after_quantity_input_field', 'paperia_product_quantity_plus' );

/**
 * Print a quantity step button on the single product page.
 *
 * @param int $step -1 or 1.
 * @return void
 */
function paperia_product_quantity_button( $step ) {
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return;
	}

	$is_minus = (int) $step < 0;
	$icon     = $is_minus ? 'icon-Minus' : 'icon-Plus';
	$label    = $is_minus ? __( 'کاهش تعداد', 'paperia' ) : __( 'افزایش تعداد', 'paperia' );

	printf(
		'<button type="button" class="product-qty__btn" data-qty-step="%1$d" aria-label="%2$s"><span class="%3$s" aria-hidden="true"></span></button>',
		$is_minus ? -1 : 1,
		esc_attr( $label ),
		esc_attr( $icon )
	);
}
