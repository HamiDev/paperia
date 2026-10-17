<?php
/**
 * Company story and the three phases of Namdar Cellulose.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_story_src = content_url( 'uploads/2024/08/2024-07-28-13.15.57.jpg' );
$paperia_story_id  = attachment_url_to_postid( $paperia_story_src );
$paperia_story_alt = __( 'بسته‌های کاغذ نامدار روی خط تولید', 'paperia' );

$paperia_phases = array(
	array(
		'step' => __( 'فاز نخست', 'paperia' ),
		'text' => __( 'فعالیت در زمینه محصولات سلولزی بهداشتی', 'paperia' ),
	),
	array(
		'step' => __( 'فاز دوم', 'paperia' ),
		'text' => __( 'تولید پوشاک ایرانی و محصولات سلولزی هایژنیک و بیمارستانی', 'paperia' ),
	),
	array(
		'step' => __( 'فاز سوم', 'paperia' ),
		'text' => __( 'تهیه کاغذهای سایز شده اداری و دفتر مشق با کیفیت بالا و قیمت نازل', 'paperia' ),
	),
);
?>
<section id="about-story" class="about-story" aria-labelledby="about-story-title">
	<div class="about-story__inner">
		<div class="about-story__copy">
			<p class="about-kicker"><?php esc_html_e( 'با آسودگی و قیمت مناسب خرید کنید', 'paperia' ); ?></p>
			<h2 id="about-story-title" class="about-story__title">
				<?php esc_html_e( 'فروشگاه کاغذ نامدار', 'paperia' ); ?>
			</h2>
			<div class="about-story__body">
				<p>
					<?php esc_html_e( 'شرکت نامدار سلولز قشم در سال 1387 به پشتوانه بیش از 3 دهه تجربه مدیران خود در صنعت سلولزی و با هدف کمک به خودکفایی کشور در زمینه تولید محصولات سلولزی در جزیره زیبای قشم شروع به فعالیت نمود.', 'paperia' ); ?>
				</p>
				<p>
					<?php esc_html_e( 'از ابتدا استراتژی شرکت خلق فرصت برای اهالی جزیره و خودکفایی کشور در زمینه کالاهایی که می‌توان با تکیه بر دانش و مهارت بومی‌سازی شده تولید نمود بوده است. از این رو همواره هدف همکاران این شرکت تولید محصولات بر پایه احترام، جلب و حفظ اعتماد و نهایتاً انتقال عشق از شهرستان زیبای قشم به سراسر میهن عزیزمان و سایر کشورهای جهان بوده است.', 'paperia' ); ?>
				</p>
			</div>
			<p class="about-story__sign">
				<?php esc_html_e( 'توسعه‌یافته توسط کارخانجات نامدار', 'paperia' ); ?>
			</p>
			<a class="button about-story__button" href="<?php echo esc_url( paperia_get_shop_url() ); ?>">
				<?php esc_html_e( 'ورود به فروشگاه', 'paperia' ); ?>
			</a>
		</div>

		<div class="about-story__aside">
			<?php if ( $paperia_story_id ) : ?>
				<?php
				echo wp_get_attachment_image(
					$paperia_story_id,
					'full',
					false,
					array(
						'class'    => 'about-story__photo',
						'alt'      => $paperia_story_alt,
						'loading'  => 'lazy',
						'decoding' => 'async',
					)
				);
				?>
			<?php else : ?>
				<img
					class="about-story__photo"
					src="<?php echo esc_url( $paperia_story_src ); ?>"
					alt="<?php echo esc_attr( $paperia_story_alt ); ?>"
					width="810"
					height="1080"
					loading="lazy"
					decoding="async"
				>
			<?php endif; ?>

			<ol class="about-phases">
				<?php foreach ( $paperia_phases as $paperia_phase ) : ?>
					<li class="about-phase">
						<span class="about-phase__step"><?php echo esc_html( $paperia_phase['step'] ); ?></span>
						<p class="about-phase__text"><?php echo esc_html( $paperia_phase['text'] ); ?></p>
					</li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</section>
