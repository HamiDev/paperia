<?php
/**
 * My Account page — Paperia shell.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package Paperia
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="paperia-account">
	<?php
	/**
	 * My Account navigation.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_navigation' );
	?>

	<div class="woocommerce-MyAccount-content paperia-account__content">
		<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
		?>
	</div>
</div>
