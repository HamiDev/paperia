<?php
/**
 * Contact channels: phone, email, and the page illustration.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_phone      = paperia_get_contact_phone();
$paperia_phone_href = paperia_get_contact_phone_href( $paperia_phone );
$paperia_email      = paperia_get_contact_email();
$paperia_image      = paperia_get_contact_image();
?>
<aside class="contact-panel" aria-labelledby="contact-panel-title">
	<?php if ( ! empty( $paperia_image['url'] ) ) : ?>
		<figure class="contact-panel__media">
			<img
				src="<?php echo esc_url( $paperia_image['url'] ); ?>"
				alt="<?php echo esc_attr( $paperia_image['alt'] ); ?>"
				width="<?php echo esc_attr( (string) $paperia_image['width'] ); ?>"
				height="<?php echo esc_attr( (string) $paperia_image['height'] ); ?>"
				loading="lazy"
				decoding="async"
			/>
		</figure>
	<?php endif; ?>

	<div class="contact-panel__body">
		<h2 id="contact-panel-title" class="contact-panel__title"><?php esc_html_e( 'با ما تماس بگیرید', 'paperia' ); ?></h2>

		<ul class="contact-channels">
			<?php if ( $paperia_phone && $paperia_phone_href ) : ?>
				<li>
					<a class="contact-channels__link" href="<?php echo esc_url( $paperia_phone_href ); ?>">
						<span class="contact-channels__icon icon-Phone" aria-hidden="true"></span>
						<span class="contact-channels__label"><?php esc_html_e( 'تماس مستقیم با واحد فروش', 'paperia' ); ?></span>
						<span class="contact-channels__value"><?php echo esc_html( $paperia_phone ); ?></span>
					</a>
				</li>
			<?php endif; ?>

			<?php if ( $paperia_email ) : ?>
				<li>
					<a class="contact-channels__link" href="<?php echo esc_url( 'mailto:' . $paperia_email ); ?>">
						<span class="contact-channels__icon icon-EnvelopeSimple" aria-hidden="true"></span>
						<span class="contact-channels__label"><?php esc_html_e( 'ایمیل', 'paperia' ); ?></span>
						<span class="contact-channels__value"><?php echo esc_html( $paperia_email ); ?></span>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</aside>
