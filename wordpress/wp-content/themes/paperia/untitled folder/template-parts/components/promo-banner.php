<?php
/**
 * Mid-page promotional / custom-order banner.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="home-promo" aria-labelledby="home-promo-title">
	<div class="home-promo__inner">
		<div class="home-promo__visual" aria-hidden="true">
			<span class="home-promo__stack"></span>
			<span class="home-promo__swatches"></span>
		</div>

		<div class="home-promo__copy">
			<h2 id="home-promo-title" class="home-promo__title">
				<?php esc_html_e( 'سفارش مستقیم و تخصصی', 'paperia' ); ?>
			</h2>
			<p class="home-promo__text">
				<?php esc_html_e( 'انواع کاغذ، مقوا، زینک و ملزومات چاپ را مستقیم از نامدار سفارش دهید.', 'paperia' ); ?>
			</p>
		</div>

		<div class="home-promo__action">
			<span class="home-promo__form-icon icon-FileText" aria-hidden="true"></span>
			<a class="button home-promo__button" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'ارسال درخواست', 'paperia' ); ?>
			</a>
		</div>
	</div>
</section>
