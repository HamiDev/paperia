<?php
/**
 * Contact page — slug contact-us.
 *
 * @package Paperia
 */

get_header();
?>

<div class="contact-page">
	<div class="container">
		<?php get_template_part( 'template-parts/contact/intro' ); ?>

		<div class="contact-page__layout">
			<?php get_template_part( 'template-parts/contact/faq' ); ?>
			<?php get_template_part( 'template-parts/contact/panel' ); ?>
		</div>
	</div>
</div>

<?php
get_footer();
