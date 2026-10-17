<?php
/**
 * Shop catalog helpers: filters, query tweaks, and default WooCommerce chrome.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Whether the current request is the shop, a product taxonomy, or a product search.
 *
 * @return bool
 */
function paperia_is_product_catalog() {
	if ( ! function_exists( 'is_shop' ) ) {
		return false;
	}

	if ( is_shop() || is_product_taxonomy() ) {
		return true;
	}

	if ( ! is_search() ) {
		return false;
	}

	$post_type = get_query_var( 'post_type' );

	return 'product' === $post_type || ( is_array( $post_type ) && in_array( 'product', $post_type, true ) );
}

/**
 * Read a public catalog query arg.
 *
 * Price and sale filters are GET params, matching WooCommerce's own price filter.
 *
 * @param string $key Query arg name.
 * @return string
 */
function paperia_shop_request_value( $key ) {
	if ( ! isset( $_GET[ $key ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return '';
	}

	$raw = wp_unslash( $_GET[ $key ] ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( ! is_scalar( $raw ) ) {
		return '';
	}

	$value = wc_clean( $raw );

	return is_string( $value ) ? $value : '';
}

/**
 * Numeric catalog price from the query string.
 *
 * @param string $key min_price or max_price.
 * @return string Empty when the arg is missing or not numeric.
 */
function paperia_shop_request_price( $key ) {
	$value = paperia_shop_request_value( $key );

	if ( '' === $value || ! is_numeric( $value ) ) {
		return '';
	}

	return wc_format_decimal( abs( (float) $value ) );
}

/**
 * Whether the visitor asked to see sale products only.
 *
 * @return bool
 */
function paperia_shop_on_sale_requested() {
	return '1' === paperia_shop_request_value( 'onsale' );
}

/**
 * Query args that category links should keep.
 *
 * @return array<string, string>
 */
function paperia_shop_preserved_args() {
	$args    = array();
	$min     = paperia_shop_request_price( 'min_price' );
	$max     = paperia_shop_request_price( 'max_price' );
	$orderby = paperia_shop_request_value( 'orderby' );

	if ( '' !== $min ) {
		$args['min_price'] = $min;
	}

	if ( '' !== $max ) {
		$args['max_price'] = $max;
	}

	if ( paperia_shop_on_sale_requested() ) {
		$args['onsale'] = '1';
	}

	if ( '' !== $orderby ) {
		$args['orderby'] = sanitize_key( $orderby );
	}

	return $args;
}

/**
 * Shop or category URL, keeping the current price, sale, and sort args.
 *
 * @param WP_Term|null $term Product category, or null for the main shop.
 * @return string
 */
function paperia_shop_catalog_url( $term = null ) {
	$url = paperia_get_shop_url();

	if ( $term instanceof WP_Term ) {
		$term_url = get_term_link( $term );
		if ( ! is_wp_error( $term_url ) ) {
			$url = $term_url;
		}
	}

	return add_query_arg( paperia_shop_preserved_args(), $url );
}

/**
 * Shop URL with sort kept and category, price, and sale filters removed.
 *
 * @return string
 */
function paperia_shop_clear_filters_url() {
	$args    = array();
	$orderby = paperia_shop_request_value( 'orderby' );

	if ( '' !== $orderby ) {
		$args['orderby'] = sanitize_key( $orderby );
	}

	return add_query_arg( $args, paperia_get_shop_url() );
}

/**
 * Form action for the filter sidebar.
 *
 * @return string
 */
function paperia_shop_filter_action_url() {
	if ( is_search() ) {
		return home_url( '/' );
	}

	if ( is_product_taxonomy() ) {
		$term = get_queried_object();
		if ( $term instanceof WP_Term ) {
			$url = get_term_link( $term );
			if ( ! is_wp_error( $url ) ) {
				return $url;
			}
		}
	}

	return paperia_get_shop_url();
}

/**
 * Top-level product categories that have products.
 *
 * @return WP_Term[]
 */
function paperia_get_shop_categories() {
	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
			'parent'     => 0,
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
		)
	);

	if ( is_wp_error( $terms ) || ! is_array( $terms ) ) {
		return array();
	}

	return array_values(
		array_filter(
			$terms,
			static function ( $term ) {
				return $term instanceof WP_Term && 'uncategorized' !== $term->slug;
			}
		)
	);
}

/**
 * Lowest and highest active product prices in the catalog.
 *
 * @return array{min: float, max: float}
 */
function paperia_get_shop_price_bounds() {
	static $bounds = null;

	if ( null !== $bounds ) {
		return $bounds;
	}

	$bounds = array(
		'min' => paperia_get_catalog_edge_price( 'ASC' ),
		'max' => paperia_get_catalog_edge_price( 'DESC' ),
	);

	return $bounds;
}

/**
 * Lowest or highest active `_price` in the published catalog.
 *
 * Uses a numeric meta sort so placeholders match the prices customers see.
 *
 * @param string $order ASC or DESC.
 * @return float
 */
function paperia_get_catalog_edge_price( $order ) {
	$query = new WP_Query(
		array(
			'post_type'              => 'product',
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'meta_key'               => '_price', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- single indexed lookup for the catalog price bound.
			'orderby'                => 'meta_value_num',
			'order'                  => 'DESC' === $order ? 'DESC' : 'ASC',
			'fields'                 => 'ids',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
		)
	);

	if ( empty( $query->posts ) ) {
		return 0.0;
	}

	$price = get_post_meta( (int) $query->posts[0], '_price', true );

	return is_numeric( $price ) ? (float) $price : 0.0;
}

/**
 * Whether a category, price, or sale filter is applied.
 *
 * @return bool
 */
function paperia_shop_filters_are_active() {
	return is_product_taxonomy()
		|| '' !== paperia_shop_request_price( 'min_price' )
		|| '' !== paperia_shop_request_price( 'max_price' )
		|| paperia_shop_on_sale_requested();
}

/**
 * How many filter groups are currently applied.
 *
 * @return int
 */
function paperia_shop_active_filter_count() {
	$count = 0;

	if ( is_product_taxonomy() ) {
		++$count;
	}

	if ( '' !== paperia_shop_request_price( 'min_price' ) || '' !== paperia_shop_request_price( 'max_price' ) ) {
		++$count;
	}

	if ( paperia_shop_on_sale_requested() ) {
		++$count;
	}

	return $count;
}

/**
 * Limit the catalog to sale products when requested.
 *
 * @param WP_Query $query Main product query.
 * @return void
 */
function paperia_shop_filter_on_sale( $query ) {
	if ( ! paperia_shop_on_sale_requested() || ! $query instanceof WP_Query ) {
		return;
	}

	$sale_ids = array_map( 'absint', (array) wc_get_product_ids_on_sale() );
	$existing = array_filter( array_map( 'absint', (array) $query->get( 'post__in' ) ) );

	if ( $existing ) {
		$sale_ids = array_values( array_intersect( $existing, $sale_ids ) );
	}

	$query->set( 'post__in', empty( $sale_ids ) ? array( 0 ) : array_values( $sale_ids ) );
}
add_action( 'woocommerce_product_query', 'paperia_shop_filter_on_sale' );

/**
 * Drop WooCommerce's full-bleed wrappers so the theme catalog layout can own the page.
 *
 * @return void
 */
function paperia_shop_unhook_default_wrappers() {
	if ( ! paperia_is_product_catalog() ) {
		return;
	}

	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}
add_action( 'template_redirect', 'paperia_shop_unhook_default_wrappers' );

/**
 * Mark catalog screens so shop styles can target them.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function paperia_shop_body_class( $classes ) {
	if ( paperia_is_product_catalog() ) {
		$classes[] = 'paperia-shop';
	}

	return $classes;
}
add_filter( 'body_class', 'paperia_shop_body_class' );

/**
 * Add the shop grid class to the product loop list.
 *
 * @param string $html Loop start markup.
 * @return string
 */
function paperia_shop_loop_start_markup( $html ) {
	if ( ! is_string( $html ) || false !== strpos( $html, 'shop-grid' ) ) {
		return $html;
	}

	return str_replace( 'class="products', 'class="products shop-grid', $html );
}
