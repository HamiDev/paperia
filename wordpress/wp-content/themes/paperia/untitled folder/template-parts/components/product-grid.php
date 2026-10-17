<?php
/**
 * Grid of product cards.
 *
 * Used under a single product for related and upsell products.
 *
 * @package Paperia
 *
 * @var array $args {
 *     @type WC_Product[] $products Products to render.
 *     @type string       $heading  Section heading.
 *     @type string       $label_id Heading element id.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_products = array();

if ( isset( $args['products'] ) && is_array( $args['products'] ) ) {
	foreach ( $args['products'] as $paperia_product ) {
		if ( $paperia_product instanceof WC_Product && $paperia_product->is_visible() ) {
			$paperia_products[] = $paperia_product;
		}
	}
}

if ( empty( $paperia_products ) ) {
	return;
}

$paperia_heading  = isset( $args['heading'] ) && is_string( $args['heading'] ) ? $args['heading'] : '';
$paperia_label_id = isset( $args['label_id'] ) && is_string( $args['label_id'] ) ? $args['label_id'] : 'product-grid-title';
$paperia_label_id = sanitize_html_class( $paperia_label_id );
?>
<section class="product-rail"<?php echo '' !== $paperia_heading ? ' aria-labelledby="' . esc_attr( $paperia_label_id ) . '"' : ''; ?>>
	<?php if ( '' !== $paperia_heading ) : ?>
		<header class="product-rail__header">
			<h2 id="<?php echo esc_attr( $paperia_label_id ); ?>" class="product-rail__title"><?php echo esc_html( $paperia_heading ); ?></h2>
			<span class="product-rail__rule" aria-hidden="true"></span>
		</header>
	<?php endif; ?>

	<ul class="products shop-grid">
		<?php foreach ( $paperia_products as $paperia_product ) : ?>
			<li <?php wc_product_class( '', $paperia_product ); ?>>
				<?php
				get_template_part(
					'template-parts/components/product',
					'card',
					array(
						'product' => $paperia_product,
					)
				);
				?>
			</li>
		<?php endforeach; ?>
	</ul>
</section>
