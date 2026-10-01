<?php
/**
 * Site header chrome (cart, search, menu, logo).
 *
 * Layout mirrors the Namdar landing mockup: utility bar on top, centered logo.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_cart_count = 0;
$paperia_cart_url   = home_url( '/' );

if ( function_exists( 'WC' ) && WC()->cart ) {
	$paperia_cart_count = (int) WC()->cart->get_cart_contents_count();
	$paperia_cart_url   = wc_get_cart_url();
}
?>
<header class="site-header" role="banner">
	<div class="site-header__bar">
		<a class="site-header__cart" href="<?php echo esc_url( $paperia_cart_url ); ?>" aria-label="<?php esc_attr_e( 'Cart', 'paperia' ); ?>">
			<span class="icon-ShoppingCartSimple" aria-hidden="true"></span>
			<?php if ( $paperia_cart_count > 0 ) : ?>
				<span class="site-header__cart-count"><?php echo esc_html( (string) $paperia_cart_count ); ?></span>
			<?php endif; ?>
		</a>

		<form class="site-header__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="paperia-header-search"><?php esc_html_e( 'Search', 'paperia' ); ?></label>
			<input
				id="paperia-header-search"
				type="search"
				name="s"
				placeholder="<?php esc_attr_e( 'جستجو در فروشگاه…', 'paperia' ); ?>"
				value="<?php echo esc_attr( get_search_query() ); ?>"
			>
			<button type="submit" class="site-header__search-submit" aria-label="<?php esc_attr_e( 'Submit search', 'paperia' ); ?>">
				<span class="icon-MagnifyingGlass" aria-hidden="true"></span>
			</button>
			<?php if ( function_exists( 'is_woocommerce' ) ) : ?>
				<input type="hidden" name="post_type" value="product">
			<?php endif; ?>
		</form>

		<button
			type="button"
			class="site-header__menu-toggle"
			data-nav-toggle
			aria-expanded="false"
			aria-controls="site-primary-nav"
			aria-label="<?php esc_attr_e( 'Open menu', 'paperia' ); ?>"
		>
			<span class="icon-List" aria-hidden="true"></span>
		</button>
	</div>

	<div class="site-header__brand">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="site-title__mark">NAMDAR</span>
			</a>
		<?php endif; ?>
	</div>

	<nav
		id="site-primary-nav"
		class="site-nav"
		data-site-nav
		aria-label="<?php esc_attr_e( 'Primary', 'paperia' ); ?>"
		hidden
	>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'site-nav__list',
				'fallback_cb'    => false,
			)
		);
		?>
	</nav>
</header>
