<?php
/**
 * Site header chrome (logo, primary menu, account, search).
 *
 * Concept: get_template_part() loads this into header.php. One sticky row —
 * brand at inline-start (right in RTL), menu centered, actions at inline-end.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_account_url   = paperia_get_account_url();
$paperia_account_label = is_user_logged_in()
	? __( 'حساب من', 'paperia' )
	: __( 'ورود', 'paperia' );
?>
<header class="site-header" role="banner" data-site-header>
	<div class="site-header__inner">
		<div class="site-header__brand">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<span class="site-title__mark"><?php bloginfo( 'name' ); ?></span>
				</a>
			<?php endif; ?>
		</div>

		<nav
			id="site-primary-nav"
			class="site-nav"
			data-site-nav
			aria-label="<?php esc_attr_e( 'Primary', 'paperia' ); ?>"
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

		<div class="site-header__actions">
			<a
				class="site-header__account"
				href="<?php echo esc_url( $paperia_account_url ); ?>"
				aria-label="<?php echo esc_attr( $paperia_account_label ); ?>"
			>
				<span class="icon-UserCircle" aria-hidden="true"></span>
				<span class="site-header__account-label"><?php echo esc_html( $paperia_account_label ); ?></span>
			</a>

			<button
				type="button"
				class="site-header__search-toggle"
				data-search-toggle
				aria-expanded="false"
				aria-controls="paperia-header-search-panel"
				aria-label="<?php esc_attr_e( 'Search', 'paperia' ); ?>"
			>
				<span class="icon-MagnifyingGlass" aria-hidden="true"></span>
			</button>

			<button
				type="button"
				class="site-header__menu-toggle"
				data-nav-toggle
				aria-expanded="false"
				aria-controls="site-primary-nav"
				aria-label="<?php esc_attr_e( 'Open menu', 'paperia' ); ?>"
				data-label-open="<?php esc_attr_e( 'Open menu', 'paperia' ); ?>"
				data-label-close="<?php esc_attr_e( 'Close menu', 'paperia' ); ?>"
			>
				<span class="icon-List" aria-hidden="true"></span>
			</button>
		</div>

		<form
			id="paperia-header-search-panel"
			class="site-header__search"
			role="search"
			method="get"
			action="<?php echo esc_url( home_url( '/' ) ); ?>"
			data-search-panel
			hidden
		>
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
	</div>
</header>
