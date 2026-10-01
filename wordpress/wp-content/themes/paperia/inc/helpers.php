<?php
/**
 * Small reusable helpers.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return the initial color scheme for the <html> data-theme attribute.
 *
 * Prefers a saved ACF Options value when present; otherwise "system"
 * so CSS can follow prefers-color-scheme until the visitor toggles.
 *
 * @return string light|dark|system
 */
function paperia_get_color_scheme() {
	$scheme = 'system';

	if ( function_exists( 'get_field' ) ) {
		$option = get_field( 'default_color_scheme', 'option' );
		if ( is_string( $option ) && in_array( $option, array( 'light', 'dark', 'system' ), true ) ) {
			$scheme = $option;
		}
	}

	return $scheme;
}

/**
 * Default Persian headline for the homepage hero scene.
 *
 * @return string
 */
function paperia_get_default_hero_title() {
	return __( 'کاغذ نامدار، با افتخار برای ایران', 'paperia' );
}

/**
 * Resolve the homepage hero headline.
 *
 * Prefers ACF `hero_title` on the front page when set; otherwise the theme default.
 *
 * @return string
 */
function paperia_get_hero_title() {
	if ( function_exists( 'get_field' ) ) {
		$title = get_field( 'hero_title' );
		if ( is_string( $title ) && '' !== trim( $title ) ) {
			return sanitize_text_field( $title );
		}
	}

	return paperia_get_default_hero_title();
}

/**
 * Shop URL for the hero CTA — WooCommerce shop page when available.
 *
 * @return string
 */
function paperia_get_shop_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$url = wc_get_page_permalink( 'shop' );
		if ( is_string( $url ) && '' !== $url ) {
			return $url;
		}
	}

	return home_url( '/' );
}

/**
 * Account / login URL for the site header.
 *
 * Prefers the WooCommerce My Account page; otherwise WordPress login or profile.
 *
 * @return string
 */
function paperia_get_account_url() {
	if ( function_exists( 'wc_get_page_permalink' ) ) {
		$url = wc_get_page_permalink( 'myaccount' );
		if ( is_string( $url ) && '' !== $url ) {
			return $url;
		}
	}

	if ( is_user_logged_in() ) {
		return get_edit_profile_url();
	}

	return wp_login_url();
}

/**
 * Brand mark HTML for the homepage hero (above the title).
 *
 * Prefers the Customizer logo when set; otherwise the theme brand PNG.
 *
 * @return string Escaped HTML.
 */
function paperia_get_hero_brand_html() {
	$site_name = get_bloginfo( 'name' );

	if ( has_custom_logo() ) {
		$logo_id = (int) get_theme_mod( 'custom_logo' );
		if ( $logo_id > 0 ) {
			$image = wp_get_attachment_image(
				$logo_id,
				'medium',
				false,
				array(
					'class'    => 'hero-scene__brand-image',
					'alt'      => $site_name,
					'decoding' => 'async',
				)
			);
			if ( $image ) {
				return $image;
			}
		}
	}

	return sprintf(
		'<img src="%1$s" alt="%2$s" class="hero-scene__brand-image" width="120" height="120" decoding="async">',
		esc_url( PAPERIA_URI . '/assets/images/hero/brand.png' ),
		esc_attr( $site_name )
	);
}

/**
 * Icomoon icon class for a WooCommerce account menu endpoint.
 *
 * @param string $endpoint Account menu endpoint slug.
 * @return string Icon class name (without leading dot), or empty string.
 */
function paperia_get_account_nav_icon( $endpoint ) {
	$endpoint = is_string( $endpoint ) ? $endpoint : '';

	$icons = array(
		'dashboard'       => 'icon-SquaresFour',
		'orders'          => 'icon-Package',
		'downloads'       => 'icon-DownloadSimple',
		'edit-address'    => 'icon-MapPin',
		'payment-methods' => 'icon-CreditCard',
		'edit-account'    => 'icon-UserCircle',
		'customer-logout' => 'icon-SignOut',
	);

	/**
	 * Filter account navigation icon classes.
	 *
	 * @param array  $icons    Endpoint => icon class map.
	 * @param string $endpoint Current endpoint.
	 */
	$icons = apply_filters( 'paperia_account_nav_icons', $icons, $endpoint );

	if ( isset( $icons[ $endpoint ] ) && is_string( $icons[ $endpoint ] ) ) {
		return $icons[ $endpoint ];
	}

	return 'icon-Circle';
}

/**
 * Initials for a user avatar placeholder.
 *
 * @param WP_User|null $user User object. Defaults to current user.
 * @return string One or two uppercase characters.
 */
function paperia_get_user_initials( $user = null ) {
	if ( ! $user instanceof WP_User ) {
		$user = wp_get_current_user();
	}

	if ( ! $user instanceof WP_User || 0 === (int) $user->ID ) {
		return '';
	}

	$first = trim( (string) $user->first_name );
	$last  = trim( (string) $user->last_name );

	if ( '' !== $first && '' !== $last ) {
		$initials = mb_substr( $first, 0, 1 ) . mb_substr( $last, 0, 1 );
	} elseif ( '' !== $first ) {
		$initials = mb_substr( $first, 0, 2 );
	} else {
		$display  = trim( (string) $user->display_name );
		$initials = '' !== $display ? mb_substr( $display, 0, 2 ) : mb_substr( (string) $user->user_login, 0, 2 );
	}

	return mb_strtoupper( $initials );
}

/**
 * Add body classes on WooCommerce account pages for themed layout.
 *
 * @param string[] $classes Existing body classes.
 * @return string[]
 */
function paperia_account_body_class( $classes ) {
	if ( function_exists( 'is_account_page' ) && is_account_page() ) {
		$classes[] = 'paperia-account-page';

		if ( is_user_logged_in() ) {
			$classes[] = 'paperia-account-page--logged-in';
		} else {
			$classes[] = 'paperia-account-page--logged-out';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'paperia_account_body_class' );
