<?php
/**
 * My Account Dashboard — Paperia welcome + shortcuts.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Paperia
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_user     = wp_get_current_user();
$paperia_initials = function_exists( 'paperia_get_user_initials' )
	? paperia_get_user_initials( $paperia_user )
	: '';
$paperia_name     = $paperia_user->display_name;
$paperia_logout   = wc_logout_url();

$paperia_shortcuts = array(
	array(
		'endpoint'    => 'orders',
		'url'         => wc_get_endpoint_url( 'orders' ),
		'icon'        => 'icon-Package',
		'title'       => __( 'Orders', 'woocommerce' ),
		'description' => __( 'View and track your recent orders.', 'paperia' ),
	),
	array(
		'endpoint'    => 'edit-address',
		'url'         => wc_get_endpoint_url( 'edit-address' ),
		'icon'        => 'icon-MapPin',
		'title'       => wc_shipping_enabled()
			? __( 'Addresses', 'paperia' )
			: __( 'Billing address', 'woocommerce' ),
		'description' => __( 'Manage shipping and billing addresses.', 'paperia' ),
	),
	array(
		'endpoint'    => 'edit-account',
		'url'         => wc_get_endpoint_url( 'edit-account' ),
		'icon'        => 'icon-UserCircle',
		'title'       => __( 'Account details', 'woocommerce' ),
		'description' => __( 'Update your profile and password.', 'paperia' ),
	),
);
?>

<section class="paperia-account-dashboard">
	<header class="paperia-account-welcome">
		<div class="paperia-account-welcome__avatar" aria-hidden="true">
			<?php echo esc_html( $paperia_initials ); ?>
		</div>
		<div class="paperia-account-welcome__text">
			<p class="paperia-account-welcome__greeting">
				<?php
				printf(
					/* translators: %s: customer display name */
					esc_html__( 'Hello, %s', 'paperia' ),
					esc_html( $paperia_name )
				);
				?>
			</p>
			<p class="paperia-account-welcome__meta">
				<?php
				printf(
					/* translators: %s: logout URL */
					wp_kses(
						__( 'Not you? <a href="%s">Log out</a>', 'paperia' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( $paperia_logout )
				);
				?>
			</p>
		</div>
	</header>

	<p class="paperia-account-dashboard__intro">
		<?php esc_html_e( 'From your account dashboard you can view recent orders, manage addresses, and edit account details.', 'paperia' ); ?>
	</p>

	<div class="paperia-account-shortcuts">
		<?php foreach ( $paperia_shortcuts as $shortcut ) : ?>
			<a class="paperia-account-shortcut" href="<?php echo esc_url( $shortcut['url'] ); ?>">
				<span class="paperia-account-shortcut__icon <?php echo esc_attr( $shortcut['icon'] ); ?>" aria-hidden="true"></span>
				<span class="paperia-account-shortcut__body">
					<span class="paperia-account-shortcut__title"><?php echo esc_html( $shortcut['title'] ); ?></span>
					<span class="paperia-account-shortcut__desc"><?php echo esc_html( $shortcut['description'] ); ?></span>
				</span>
				<span class="paperia-account-shortcut__arrow icon-ArrowLeft" aria-hidden="true"></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>

<?php
/**
 * My Account dashboard.
 *
 * @since 2.6.0
 */
do_action( 'woocommerce_account_dashboard' );

/**
 * Deprecated woocommerce_before_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_before_my_account' );

/**
 * Deprecated woocommerce_after_my_account action.
 *
 * @deprecated 2.6.0
 */
do_action( 'woocommerce_after_my_account' );
