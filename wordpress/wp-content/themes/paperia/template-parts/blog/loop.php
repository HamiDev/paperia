<?php
/**
 * Post listing loop used by the blog, archives, and search.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if ( have_posts() ) : ?>
	<div class="blog-grid">
		<?php
		$paperia_card_index = 0;
		while ( have_posts() ) :
			the_post();
			++$paperia_card_index;
			$paperia_card_slug = ( 'post' === get_post_type() ) ? 'post' : '';
			get_template_part(
				'template-parts/content/content',
				$paperia_card_slug,
				array(
					'eager' => 1 === $paperia_card_index,
				)
			);
		endwhile;
		?>
	</div>

	<?php
	the_posts_pagination(
		array(
			'mid_size'           => 1,
			'prev_text'          => __( 'قبلی', 'paperia' ),
			'next_text'          => __( 'بعدی', 'paperia' ),
			'screen_reader_text' => __( 'ناوبری نوشته‌ها', 'paperia' ),
			'aria_label'         => __( 'ناوبری نوشته‌ها', 'paperia' ),
		)
	);
	?>
<?php else : ?>
	<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
<?php endif; ?>
