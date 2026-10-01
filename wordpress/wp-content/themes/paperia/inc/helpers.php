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
 * Default hero slides when ACF has no slides yet.
 *
 * Theme images live in assets/images/hero/. Editors can replace these later
 * via an ACF repeater named `hero_slides` on the front page.
 *
 * @return array<int, array<string, string>>
 */
function paperia_get_default_hero_slides() {
	return array(
		array(
			'title'          => __( 'دنیای شاد کاغذ و تحریر', 'paperia' ),
			'desktop_image'  => PAPERIA_URI . '/assets/images/hero/banner-desktop.jpg',
			'mobile_image'   => PAPERIA_URI . '/assets/images/hero/banner-mobile.jpg',
			'cta_primary'    => __( 'ثبت سفارش بسته بندی', 'paperia' ),
			'cta_primary_url'=> home_url( '/' ),
			'cta_secondary'  => __( 'درخواست نمایندگی', 'paperia' ),
			'cta_secondary_url' => home_url( '/' ),
		),
	);
}

/**
 * Resolve hero slides for the front-page slider.
 *
 * Prefers ACF `hero_slides` on the current page when present; otherwise
 * falls back to the theme default images so the landing page still works.
 *
 * @return array<int, array<string, mixed>>
 */
function paperia_get_hero_slides() {
	$slides = array();

	if ( function_exists( 'get_field' ) ) {
		$acf_slides = get_field( 'hero_slides' );

		if ( is_array( $acf_slides ) && ! empty( $acf_slides ) ) {
			foreach ( $acf_slides as $row ) {
				if ( ! is_array( $row ) ) {
					continue;
				}

				$desktop = isset( $row['desktop_image'] ) ? $row['desktop_image'] : null;
				$mobile  = isset( $row['mobile_image'] ) ? $row['mobile_image'] : null;

				$desktop_url = is_array( $desktop ) && ! empty( $desktop['url'] ) ? $desktop['url'] : '';
				$mobile_url  = is_array( $mobile ) && ! empty( $mobile['url'] ) ? $mobile['url'] : $desktop_url;

				if ( '' === $desktop_url && '' === $mobile_url ) {
					continue;
				}

				$slides[] = array(
					'title'             => isset( $row['title'] ) ? (string) $row['title'] : '',
					'desktop_image'     => $desktop_url ? $desktop_url : $mobile_url,
					'mobile_image'      => $mobile_url ? $mobile_url : $desktop_url,
					'cta_primary'       => isset( $row['cta_primary'] ) ? (string) $row['cta_primary'] : '',
					'cta_primary_url'   => isset( $row['cta_primary_url'] ) ? (string) $row['cta_primary_url'] : '',
					'cta_secondary'     => isset( $row['cta_secondary'] ) ? (string) $row['cta_secondary'] : '',
					'cta_secondary_url' => isset( $row['cta_secondary_url'] ) ? (string) $row['cta_secondary_url'] : '',
				);
			}
		}
	}

	if ( empty( $slides ) ) {
		$slides = paperia_get_default_hero_slides();
	}

	return $slides;
}
