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

<div class="container">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'template-parts/content/content', get_post_type() ); ?>
		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
