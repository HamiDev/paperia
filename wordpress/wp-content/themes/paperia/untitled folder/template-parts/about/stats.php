<?php
/**
 * About page figures.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_stats = array(
	array(
		'value' => '1387',
		'label' => __( 'سال تاسیس', 'paperia' ),
		'icon'  => 'icon-Calendar',
	),
	array(
		'value' => '2000',
		'label' => __( 'مشتری وفادار', 'paperia' ),
		'icon'  => 'icon-Heart',
	),
	array(
		'value' => '3',
		'label' => __( 'دفتر خارجی', 'paperia' ),
		'icon'  => 'icon-Globe',
	),
	array(
		'value' => '2',
		'label' => __( 'دفتر داخلی', 'paperia' ),
		'icon'  => 'icon-Buildings',
	),
	array(
		'value' => '167',
		'label' => __( 'همکار', 'paperia' ),
		'icon'  => 'icon-Users',
	),
	array(
		'value' => '100',
		'label' => __( 'محصول تولید شده', 'paperia' ),
		'icon'  => 'icon-Package',
	),
);
?>
<section class="about-stats" aria-labelledby="about-stats-title">
	<div class="about-stats__inner">
		<div class="about-stats__head">
			<p class="about-kicker"><?php esc_html_e( 'ما اینجا هستیم', 'paperia' ); ?></p>
			<h2 id="about-stats-title" class="about-stats__title">
				<?php esc_html_e( 'برای تولید محصول کاملا ایرانی شبانه‌روزی تلاش کردیم', 'paperia' ); ?>
			</h2>
			<p class="about-stats__note">
				<span class="icon-HeartStraight" aria-hidden="true"></span>
				<?php esc_html_e( 'با عشق به ایران عزیزمان', 'paperia' ); ?>
			</p>
		</div>

		<dl class="about-stats__grid">
			<?php foreach ( $paperia_stats as $paperia_stat ) : ?>
				<div class="about-stat">
					<dt class="about-stat__label">
						<span class="<?php echo esc_attr( $paperia_stat['icon'] ); ?>" aria-hidden="true"></span>
						<?php echo esc_html( $paperia_stat['label'] ); ?>
					</dt>
					<dd class="about-stat__value" data-count="<?php echo esc_attr( $paperia_stat['value'] ); ?>">
						<?php echo esc_html( $paperia_stat['value'] ); ?>
					</dd>
				</div>
			<?php endforeach; ?>
		</dl>
	</div>
</section>
