<?php
/**
 * Theme supports, menus, and image sizes.
 *
 * Concept: "theme support" tells WordPress which built-in features we use
 * (title tag, featured images, HTML5 markup, etc.).
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register theme features after WordPress is ready.
 *
 * Hook: after_setup_theme — runs early on every front-end and admin load.
 */
function paperia_setup() {
	load_theme_textdomain( 'paperia', PAPERIA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'paperia' ),
			'footer'  => __( 'Footer Menu', 'paperia' ),
		)
	);
}
add_action( 'after_setup_theme', 'paperia_setup' );
