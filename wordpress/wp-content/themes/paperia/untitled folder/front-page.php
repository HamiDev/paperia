<?php
/**
 * Front page template.
 *
 * WordPress uses this file for the site front when it exists (template hierarchy).
 * Sections live in template-parts so front-page.php stays a thin composition.
 *
 * @package Paperia
 */

get_header();
?>

<div class="home-landing">
	<?php get_template_part( 'template-parts/components/hero' ); ?>
	<div class="home-landing__main">
		<?php get_template_part( 'template-parts/components/categories' ); ?>
		<?php get_template_part( 'template-parts/components/featured', 'products' ); ?>
		<?php get_template_part( 'template-parts/components/promo', 'banner' ); ?>
	</div>
</div>

<?php
get_footer();
