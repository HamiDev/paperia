<?php
/**
 * No results / empty state.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section class="no-results">
	<h1 class="no-results__title"><?php esc_html_e( 'Nothing found', 'paperia' ); ?></h1>
	<p><?php esc_html_e( 'Try a different search or browse the site menu.', 'paperia' ); ?></p>
</section>
