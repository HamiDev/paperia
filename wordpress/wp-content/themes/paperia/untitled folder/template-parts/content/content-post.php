<?php
/**
 * Blog post card for archives and related posts.
 *
 * @package Paperia
 *
 * @param array $args {
 *     @type bool $eager Load the thumbnail immediately (first card in a list).
 * }
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_eager     = ! empty( $args['eager'] );
$paperia_permalink = get_permalink();
$paperia_title     = get_the_title();
$paperia_category  = paperia_get_primary_category();
$paperia_excerpt   = paperia_get_card_excerpt();
$paperia_thumb_id  = get_post_thumbnail_id();
?>
<article <?php post_class( 'post-card' ); ?>>
	<a class="post-card__media" href="<?php echo esc_url( $paperia_permalink ); ?>">
		<?php if ( $paperia_thumb_id ) : ?>
			<?php
			echo wp_get_attachment_image(
				$paperia_thumb_id,
				'large',
				false,
				array(
					'class'    => 'post-card__image',
					'alt'      => $paperia_title,
					'loading'  => $paperia_eager ? 'eager' : 'lazy',
					'decoding' => 'async',
				)
			);
			?>
		<?php else : ?>
			<span class="post-card__placeholder" aria-hidden="true"></span>
		<?php endif; ?>
	</a>

	<div class="post-card__body">
		<div class="post-card__meta">
			<?php if ( $paperia_category instanceof WP_Term ) : ?>
				<a class="post-card__category" href="<?php echo esc_url( get_category_link( $paperia_category ) ); ?>">
					<?php echo esc_html( $paperia_category->name ); ?>
				</a>
			<?php endif; ?>
			<time class="post-card__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
		</div>

		<h2 class="post-card__title">
			<a href="<?php echo esc_url( $paperia_permalink ); ?>"><?php echo esc_html( $paperia_title ); ?></a>
		</h2>

		<?php if ( '' !== $paperia_excerpt ) : ?>
			<p class="post-card__excerpt"><?php echo esc_html( $paperia_excerpt ); ?></p>
		<?php endif; ?>

		<a class="post-card__more" href="<?php echo esc_url( $paperia_permalink ); ?>">
			<?php esc_html_e( 'ادامه مطلب', 'paperia' ); ?>
		</a>
	</div>
</article>
