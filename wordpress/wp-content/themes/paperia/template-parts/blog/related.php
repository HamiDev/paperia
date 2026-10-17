<?php
/**
 * Related posts under a single article.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$paperia_related = paperia_get_related_posts( get_the_ID(), 3 );

if ( ! $paperia_related->have_posts() ) {
	return;
}
?>
<section class="post-related" aria-labelledby="post-related-title">
	<div class="post-related__inner">
		<div class="blog-section-heading">
			<h2 id="post-related-title" class="blog-section-heading__title"><?php esc_html_e( 'نوشته‌های مرتبط', 'paperia' ); ?></h2>
			<span class="blog-section-heading__rule" aria-hidden="true"></span>
		</div>

		<div class="post-related__grid">
			<?php
			while ( $paperia_related->have_posts() ) :
				$paperia_related->the_post();
				get_template_part( 'template-parts/content/content', 'post' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>
