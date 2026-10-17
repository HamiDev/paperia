<?php
/**
 * Production films and the notes that go with them.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_reels = array(
	array(
		'title'      => __( 'چرخه تولید در کارخانجات نامدار', 'paperia' ),
		'paragraphs' => array(
			__( 'این بخشی از چرخه تولید کاغذ کارخانجات نامدار است. روال تولید، کاملا مهندسی‌شده و مجهز به بهترین دستگاه‌هاست.', 'paperia' ),
			__( 'برای بهترین خدمات، تمام توانمان را به کار گرفته‌ایم.', 'paperia' ),
		),
		'video'      => content_url( 'uploads/2024/08/about-production.mp4' ),
		'poster'     => content_url( 'uploads/2024/08/about-production-poster.jpg' ),
		'wide'       => true,
		'flip'       => false,
	),
	array(
		'title'      => __( 'استفاده از متخصصین خارجی', 'paperia' ),
		'paragraphs' => array(
			__( 'برای بهترین کیفیت تولید، از متخصصین خارجی در کنار استفاده از توان فنی و مهندسی متخصصین کشور عزیزمان بهره برده‌ایم.', 'paperia' ),
			__( 'آموزش و پیشرفت، دو اصل مهم در کارخانجات نامدار است. بهبود روش تولید و ارتقای کیفیت محصولات تولید شده، جز با بازنگری مداوم روال‌ها و روش‌ها امکان‌پذیر نیست.', 'paperia' ),
			__( 'با انگیزه ارتقای سطح تولید و ایجاد شغل برای صدها نیروی مستقیم و غیرمستقیم، همواره در تلاشیم. مفتخریم که با راه‌اندازی بخش‌های مختلف کارخانه، با حداکثر توان در حال تولید محصولات سلولزی از جمله کاغذ هستیم.', 'paperia' ),
		),
		'video'      => content_url( 'uploads/2024/08/about-specialists.mp4' ),
		'poster'     => content_url( 'uploads/2024/08/about-specialists-poster.jpg' ),
		'wide'       => false,
		'flip'       => true,
	),
);
?>
<section id="about-process" class="about-process" aria-labelledby="about-process-title">
	<div class="about-process__inner">
		<p id="about-process-title" class="about-kicker">
			<?php esc_html_e( 'روند کار ما', 'paperia' ); ?>
		</p>

		<?php foreach ( $paperia_reels as $paperia_index => $paperia_reel ) : ?>
			<?php
			$paperia_title_id    = 'about-reel-title-' . ( $paperia_index + 1 );
			$paperia_classes     = 'about-reel';
			$paperia_video_class = 'about-reel__video';
			if ( $paperia_reel['flip'] ) {
				$paperia_classes .= ' about-reel--flip';
			}
			if ( $paperia_reel['wide'] ) {
				$paperia_video_class .= ' about-reel__video--wide';
			}
			?>
			<article class="<?php echo esc_attr( $paperia_classes ); ?>">
				<div class="about-reel__copy">
					<h2 id="<?php echo esc_attr( $paperia_title_id ); ?>" class="about-reel__title">
						<?php echo esc_html( $paperia_reel['title'] ); ?>
					</h2>
					<?php foreach ( $paperia_reel['paragraphs'] as $paperia_paragraph ) : ?>
						<p><?php echo esc_html( $paperia_paragraph ); ?></p>
					<?php endforeach; ?>
				</div>
				<div class="about-reel__frame">
					<video
						class="<?php echo esc_attr( $paperia_video_class ); ?>"
						controls
						playsinline
						preload="metadata"
						poster="<?php echo esc_url( $paperia_reel['poster'] ); ?>"
						aria-labelledby="<?php echo esc_attr( $paperia_title_id ); ?>"
					>
						<source src="<?php echo esc_url( $paperia_reel['video'] ); ?>" type="video/mp4">
						<a href="<?php echo esc_url( $paperia_reel['video'] ); ?>">
							<?php esc_html_e( 'دانلود ویدیو', 'paperia' ); ?>
						</a>
					</video>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</section>
