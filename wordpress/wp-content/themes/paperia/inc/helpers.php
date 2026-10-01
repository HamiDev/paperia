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
