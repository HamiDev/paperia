<?php
/**
 * Main fallback template.
 *
 * Concept: Template Hierarchy — if a more specific file (home.php, archive.php,
 * etc.) is missing, WordPress falls back to index.php. Every theme needs this.
 *
 * @package Paperia
 */

get_header();
?>

<div class="blog">
	<div class="blog__main">
		<?php get_template_part( 'template-parts/blog/loop' ); ?>
	</div>
</div>

<?php
get_footer();
