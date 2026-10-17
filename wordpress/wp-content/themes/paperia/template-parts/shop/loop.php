<?php
/**
 * Shop results: sort toolbar and product card grid.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( woocommerce_product_loop() ) {
	do_action( 'woocommerce_before_shop_loop' );
	?>
	<div class="shop-toolbar">
		<?php woocommerce_result_count(); ?>
		<?php woocommerce_catalog_ordering(); ?>
	</div>
	<?php
	add_filter( 'woocommerce_product_loop_start', 'paperia_shop_loop_start_markup' );
	woocommerce_product_loop_start();

	while ( have_posts() ) {
		the_post();

		do_action( 'woocommerce_shop_loop' );

		$paperia_product = wc_get_product( get_the_ID() );

		if ( ! $paperia_product instanceof WC_Product || ! $paperia_product->is_visible() ) {
			continue;
		}

		echo '<li ';
		wc_product_class( 'shop-grid__item', $paperia_product );
		echo '>';

		get_template_part(
			'template-parts/components/product',
			'card',
			array(
				'product' => $paperia_product,
			)
		);

		echo '</li>';
	}

	woocommerce_product_loop_end();
	remove_filter( 'woocommerce_product_loop_start', 'paperia_shop_loop_start_markup' );

	do_action( 'woocommerce_after_shop_loop' );
	return;
}

do_action( 'woocommerce_no_products_found' );
