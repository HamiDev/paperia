<?php
/**
 * Fallback content loop item (blog posts / archives).
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'content-card' ); ?>>
	<header class="content-card__header">
		<?php
		the_title(
			sprintf( '<h2 class="content-card__title"><a href="%s">', esc_url( get_permalink() ) ),
			'</a></h2>'
		);
		?>
	</header>

	<div class="content-card__excerpt">
		<?php the_excerpt(); ?>
	</div>
</article>
