<?php
/**
 * Page content.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'content-page' ); ?>>
	<header class="content-page__header">
		<?php the_title( '<h1 class="content-page__title">', '</h1>' ); ?>
	</header>

	<div class="content-page__body">
		<?php the_content(); ?>
	</div>
</article>
