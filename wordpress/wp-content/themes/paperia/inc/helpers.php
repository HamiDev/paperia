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
