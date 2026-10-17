<?php
/**
 * Contact page introduction.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="contact-page__intro">
	<p class="contact-page__eyebrow"><?php esc_html_e( 'پاسخ‌هایی که ممکن است به شما کمک کند', 'paperia' ); ?></p>
	<?php the_title( '<h1 class="contact-page__title">', '</h1>' ); ?>
	<p class="contact-page__lead"><?php esc_html_e( 'برای هرگونه سوال با ما تماس بگیرید', 'paperia' ); ?></p>
</header>
