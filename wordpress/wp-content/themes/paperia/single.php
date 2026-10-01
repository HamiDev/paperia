<?php
/**
 * Single post template.
 *
 * @package Paperia
 */

get_header();
?>

<div class="container">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<?php get_template_part( 'template-parts/content/content', 'single' ); ?>
	<?php endwhile; ?>
</div>

<?php
get_footer();
