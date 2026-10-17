<?php
/**
 * Contact page content.
 *
 * Phone and email prefer Paperia Settings (ACF Options). When those are empty,
 * the values published on the contact page are used.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sales phone shown on the contact page.
 *
 * @return string
 */
function paperia_get_contact_phone() {
	if ( function_exists( 'get_field' ) ) {
		$phone = get_field( 'phone', 'option' );
		if ( is_string( $phone ) && '' !== trim( $phone ) ) {
			return sanitize_text_field( $phone );
		}
	}

	return '021-88521241';
}

/**
 * tel: href for a display phone number.
 *
 * @param string $phone Display phone.
 * @return string
 */
function paperia_get_contact_phone_href( $phone ) {
	$digits = preg_replace( '/[^\d+]/', '', $phone );

	if ( ! is_string( $digits ) || '' === $digits ) {
		return '';
	}

	return 'tel:' . $digits;
}

/**
 * Contact email shown on the contact page.
 *
 * @return string
 */
function paperia_get_contact_email() {
	if ( function_exists( 'get_field' ) ) {
		$email = get_field( 'email', 'option' );
		if ( is_string( $email ) && is_email( $email ) ) {
			return sanitize_email( $email );
		}
	}

	return 'info@localhost';
}

/**
 * Illustration used beside the contact channels.
 *
 * @return array{url: string, alt: string, width: int, height: int}|array{}
 */
function paperia_get_contact_image() {
	$path = WP_CONTENT_DIR . '/uploads/2024/12/contact-us.jpg';

	if ( ! file_exists( $path ) ) {
		return array();
	}

	return array(
		'url'    => content_url( 'uploads/2024/12/contact-us.jpg' ),
		'alt'    => __( 'راه‌های تماس با نامدار پیپر', 'paperia' ),
		'width'  => 331,
		'height' => 152,
	);
}

/**
 * FAQ entries from the contact page.
 *
 * @return array<int, array{question: string, answer: string}>
 */
function paperia_get_contact_faqs() {
	$shop_link = '<a href="' . esc_url( paperia_get_shop_url() ) . '">' . esc_html__( 'فروشگاه', 'paperia' ) . '</a>';
	$article   = '<cite>' . esc_html__( 'وزن بسته های 500 برگی کاغذ A4 چقدر است؟ + فرمول محاسبه', 'paperia' ) . '</cite>';

	$faqs = array(
		array(
			'question' => __( 'آیا همان محصولی را که در تصویر می بینم دریافت خواهم کرد؟', 'paperia' ),
			'answer'   => '<p>' . esc_html__( 'بله دقیقا. اجناس مطابق تصویر می باشند.', 'paperia' ) . '</p>',
		),
		array(
			'question' => __( 'کجا می توانم جنس خریداری شده را تحویل بگیرم؟', 'paperia' ),
			'answer'   => '<p>' . esc_html__( 'برای خرید در تهران می توانید اجناس را از واحد فروش و یا در صورت تمایل با پیک تحویل بگیرید و برای خرید های عمده در تهران کاغذ ها رایگان برای شما ارسال می شوند.', 'paperia' ) . '</p>',
		),
		array(
			'question' => __( 'ویژگی های خرید عمده از شرکت نامدار چیست؟', 'paperia' ),
			'answer'   => '<p>' . esc_html__( 'تحویل خرید عمده در تهران رایگان می باشد. حمل و ارسال خریدهای عمده بالای 400 جعبه و یا 2000 بسته در سراسر کشور، برای شما بدون هزینه خواهد بود.', 'paperia' ) . '</p>',
		),
		array(
			'question' => __( 'به چه طریق می توانم سفارش خود را ثبت کنم؟', 'paperia' ),
			'answer'   => '<p>' . sprintf(
				/* translators: %s: shop page link. */
				esc_html__( 'یه صفحه %s بروید و محصولات و تعداد مورد نظر را انتخاب کنید، سپس در صفحه پرداخت به صورت آنلاین از طریق درگاه بانکی پرداخت کنید. در هر مرحله از دریافت و ارسال سفارش شما، برایتان پیامک ارسال خواهد شد.', 'paperia' ),
				$shop_link
			) . '</p>',
		),
		array(
			'question' => __( 'از کجا مطمئن شویم که کاغذ ها 80 گرم واقعی می باشند؟', 'paperia' ),
			'answer'   => '<p>' . sprintf(
				/* translators: %s: cited article title. */
				esc_html__( 'همانطور که در مقاله %s توضیح دادیم وزن یک بسته کاغذ A4 هشتاد گرمی، پانصد برگی دو کیلو و چهارصد نود چهار گرم و + لفاف آن در حدود 2.5 کیلو گرم می باشد. اگر بسته ای کمتر از این مقدار وزن داشت یا گرماژ کاغذ کمتر از 80 گرم است و یا تعداد کاغذ های آن بسته کمتر از 500 عدد می باشند.', 'paperia' ),
				$article
			) . '</p>',
		),
	);

	/**
	 * Filter contact-page FAQ items.
	 *
	 * @param array<int, array{question: string, answer: string}> $faqs FAQ items. Answer may contain limited HTML.
	 */
	return apply_filters( 'paperia_contact_faqs', $faqs );
}

/**
 * Mark the contact page for layout styles.
 *
 * @param string[] $classes Existing body classes.
 * @return string[]
 */
function paperia_contact_body_class( $classes ) {
	if ( is_page( 'contact-us' ) ) {
		$classes[] = 'paperia-contact-page';
	}

	return $classes;
}
add_filter( 'body_class', 'paperia_contact_body_class' );
