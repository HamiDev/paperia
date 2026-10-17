<?php
/**
 * Single product categories and tags, shown as chips.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package Paperia
 */

use Automattic\WooCommerce\Enums\ProductType;

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product instanceof WC_Product ) {
	return;
}
?>
<div class="product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( ProductType::VARIABLE ) ) ) : ?>
		<span class="sku_wrapper">
			<?php esc_html_e( 'SKU:', 'woocommerce' ); ?>
			<span class="sku"><?php echo $product->get_sku() ? esc_html( $product->get_sku() ) : esc_html__( 'N/A', 'woocommerce' ); ?></span>
		</span>
	<?php endif; ?>

	<?php
	$paperia_category_orderby = apply_filters( 'woocommerce_product_meta_category_orderby', 'breadcrumb', $product );
	$paperia_category_label   = _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' );
	$paperia_category_list    = wc_get_product_category_list(
		$product->get_id(),
		'',
		'<span class="posted_in">' . esc_html( $paperia_category_label ) . ' ',
		'</span>',
		is_string( $paperia_category_orderby ) ? $paperia_category_orderby : ''
	);

	if ( is_string( $paperia_category_list ) && '' !== $paperia_category_list ) {
		echo $paperia_category_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce returns escaped category links.
	}

	$paperia_tag_label = _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' );
	$paperia_tag_list  = wc_get_product_tag_list(
		$product->get_id(),
		'',
		'<span class="tagged_as">' . esc_html( $paperia_tag_label ) . ' ',
		'</span>'
	);

	if ( is_string( $paperia_tag_list ) && '' !== $paperia_tag_list ) {
		echo $paperia_tag_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce returns escaped tag links.
	}
	?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
