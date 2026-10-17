<?php
/**
 * My Account navigation — Paperia with icons.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Paperia
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation paperia-account__nav" aria-label="<?php esc_attr_e( 'Account pages', 'woocommerce' ); ?>">
	<ul class="paperia-account__nav-list">
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php
			$icon_class = function_exists( 'paperia_get_account_nav_icon' )
				? paperia_get_account_nav_icon( $endpoint )
				: '';
			$item_classes = wc_get_account_menu_item_classes( $endpoint );
			?>
			<li class="<?php echo esc_attr( $item_classes ); ?>">
				<a
					href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
					class="paperia-account__nav-link"
					<?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?>
				>
					<?php if ( $icon_class ) : ?>
						<span class="paperia-account__nav-icon <?php echo esc_attr( $icon_class ); ?>" aria-hidden="true"></span>
					<?php endif; ?>
					<span class="paperia-account__nav-label"><?php echo esc_html( $label ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
