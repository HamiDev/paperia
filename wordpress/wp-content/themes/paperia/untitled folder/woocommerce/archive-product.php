<?php
/**
 * Product archive — shop, categories, tags, and product search.
 *
 * Replaces WooCommerce's full-width loop with a constrained catalog
 * of the theme product cards.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package Paperia
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );
?>

<div class="shop-page">
	<div class="shop-page__inner">
		<?php woocommerce_breadcrumb(); ?>
		<?php do_action( 'woocommerce_shop_loop_header' ); ?>
		<?php woocommerce_output_all_notices(); ?>

		<div class="shop-page__layout">
			<div class="shop-page__results">
				<?php get_template_part( 'template-parts/shop/loop' ); ?>
			</div>
		</div>
	</div>
</div>

<?php
do_action( 'woocommerce_after_main_content' );
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
