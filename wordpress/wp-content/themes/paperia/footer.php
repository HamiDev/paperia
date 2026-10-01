<?php
/**
 * Main document footer.
 *
 * Concept: get_footer() closes the main content opened in header.php and
 * prints wp_footer() so plugins/scripts can inject correctly.
 *
 * @package Paperia
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main>

<?php get_template_part( 'template-parts/footer/site', 'footer' ); ?>

<?php wp_footer(); ?>
</body>
</html>
