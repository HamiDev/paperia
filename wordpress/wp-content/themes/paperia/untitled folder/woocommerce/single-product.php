<?php
/**
 * Single product.
 *
 * Replaces WooCommerce's full-width product layout with the theme shell.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package Paperia
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );
?>

<div class="product-page">
	<div class="product-page__inner">
		<?php woocommerce_breadcrumb(); ?>
		<?php woocommerce_output_all_notices(); ?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php wc_get_template_part( 'content', 'single-product' ); ?>
		<?php endwhile; ?>
	</div>
</div>

<?php
do_action( 'woocommerce_after_main_content' );
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
