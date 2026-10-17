<?php
/**
 * Enqueue styles and scripts.
 *
 * Concept: never hard-link CSS/JS in header.php. Use wp_enqueue_* so WordPress
 * can handle dependencies, versions, and plugin compatibility.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load front-end assets.
 *
 * Hook: wp_enqueue_scripts — the correct place for theme CSS/JS.
 */
function paperia_enqueue_assets() {
	$paperia_styles_path = PAPERIA_DIR . '/assets/css/styles.css';
	$paperia_styles_ver  = file_exists( $paperia_styles_path ) ? (string) filemtime( $paperia_styles_path ) : PAPERIA_VERSION;

	wp_enqueue_style(
		'paperia-styles',
		PAPERIA_URI . '/assets/css/styles.css',
		array(),
		$paperia_styles_ver
	);

	wp_enqueue_script(
		'paperia-theme',
		PAPERIA_URI . '/assets/js/theme.js',
		array(),
		PAPERIA_VERSION,
		true
	);

	wp_enqueue_script(
		'lottie-web',
		'https://cdn.jsdelivr.net/npm/lottie-web@5.12.2/build/player/lottie_light.min.js',
		array(),
		'5.12.2',
		true
	);

	$paperia_lottie_path = PAPERIA_DIR . '/assets/js/header-lottie.js';
	$paperia_lottie_ver  = file_exists( $paperia_lottie_path ) ? (string) filemtime( $paperia_lottie_path ) : PAPERIA_VERSION;

	wp_enqueue_script(
		'paperia-header-lottie',
		PAPERIA_URI . '/assets/js/header-lottie.js',
		array( 'lottie-web' ),
		$paperia_lottie_ver,
		true
	);

	if ( function_exists( 'is_product' ) && is_product() ) {
		$paperia_product_path = PAPERIA_DIR . '/assets/js/product.js';
		$paperia_product_ver  = file_exists( $paperia_product_path ) ? (string) filemtime( $paperia_product_path ) : PAPERIA_VERSION;

		wp_enqueue_script(
			'paperia-product',
			PAPERIA_URI . '/assets/js/product.js',
			array(),
			$paperia_product_ver,
			true
		);
	}

	if ( is_page( 'about-us-3' ) ) {
		wp_enqueue_script(
			'gsap',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
			array(),
			'3.12.5',
			true
		);

		wp_enqueue_script(
			'gsap-scroll-trigger',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
			array( 'gsap' ),
			'3.12.5',
			true
		);

		$paperia_about_path = PAPERIA_DIR . '/assets/js/about.js';
		$paperia_about_ver  = file_exists( $paperia_about_path ) ? (string) filemtime( $paperia_about_path ) : PAPERIA_VERSION;

		wp_enqueue_script(
			'paperia-about',
			PAPERIA_URI . '/assets/js/about.js',
			array( 'gsap', 'gsap-scroll-trigger' ),
			$paperia_about_ver,
			true
		);
	}

	if ( is_front_page() ) {
		wp_enqueue_script(
			'gsap',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js',
			array(),
			'3.12.5',
			true
		);

		wp_enqueue_script(
			'gsap-scroll-trigger',
			'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js',
			array( 'gsap' ),
			'3.12.5',
			true
		);

		$paperia_hero_path = PAPERIA_DIR . '/assets/js/hero-scene.js';
		$paperia_hero_ver  = file_exists( $paperia_hero_path ) ? (string) filemtime( $paperia_hero_path ) : PAPERIA_VERSION;

		wp_enqueue_script(
			'paperia-hero-scene',
			PAPERIA_URI . '/assets/js/hero-scene.js',
			array( 'gsap', 'gsap-scroll-trigger' ),
			$paperia_hero_ver,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'paperia_enqueue_assets' );
