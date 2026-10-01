<?php
/**
 * Site footer chrome — four columns matching the landing mockup.
 *
 * Contact / social values prefer ACF Options when available.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_phone   = '';
$paperia_email   = '';
$paperia_address = '';
$paperia_social  = array(
	'instagram' => '',
	'telegram'  => '',
	'linkedin'  => '',
	'whatsapp'  => '',
);

if ( function_exists( 'get_field' ) ) {
	$option_phone   = get_field( 'phone', 'option' );
	$option_email   = get_field( 'email', 'option' );
	$option_address = get_field( 'address', 'option' );
	$option_ig      = get_field( 'social_instagram', 'option' );
	$option_tg      = get_field( 'social_telegram', 'option' );
	$option_li      = get_field( 'social_linkedin', 'option' );
	$option_wa      = get_field( 'social_whatsapp', 'option' );

	if ( is_string( $option_phone ) ) {
		$paperia_phone = $option_phone;
	}
	if ( is_string( $option_email ) ) {
		$paperia_email = $option_email;
	}
	if ( is_string( $option_address ) ) {
		$paperia_address = $option_address;
	}
	if ( is_string( $option_ig ) ) {
		$paperia_social['instagram'] = $option_ig;
	}
	if ( is_string( $option_tg ) ) {
		$paperia_social['telegram'] = $option_tg;
	}
	if ( is_string( $option_li ) ) {
		$paperia_social['linkedin'] = $option_li;
	}
	if ( is_string( $option_wa ) ) {
		$paperia_social['whatsapp'] = $option_wa;
	}
}

$paperia_has_social = (bool) array_filter( $paperia_social );
?>
<footer class="site-footer" role="contentinfo">
	<div class="site-footer__inner">
		<div class="site-footer__grid">
			<section class="site-footer__col site-footer__col--social">
				<h2 class="site-footer__heading"><?php esc_html_e( 'ما را دنبال کنید', 'paperia' ); ?></h2>
				<?php if ( $paperia_has_social ) : ?>
					<ul class="site-footer__social">
						<?php if ( $paperia_social['instagram'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $paperia_social['instagram'] ); ?>" aria-label="<?php esc_attr_e( 'Instagram', 'paperia' ); ?>">
									<span class="icon-InstagramLogo" aria-hidden="true"></span>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $paperia_social['telegram'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $paperia_social['telegram'] ); ?>" aria-label="<?php esc_attr_e( 'Telegram', 'paperia' ); ?>">
									<span class="icon-TelegramLogo" aria-hidden="true"></span>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $paperia_social['linkedin'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $paperia_social['linkedin'] ); ?>" aria-label="<?php esc_attr_e( 'LinkedIn', 'paperia' ); ?>">
									<span class="icon-LinkedinLogo" aria-hidden="true"></span>
								</a>
							</li>
						<?php endif; ?>
						<?php if ( $paperia_social['whatsapp'] ) : ?>
							<li>
								<a href="<?php echo esc_url( $paperia_social['whatsapp'] ); ?>" aria-label="<?php esc_attr_e( 'WhatsApp', 'paperia' ); ?>">
									<span class="icon-WhatsappLogo" aria-hidden="true"></span>
								</a>
							</li>
						<?php endif; ?>
					</ul>
				<?php else : ?>
					<p class="site-footer__hint"><?php esc_html_e( 'لینک شبکه‌های اجتماعی را از تنظیمات تم اضافه کنید.', 'paperia' ); ?></p>
				<?php endif; ?>
			</section>

			<section class="site-footer__col site-footer__col--contact">
				<h2 class="site-footer__heading"><?php esc_html_e( 'تماس با ما', 'paperia' ); ?></h2>
				<ul class="site-footer__contact">
					<?php if ( $paperia_phone ) : ?>
						<li>
							<span class="icon-Phone" aria-hidden="true"></span>
							<a href="<?php echo esc_url( 'tel:' . preg_replace( '/\s+/', '', $paperia_phone ) ); ?>"><?php echo esc_html( $paperia_phone ); ?></a>
						</li>
					<?php endif; ?>
					<?php if ( $paperia_email ) : ?>
						<li>
							<span class="icon-EnvelopeSimple" aria-hidden="true"></span>
							<a href="<?php echo esc_url( 'mailto:' . $paperia_email ); ?>"><?php echo esc_html( $paperia_email ); ?></a>
						</li>
					<?php endif; ?>
					<?php if ( $paperia_address ) : ?>
						<li>
							<span class="icon-MapPin" aria-hidden="true"></span>
							<span><?php echo esc_html( $paperia_address ); ?></span>
						</li>
					<?php endif; ?>
					<?php if ( ! $paperia_phone && ! $paperia_email && ! $paperia_address ) : ?>
						<li class="site-footer__hint"><?php esc_html_e( 'اطلاعات تماس را از Paperia Settings پر کنید.', 'paperia' ); ?></li>
					<?php endif; ?>
				</ul>
			</section>

			<section class="site-footer__col site-footer__col--links">
				<h2 class="site-footer__heading"><?php esc_html_e( 'لینک‌های مفید', 'paperia' ); ?></h2>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'site-footer__menu',
						'fallback_cb'    => false,
						'depth'          => 1,
					)
				);
				?>
			</section>

			<section class="site-footer__col site-footer__col--cats">
				<h2 class="site-footer__heading"><?php esc_html_e( 'دسته‌بندی محصولات', 'paperia' ); ?></h2>
				<ul class="site-footer__menu">
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'دفتر و تحریر', 'paperia' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'کاغذ A4', 'paperia' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'کارتن و بسته‌بندی', 'paperia' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'ملزومات چاپ', 'paperia' ); ?></a></li>
				</ul>
			</section>
		</div>

		<div class="site-footer__bottom">
			<p class="site-footer__copy">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
				— <?php esc_html_e( 'تمامی حقوق محفوظ است.', 'paperia' ); ?>
			</p>
			<span class="site-footer__logo-mark" aria-hidden="true">NAMDAR</span>
		</div>
	</div>
</footer>
