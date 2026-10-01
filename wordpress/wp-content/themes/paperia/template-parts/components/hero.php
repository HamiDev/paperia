<?php
/**
 * Front-page hero slider.
 *
 * Concept: slides come from paperia_get_hero_slides() (ACF or theme defaults).
 * Each slide ships desktop + mobile images via <picture> so the browser picks
 * the right asset from the media query — no extra JavaScript for that part.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_slides = paperia_get_hero_slides();

if ( empty( $paperia_slides ) ) {
	return;
}

$paperia_slide_count = count( $paperia_slides );
?>
<section class="hero-slider" data-hero-slider aria-roledescription="<?php esc_attr_e( 'carousel', 'paperia' ); ?>" aria-label="<?php esc_attr_e( 'Hero', 'paperia' ); ?>">
	<div class="hero-slider__viewport">
		<div class="hero-slider__track" data-hero-track>
			<?php foreach ( $paperia_slides as $paperia_index => $paperia_slide ) : ?>
				<?php
				$paperia_is_active   = 0 === $paperia_index;
				$paperia_title       = isset( $paperia_slide['title'] ) ? $paperia_slide['title'] : '';
				$paperia_desktop_src = isset( $paperia_slide['desktop_image'] ) ? $paperia_slide['desktop_image'] : '';
				$paperia_mobile_src  = isset( $paperia_slide['mobile_image'] ) ? $paperia_slide['mobile_image'] : $paperia_desktop_src;
				$paperia_cta_primary = isset( $paperia_slide['cta_primary'] ) ? $paperia_slide['cta_primary'] : '';
				$paperia_cta_primary_url = isset( $paperia_slide['cta_primary_url'] ) ? $paperia_slide['cta_primary_url'] : '';
				$paperia_cta_secondary = isset( $paperia_slide['cta_secondary'] ) ? $paperia_slide['cta_secondary'] : '';
				$paperia_cta_secondary_url = isset( $paperia_slide['cta_secondary_url'] ) ? $paperia_slide['cta_secondary_url'] : '';
				?>
				<article
					class="hero-slide<?php echo $paperia_is_active ? ' is-active' : ''; ?>"
					data-hero-slide
					<?php echo $paperia_is_active ? '' : ' hidden'; ?>
					aria-roledescription="<?php esc_attr_e( 'slide', 'paperia' ); ?>"
					aria-label="<?php echo esc_attr( sprintf( /* translators: 1: current slide, 2: total slides */ __( 'Slide %1$d of %2$d', 'paperia' ), $paperia_index + 1, $paperia_slide_count ) ); ?>"
				>
					<div class="hero-slide__media">
						<picture>
							<source media="(min-width: 48rem)" srcset="<?php echo esc_url( $paperia_desktop_src ); ?>">
							<img
								src="<?php echo esc_url( $paperia_mobile_src ); ?>"
								alt=""
								class="hero-slide__image"
								width="1024"
								height="682"
								<?php echo $paperia_is_active ? 'fetchpriority="high"' : 'loading="lazy"'; ?>
								decoding="async"
							>
						</picture>
					</div>

					<div class="hero-slide__content">
						<?php if ( $paperia_title ) : ?>
							<p class="hero-slide__eyebrow"><?php echo esc_html( $paperia_title ); ?></p>
						<?php endif; ?>

						<div class="hero-slide__brand" aria-hidden="true">
							<span class="hero-slide__brand-mark">NAMDAR</span>
						</div>

						<?php if ( $paperia_cta_primary || $paperia_cta_secondary ) : ?>
							<div class="hero-slide__actions">
								<?php if ( $paperia_cta_primary ) : ?>
									<a class="hero-cta hero-cta--peach" href="<?php echo esc_url( $paperia_cta_primary_url ? $paperia_cta_primary_url : home_url( '/' ) ); ?>">
										<span class="hero-cta__icon icon-Package" aria-hidden="true"></span>
										<span class="hero-cta__label"><?php echo esc_html( $paperia_cta_primary ); ?></span>
										<span class="hero-cta__arrow icon-ArrowLeft" aria-hidden="true"></span>
									</a>
								<?php endif; ?>

								<?php if ( $paperia_cta_secondary ) : ?>
									<a class="hero-cta hero-cta--mint" href="<?php echo esc_url( $paperia_cta_secondary_url ? $paperia_cta_secondary_url : home_url( '/' ) ); ?>">
										<span class="hero-cta__icon icon-Storefront" aria-hidden="true"></span>
										<span class="hero-cta__label"><?php echo esc_html( $paperia_cta_secondary ); ?></span>
										<span class="hero-cta__arrow icon-ArrowLeft" aria-hidden="true"></span>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>

	<?php if ( $paperia_slide_count > 1 ) : ?>
		<div class="hero-slider__controls">
			<button type="button" class="hero-slider__nav hero-slider__nav--prev" data-hero-prev aria-label="<?php esc_attr_e( 'Previous slide', 'paperia' ); ?>">
				<span class="icon-ArrowRight" aria-hidden="true"></span>
			</button>
			<div class="hero-slider__dots" data-hero-dots role="tablist" aria-label="<?php esc_attr_e( 'Slide navigation', 'paperia' ); ?>">
				<?php foreach ( $paperia_slides as $paperia_index => $paperia_slide ) : ?>
					<button
						type="button"
						class="hero-slider__dot<?php echo 0 === $paperia_index ? ' is-active' : ''; ?>"
						data-hero-dot="<?php echo esc_attr( (string) $paperia_index ); ?>"
						aria-label="<?php echo esc_attr( sprintf( /* translators: %d: slide number */ __( 'Go to slide %d', 'paperia' ), $paperia_index + 1 ) ); ?>"
						aria-current="<?php echo 0 === $paperia_index ? 'true' : 'false'; ?>"
					></button>
				<?php endforeach; ?>
			</div>
			<button type="button" class="hero-slider__nav hero-slider__nav--next" data-hero-next aria-label="<?php esc_attr_e( 'Next slide', 'paperia' ); ?>">
				<span class="icon-ArrowLeft" aria-hidden="true"></span>
			</button>
		</div>
	<?php endif; ?>
</section>
