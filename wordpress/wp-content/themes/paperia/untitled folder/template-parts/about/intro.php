<?php
/**
 * About page introduction: headline, factory photo, and two entry cards.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_hero_src = content_url( 'uploads/2024/07/2024-07-28-13.11.22.jpg' );
$paperia_hero_id  = attachment_url_to_postid( $paperia_hero_src );
$paperia_hero_alt = __( 'کارخانه نامدار', 'paperia' );
?>
<section class="about-intro" aria-labelledby="about-intro-title">
	<div class="about-intro__inner">
		<p class="about-kicker"><?php esc_html_e( 'آشنایی با برند نامدار', 'paperia' ); ?></p>
		<h1 id="about-intro-title" class="about-intro__title">
			<?php esc_html_e( 'با کارخانجات نامدار آشنا شوید', 'paperia' ); ?>
		</h1>

		<figure class="about-intro__media">
			<?php if ( $paperia_hero_id ) : ?>
				<?php
				echo wp_get_attachment_image(
					$paperia_hero_id,
					'full',
					false,
					array(
						'class'         => 'about-intro__image',
						'alt'           => $paperia_hero_alt,
						'loading'       => 'eager',
						'fetchpriority' => 'high',
						'decoding'      => 'async',
					)
				);
				?>
			<?php else : ?>
				<img
					class="about-intro__image"
					src="<?php echo esc_url( $paperia_hero_src ); ?>"
					alt="<?php echo esc_attr( $paperia_hero_alt ); ?>"
					width="1080"
					height="810"
					loading="eager"
					fetchpriority="high"
					decoding="async"
				>
			<?php endif; ?>
			<figcaption class="about-intro__caption"><?php esc_html_e( 'کارخانه نامدار', 'paperia' ); ?></figcaption>
		</figure>

		<div class="about-intro__cards">
			<article class="about-card">
				<span class="about-card__icon icon-Factory" aria-hidden="true"></span>
				<h2 class="about-card__title">
					<?php esc_html_e( 'ما محصول کاملا داخلی با کیفیت رقابتی تولید می‌کنیم', 'paperia' ); ?>
				</h2>
				<p class="about-card__text">
					<?php esc_html_e( 'با چنین تولیداتی، ایران خودکفا می‌شود.', 'paperia' ); ?>
				</p>
				<a class="about-card__more" href="#about-story">
					<?php esc_html_e( 'ادامه مطلب', 'paperia' ); ?>
					<span class="screen-reader-text">
						<?php esc_html_e( 'درباره فروشگاه کاغذ نامدار', 'paperia' ); ?>
					</span>
					<span class="icon-ArrowLeft" aria-hidden="true"></span>
				</a>
			</article>

			<article class="about-card">
				<span class="about-card__icon icon-PlayCircle" aria-hidden="true"></span>
				<h2 class="about-card__title">
					<?php esc_html_e( 'روند کار ما', 'paperia' ); ?>
				</h2>
				<p class="about-card__text">
					<?php esc_html_e( 'با چرخه تولید ما آشنا شوید.', 'paperia' ); ?>
				</p>
				<a class="about-card__more" href="#about-process">
					<?php esc_html_e( 'ادامه مطلب', 'paperia' ); ?>
					<span class="screen-reader-text">
						<?php esc_html_e( 'چرخه تولید در کارخانجات نامدار', 'paperia' ); ?>
					</span>
					<span class="icon-ArrowLeft" aria-hidden="true"></span>
				</a>
			</article>
		</div>
	</div>
</section>
