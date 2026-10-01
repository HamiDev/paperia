<?php
/**
 * Front page template.
 *
 * Used when Settings → Reading uses a static front page, or when the site
 * front is the blog and front-page.php exists (it takes priority for the URL /).
 *
 * @package Paperia
 */

get_header();
?>

<div class="container">
	<?php get_template_part( 'template-parts/components/hero' ); ?>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'template-parts/content/content', 'page' ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</div>

<?php
get_footer();
