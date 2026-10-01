<?php
/**
 * Archive template (categories, tags, dates, custom post type archives).
 *
 * @package Paperia
 */

get_header();
?>

<div class="container">
	<header class="archive-header">
		<?php the_archive_title( '<h1 class="archive-header__title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="archive-header__desc">', '</div>' ); ?>
	</header>

	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php get_template_part( 'template-parts/content/content' ); ?>
		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
	<?php endif; ?>
</div>

<?php
get_footer();
