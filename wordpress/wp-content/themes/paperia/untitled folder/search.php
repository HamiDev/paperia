<?php
/**
 * Search results template.
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
			'title' => sprintf(
				/* translators: %s: search query. */
				__( 'نتایج جستجو برای «%s»', 'paperia' ),
				get_search_query()
			),
		)
	);
	?>

	<div class="blog__main">
		<?php get_template_part( 'template-parts/blog/loop' ); ?>
	</div>
</div>

<?php
get_footer();
