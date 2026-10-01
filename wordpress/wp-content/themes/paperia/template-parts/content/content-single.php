<?php
/**
 * Single post content.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<article <?php post_class( 'content-single' ); ?>>
	<header class="content-single__header">
		<?php the_title( '<h1 class="content-single__title">', '</h1>' ); ?>
	</header>

	<div class="content-single__body">
		<?php the_content(); ?>
	</div>
</article>
