<?php
/**
 * Single post content.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_category = paperia_get_primary_category();
$paperia_reading  = paperia_get_reading_time();
$paperia_thumb_id = get_post_thumbnail_id();
?>
<article <?php post_class( 'post-article' ); ?>>
	<header class="post-article__header">
		<?php if ( $paperia_category instanceof WP_Term ) : ?>
			<a class="post-card__category" href="<?php echo esc_url( get_category_link( $paperia_category ) ); ?>">
				<?php echo esc_html( $paperia_category->name ); ?>
			</a>
		<?php endif; ?>

		<?php the_title( '<h1 class="post-article__title">', '</h1>' ); ?>

		<div class="post-article__meta">
			<time class="post-article__date" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
				<?php echo esc_html( get_the_date() ); ?>
			</time>
			<?php if ( '' !== $paperia_reading ) : ?>
				<span class="post-article__reading"><?php echo esc_html( $paperia_reading ); ?></span>
			<?php endif; ?>
		</div>
	</header>

	<?php if ( $paperia_thumb_id ) : ?>
		<figure class="post-article__hero">
			<?php
			echo wp_get_attachment_image(
				$paperia_thumb_id,
				'large',
				false,
				array(
					'class'         => 'post-article__image',
					'alt'           => get_the_title(),
					'loading'       => 'eager',
					'decoding'      => 'async',
					'fetchpriority' => 'high',
				)
			);
			?>
		</figure>
	<?php endif; ?>

	<div class="post-article__body">
		<?php the_content(); ?>
	</div>
</article>
