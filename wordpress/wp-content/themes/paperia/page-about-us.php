<?php
/**
 * About page.
 *
 * WordPress selects this file for the page whose slug is about-us-3.
 * Sections live in template-parts so this file stays a thin composition.
 *
 * @package Paperia
 */

get_header();
?>

<div class="about-page">
	<?php get_template_part( 'template-parts/about/intro' ); ?>
	<?php get_template_part( 'template-parts/about/story' ); ?>
	<?php get_template_part( 'template-parts/about/stats' ); ?>
	<?php get_template_part( 'template-parts/about/process' ); ?>
</div>

<?php
get_footer();
