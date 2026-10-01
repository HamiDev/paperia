<?php
/**
 * Paperia theme bootstrap.
 *
 * WordPress loads this file automatically for the active theme.
 * Keep it thin: define constants and pull in modules from /inc.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PAPERIA_VERSION', '0.2.0' );
define( 'PAPERIA_DIR', get_template_directory() );
define( 'PAPERIA_URI', get_template_directory_uri() );

require_once PAPERIA_DIR . '/inc/setup.php';
require_once PAPERIA_DIR . '/inc/assets.php';
require_once PAPERIA_DIR . '/inc/helpers.php';
require_once PAPERIA_DIR . '/inc/acf.php';
