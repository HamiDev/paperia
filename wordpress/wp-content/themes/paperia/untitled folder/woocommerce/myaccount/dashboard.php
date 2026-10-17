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
$paperia_avatar   = get_avatar(
	$paperia_user->ID,
	96,
	'',
	$paperia_name,
	array(
		'class'         => 'paperia-account-welcome__avatar-img',
		'force_display' => true,
	)
);

$paperia_shortcuts = array(
	array(
		'endpoint'    => 'orders',
		'url'         => wc_get_endpoint_url( 'orders' ),
		'icon'        => 'icon-Package',
		'title'       => __( 'سفارش‌ها', 'paperia' ),
		'description' => __( 'سفارش‌های اخیر را ببینید و پیگیری کنید.', 'paperia' ),
	),
	array(
		'endpoint'    => 'edit-address',
		'url'         => wc_get_endpoint_url( 'edit-address' ),
		'icon'        => 'icon-MapPin',
		'title'       => wc_shipping_enabled()
			? __( 'نشانی‌ها', 'paperia' )
			: __( 'نشانی صورتحساب', 'paperia' ),
		'description' => __( 'نشانی ارسال و صورتحساب را مدیریت کنید.', 'paperia' ),
	),
	array(
		'endpoint'    => 'edit-account',
		'url'         => wc_get_endpoint_url( 'edit-account' ),
		'icon'        => 'icon-UserCircle',
		'title'       => __( 'جزئیات حساب', 'paperia' ),
		'description' => __( 'پروفایل و رمز عبور را به‌روز کنید.', 'paperia' ),
	),
);
?>

<section class="paperia-account-dashboard">
	<header class="paperia-account-welcome">
		<div class="paperia-account-welcome__avatar">
			<?php
			if ( $paperia_avatar ) {
				echo $paperia_avatar; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_avatar() escapes its markup.
			} else {
				echo esc_html( $paperia_initials );
			}
			?>
		</div>
		<p class="paperia-account-welcome__greeting">
			<?php
			printf(
				/* translators: %s: customer display name */
				esc_html__( 'سلام، %s', 'paperia' ),
				esc_html( $paperia_name )
			);
			?>
		</p>
		<a class="paperia-account-welcome__logout" href="<?php echo esc_url( $paperia_logout ); ?>">
			<span class="paperia-account-welcome__logout-icon icon-SignOut" aria-hidden="true"></span>
			<?php esc_html_e( 'خروج', 'paperia' ); ?>
		</a>
	</header>

	<p class="paperia-account-dashboard__intro">
		<?php esc_html_e( 'از پیشخوان حساب می‌توانید سفارش‌های اخیر را ببینید، نشانی‌ها را مدیریت کنید و جزئیات حساب را ویرایش کنید.', 'paperia' ); ?>
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
