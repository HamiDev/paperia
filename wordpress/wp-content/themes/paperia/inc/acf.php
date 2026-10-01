<?php
/**
 * Advanced Custom Fields integration.
 *
 * Concept: ACF Local JSON saves field groups as files in the theme so they
 * can be versioned in git and shared across environments.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Tell ACF where to save/load field group JSON.
 *
 * @param string $path Default path.
 * @return string
 */
function paperia_acf_json_save_point( $path ) {
	return PAPERIA_DIR . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'paperia_acf_json_save_point' );

/**
 * Add the theme acf-json folder to ACF load paths.
 *
 * @param array $paths Existing paths.
 * @return array
 */
function paperia_acf_json_load_point( $paths ) {
	$paths[] = PAPERIA_DIR . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'paperia_acf_json_load_point' );

/**
 * Register an ACF Options page for site-wide theme settings.
 *
 * Requires ACF Pro for the Options Page feature. Free ACF still works for
 * field groups on posts/pages; Options UI simply will not appear without Pro.
 */
function paperia_acf_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Paperia Settings', 'paperia' ),
			'menu_title' => __( 'Paperia Settings', 'paperia' ),
			'menu_slug'  => 'paperia-settings',
			'capability' => 'edit_theme_options',
			'redirect'   => false,
		)
	);
}
add_action( 'acf/init', 'paperia_acf_options_page' );
