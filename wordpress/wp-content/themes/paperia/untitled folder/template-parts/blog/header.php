<?php
/**
 * Blog and archive page heading.
 *
 * @package Paperia
 *
 * @param array $args {
 *     @type string $title       Visible heading.
 *     @type string $description Optional intro. Plain text or limited HTML.
 *     @type string $meta        Optional secondary line, such as a post count.
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_title       = isset( $args['title'] ) ? (string) $args['title'] : '';
$paperia_description = isset( $args['description'] ) ? (string) $args['description'] : '';
$paperia_meta        = isset( $args['meta'] ) ? (string) $args['meta'] : '';

if ( '' === $paperia_title && '' === $paperia_description ) {
	return;
}
?>
<header class="blog-header">
	<div class="blog-header__inner">
		<?php if ( '' !== $paperia_title ) : ?>
			<h1 class="blog-header__title"><?php echo wp_kses( $paperia_title, array( 'span' => array() ) ); ?></h1>
		<?php endif; ?>

		<?php if ( '' !== $paperia_description ) : ?>
			<div class="blog-header__desc"><?php echo wp_kses_post( $paperia_description ); ?></div>
		<?php endif; ?>

		<?php if ( '' !== $paperia_meta ) : ?>
			<p class="blog-header__meta"><?php echo esc_html( $paperia_meta ); ?></p>
		<?php endif; ?>
	</div>
</header>
