<?php
/**
 * Featured products grid for the front page.
 *
 * Pulls up to 8 WooCommerce products when the plugin is active.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_products = array();

if ( function_exists( 'wc_get_products' ) ) {
	$paperia_products = wc_get_products(
		array(
			'status'  => 'publish',
			'limit'   => 8,
			'orderby' => 'date',
			'order'   => 'DESC',
		)
	);
}
?>
<section class="home-featured" aria-labelledby="home-featured-title">
	<header class="home-featured__header">
		<h2 id="home-featured-title" class="home-featured__title">
			<?php esc_html_e( 'محصولات برگزیده نامدار', 'paperia' ); ?>
		</h2>
		<span class="home-featured__rule" aria-hidden="true"></span>
	</header>

	<?php if ( ! empty( $paperia_products ) ) : ?>
		<div class="home-featured__grid">
			<?php foreach ( $paperia_products as $paperia_product ) : ?>
				<?php
				get_template_part(
					'template-parts/components/product',
					'card',
					array(
						'product' => $paperia_product,
					)
				);
				?>
			<?php endforeach; ?>
		</div>
	<?php else : ?>
		<p class="home-featured__empty">
			<?php esc_html_e( 'هنوز محصولی برای نمایش وجود ندارد. محصولات ووکامرس را اضافه کنید تا اینجا دیده شوند.', 'paperia' ); ?>
		</p>
	<?php endif; ?>
</section>
