<?php
/**
 * Archive template (categories, tags, dates, authors).
 *
 * @package Paperia
 */

get_header();
?>

<div class="blog">
	<?php
	get_template_part(
		'template-parts/blog/header',
		null,
		array(
			'title'       => get_the_archive_title(),
			'description' => get_the_archive_description(),
		)
	);
	?>

	<div class="blog__main">
		<?php get_template_part( 'template-parts/blog/loop' ); ?>
	</div>
</div>

<?php
get_footer();
