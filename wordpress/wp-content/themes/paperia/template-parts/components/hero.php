<?php
/**
 * Simple hero component for the front page.
 *
 * Later this can be driven by ACF fields (title, text, CTA).
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_hero_title = get_bloginfo( 'name' );
$paperia_hero_text  = get_bloginfo( 'description' );

if ( function_exists( 'get_field' ) ) {
	$acf_title = get_field( 'hero_title' );
	$acf_text  = get_field( 'hero_text' );

	if ( is_string( $acf_title ) && '' !== $acf_title ) {
		$paperia_hero_title = $acf_title;
	}
	if ( is_string( $acf_text ) && '' !== $acf_text ) {
		$paperia_hero_text = $acf_text;
	}
}
?>
<section class="hero">
	<div class="hero__inner">
		<h1 class="hero__title"><?php echo esc_html( $paperia_hero_title ); ?></h1>
		<?php if ( $paperia_hero_text ) : ?>
			<p class="hero__text"><?php echo esc_html( $paperia_hero_text ); ?></p>
		<?php endif; ?>
	</div>
</section>
