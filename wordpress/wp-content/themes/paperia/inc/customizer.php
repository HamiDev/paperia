<?php
/**
 * Theme Customizer settings.
 *
 * Contact details are stored as theme mods. The free ACF plugin has no
 * options pages, so Appearance → Customize is the place to edit them.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register contact settings.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function paperia_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'paperia_contact',
		array(
			'title'    => __( 'Contact', 'paperia' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'paperia_contact_email',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_email',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'paperia_contact_email',
		array(
			'label'       => __( 'Email', 'paperia' ),
			'description' => __( 'Shown on the contact page and in the footer.', 'paperia' ),
			'section'     => 'paperia_contact',
			'type'        => 'email',
		)
	);

	$wp_customize->add_setting(
		'paperia_contact_phone',
		array(
			'default'           => '021-88521241',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'paperia_contact_phone',
		array(
			'label'   => __( 'Sales phone', 'paperia' ),
			'section' => 'paperia_contact',
			'type'    => 'text',
		)
	);
}
add_action( 'customize_register', 'paperia_customize_register' );
