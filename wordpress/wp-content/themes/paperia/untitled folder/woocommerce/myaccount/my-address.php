<?php
/**
 * My Addresses — Paperia.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Paperia
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}
?>

<div class="paperia-account-addresses">
	<p class="paperia-account-addresses__intro">
		<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</p>

	<div class="woocommerce-Addresses addresses paperia-account-addresses__grid<?php echo ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) ? ' paperia-account-addresses__grid--two' : ''; ?>">
		<?php foreach ( $get_addresses as $name => $address_title ) : ?>
			<?php $address = wc_get_account_formatted_address( $name ); ?>
			<div class="woocommerce-Address paperia-account-address">
				<header class="woocommerce-Address-title title paperia-account-address__header">
					<h2 class="paperia-account-address__title"><?php echo esc_html( $address_title ); ?></h2>
					<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit paperia-account-address__edit">
						<?php
						printf(
							/* translators: %s: Address title */
							$address ? esc_html__( 'Edit %s', 'woocommerce' ) : esc_html__( 'Add %s', 'woocommerce' ),
							esc_html( $address_title )
						);
						?>
					</a>
				</header>
				<address class="paperia-account-address__body">
					<?php
					echo $address ? wp_kses_post( $address ) : esc_html__( 'You have not set up this type of address yet.', 'woocommerce' );

					/**
					 * Used to output content after core address fields.
					 *
					 * @param string $name Address type.
					 * @since 8.7.0
					 */
					do_action( 'woocommerce_my_account_after_my_address', $name );
					?>
				</address>
			</div>
		<?php endforeach; ?>
	</div>
</div>
