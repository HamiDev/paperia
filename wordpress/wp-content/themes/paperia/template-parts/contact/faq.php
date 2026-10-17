<?php
/**
 * Contact page FAQ accordion.
 *
 * Uses native details/summary so only one item stays open (name attribute)
 * without custom JavaScript.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_faqs = paperia_get_contact_faqs();

if ( empty( $paperia_faqs ) ) {
	return;
}
?>
<section class="contact-faq" aria-labelledby="contact-faq-title">
	<div class="contact-faq__heading">
		<h2 id="contact-faq-title" class="contact-faq__title"><?php esc_html_e( 'سوالات متداول', 'paperia' ); ?></h2>
	</div>

	<div class="contact-faq__list">
		<?php foreach ( $paperia_faqs as $paperia_index => $paperia_faq ) : ?>
			<?php
			if ( empty( $paperia_faq['question'] ) || empty( $paperia_faq['answer'] ) ) {
				continue;
			}
			?>
			<details class="contact-faq__item" name="contact-faq"<?php echo 0 === (int) $paperia_index ? ' open' : ''; ?>>
				<summary class="contact-faq__question">
					<span class="contact-faq__question-text"><?php echo esc_html( $paperia_faq['question'] ); ?></span>
					<span class="contact-faq__icon" aria-hidden="true"></span>
				</summary>
				<div class="contact-faq__answer">
					<?php echo wp_kses_post( $paperia_faq['answer'] ); ?>
				</div>
			</details>
		<?php endforeach; ?>
	</div>
</section>
