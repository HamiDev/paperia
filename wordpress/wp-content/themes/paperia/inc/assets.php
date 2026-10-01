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
	wp_enqueue_style(
		'paperia-styles',
		PAPERIA_URI . '/assets/css/styles.css',
		array(),
		PAPERIA_VERSION
	);

	wp_enqueue_script(
		'paperia-theme',
		PAPERIA_URI . '/assets/js/theme.js',
		array(),
		PAPERIA_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'paperia_enqueue_assets' );
