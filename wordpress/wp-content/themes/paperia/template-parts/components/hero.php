<?php
/**
 * Front-page hero scene.
 *
 * Concept: a layered illustration (theme images) with HTML copy in the center.
 * Only the headline comes from ACF (`hero_title`); subtitle and CTA are theme defaults.
 * GSAP (hero-scene.js) animates entrance, ambient drift, and subtle parallax.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_hero_title    = paperia_get_hero_title();
$paperia_hero_subtitle = __( 'کیفیت ماندگار برای هر صفحه', 'paperia' );
$paperia_hero_cta      = __( 'مشاهده محصولات', 'paperia' );
$paperia_hero_cta_url  = paperia_get_shop_url();
$paperia_hero_base     = PAPERIA_URI . '/assets/images/hero';
?>
<section class="hero-scene" data-hero-scene aria-label="<?php esc_attr_e( 'Hero', 'paperia' ); ?>">
	<div class="hero-scene__frame">
		<div class="hero-scene__bg" data-hero-bg aria-hidden="true">
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/banner-bg.jpg' ); ?>"
				alt=""
				width="1024"
				height="682"
				fetchpriority="high"
				decoding="async"
				class="hero-scene__bg-image"
			>
		</div>

		<div class="hero-scene__stage" aria-hidden="true">
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/leaves-left.png' ); ?>"
				alt=""
				width="264"
				height="434"
				decoding="async"
				class="hero-scene__layer hero-scene__layer--leaves-left"
				data-hero-leaves-left
			>
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/leaves-right.png' ); ?>"
				alt=""
				width="309"
				height="453"
				decoding="async"
				class="hero-scene__layer hero-scene__layer--leaves-right"
				data-hero-leaves-right
			>
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/notebooks.png' ); ?>"
				alt=""
				width="571"
				height="424"
				decoding="async"
				class="hero-scene__layer hero-scene__layer--notebooks"
				data-hero-notebooks
			>
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/products.png' ); ?>"
				alt=""
				width="781"
				height="335"
				decoding="async"
				class="hero-scene__layer hero-scene__layer--products"
				data-hero-products
			>
		</div>

		<div class="hero-scene__planes" data-hero-planes aria-hidden="true">
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/plane-yellow.png' ); ?>"
				alt=""
				width="228"
				height="189"
				decoding="async"
				class="hero-scene__plane hero-scene__plane--yellow"
				data-hero-plane="yellow"
			>
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/plane-blue.png' ); ?>"
				alt=""
				width="239"
				height="177"
				decoding="async"
				class="hero-scene__plane hero-scene__plane--blue"
				data-hero-plane="blue"
			>
			<img
				src="<?php echo esc_url( $paperia_hero_base . '/plane-pink.png' ); ?>"
				alt=""
				width="232"
				height="172"
				decoding="async"
				class="hero-scene__plane hero-scene__plane--pink"
				data-hero-plane="pink"
			>
		</div>

		<div class="hero-scene__content" data-hero-content>
			<div class="hero-scene__brand" data-hero-brand>
				<?php echo paperia_get_hero_brand_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper. ?>
			</div>

			<?php if ( $paperia_hero_title ) : ?>
				<h1 class="hero-scene__title"><?php echo esc_html( $paperia_hero_title ); ?></h1>
			<?php endif; ?>

			<?php if ( $paperia_hero_subtitle ) : ?>
				<p class="hero-scene__subtitle"><?php echo esc_html( $paperia_hero_subtitle ); ?></p>
			<?php endif; ?>

			<a class="hero-scene__cta button" href="<?php echo esc_url( $paperia_hero_cta_url ); ?>">
				<?php echo esc_html( $paperia_hero_cta ); ?>
			</a>
		</div>
	</div>
</section>
